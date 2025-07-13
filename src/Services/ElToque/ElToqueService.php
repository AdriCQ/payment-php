<?php

namespace AdriCQ\Payment\Services\ElToque;

use AdriCQ\Payment\Services\ElToque\DTOs\CurrencyRateDTO;
use AdriCQ\Payment\Services\ElToque\Rules\RateServiceRule;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

final readonly class ElToqueService
{
    private string $CACHE_KEY;

    public function __construct(
        private int $rate = 1,
        private int $extra = 0
    ) {
        $this->CACHE_KEY = 'payment.el_toque_rates';
    }

    public function run(): CurrencyRateDTO
    {
        $cached = $this->readFromCache();
        if ($cached !== null) {
            return CurrencyRateDTO::make($this->transform($cached));
        }

        $token  = config('payment.el_toque.token');
        $url    = config('payment.el_toque.url');

        try {

            $response          = Http::withToken($token)->get($url);
            $validatedResponse = $this->validatedResponse($response->json());
            $this->writeToCache($validatedResponse);

            return CurrencyRateDTO::make($this->transform($validatedResponse));
        } catch (ConnectionException $e) {
            Log::error('ElToqueService::run(): ConnectionException: ' . $e->getMessage());

            return CurrencyRateDTO::make([]);
        }
    }

    private function readFromCache(): ?array
    {
        return Cache::get($this->CACHE_KEY);
    }

    public static function make(int $rate = 1, int $extra = 0): self
    {
        return new self($rate, $extra);
    }

    private function transform(array $data): array
    {
        $withExtra = $this->addExtra($data);

        return [
            'CUP'   => 1,
            'Zelle' => $withExtra['USD'] * 1.1,
            ...$withExtra,
        ];
    }

    private function addExtra(array $data): array
    {
        return array_map(function ($currencyPrice) {
            return ($currencyPrice + $this->extra) * $this->rate;
        }, $data);
    }

    private function validatedResponse(array $data): array
    {
        return Validator::make(['response' => $data], [
            'response' => ['required', new RateServiceRule],
        ])->validated()['response']['tasas'];
    }

    private function writeToCache(array $rates): void
    {
        $ttl = now()->addSeconds(config('payment.el_toque.ttl'))->timestamp;
        Cache::put($this->CACHE_KEY, $rates, ttl: $ttl);
    }
}
