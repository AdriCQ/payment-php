<?php

namespace AdriCQ\Payment\Services\NowPayment\Clients;

use AdriCQ\Payment\Services\NowPayment\DTOs\EstimatedPriceDTO;
use AdriCQ\Payment\Services\NowPayment\DTOs\InvoiceDTO;
use AdriCQ\Payment\Services\NowPayment\DTOs\MinimumPaymentDTO;
use AdriCQ\Payment\Services\NowPayment\DTOs\PaymentStatusDTO;
use AdriCQ\Payment\Services\NowPayment\Helpers\ConfigHelper;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final readonly class NowPaymentClient
{
    private string $apiUrl;
    private string $secretToken;
    private string $webhookUrl;

    public function __construct()
    {
        $this->apiUrl      = ConfigHelper::apiUrl();
        $this->secretToken = ConfigHelper::apiKey();
        $this->webhookUrl  = ConfigHelper::webhookFullUrl();

        Log::info('NowPaymentClient initialized', [
            'apiUrl'      => $this->apiUrl,
            'secretToken' => $this->secretToken,
            'webhookUrl'  => $this->webhookUrl,
        ]);
    }

    /**
     * @throws ConnectionException
     */
    public function status(): bool
    {
        $response = $this->get('/status');

        return $response->successful() && $response->json('message') === 'OK';
    }

    /**
     * @throws ConnectionException
     */
    private function get(string $url, array $params = [], array $headers = []): Response
    {
        return Http::withHeaders($this->mergeHeaders($headers))
            ->get(
                url: $this->apiUrl . $url,
                query: $params
            );
    }

    private function mergeHeaders(array $headers): array
    {
        return array_merge($headers, [
            'x-api-key' => $this->secretToken,
        ]);
    }

    /**
     * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#f5e4e645-dce2-4b06-b2ca-2a29aaa5e845
     *
     * @throws ConnectionException
     */
    public function invoice(float $amount, string $currency, string $orderId, string $orderDescription, ?string $confirmationUrl=null, ?string $cancelUrl=null): InvoiceDTO
    {
        $response = $this->post('/invoice', [
            'price_amount'      => $amount,
            'price_currency'    => $currency,
            'order_id'          => $orderId,
            //            'pay_currency' => ConfigHelper::paymentCurrency(),
            'order_description' => $orderDescription,
            'ipn_callback_url'  => $this->webhookUrl,
            'success_url'       => $confirmationUrl ?? ConfigHelper::successInvoiceUrl(),
            'cancel_url'        => $cancelUrl       ?? ConfigHelper::cancelInvoiceUrl(),
        ]);

        Log::info('NowPayment Invoice request', [
            'amount'      => $amount,
            'currency'    => $currency,
            'orderId'     => $orderId,
            'description' => $orderDescription,
            'ipnCallback' => $this->webhookUrl,
            'successUrl'  => $confirmationUrl,
            'cancelUrl'   => $cancelUrl,
        ]);

        Log::info('NowPayment Invoice response', [
            'response' => $response->json(),
        ]);

        if ($response->ok() && (bool) $response->json('status')) {
            return InvoiceDTO::make($response->json());
        }

        throw new ConnectionException($response->body());
    }

    /**
     * @throws ConnectionException
     */
    private function post(string $url, array $body = [], array $params = [], array $headers = []): Response
    {
        return Http::withHeaders($this->mergeHeaders($headers))
            ->withQueryParameters($params)
            ->post(
                url: $this->apiUrl . $url,
                data: $body
            );
    }

    /**
     * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#7bfbe4fb-440f-4e46-966b-2f452a70013c
     *
     * @return string[]
     *
     * @throws ConnectionException
     */
    public function availableCurrencies(): array
    {
        $response = $this->get(
            url: '/currencies',
            params: ['fixed_rate' => true]
        );

        return $response->json()['currencies'];
    }

    /**
     * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#ce3fe3a3-00cd-4df2-bfba-641fde741da7
     *
     * @throws ConnectionException
     */
    public function minimumPaymentAmount(string $currencyFrom, string $currencyTo, string $fiat_equivalent = 'usd'): MinimumPaymentDTO
    {
        $response = $this->get(
            url: '/min-amount',
            params: [
                'currency_from'       => $currencyFrom,
                'currency_to'         => $currencyTo,
                'fiat_equivalent'     => $fiat_equivalent,
                'is_fixed_rate'       => false,
                'is_fee_paid_by_user' => false,
            ]
        );

        return MinimumPaymentDTO::make($response->json());
    }

    /**
     * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#3c86a16e-94ad-4230-a470-4e833766a4c7
     *
     * @throws ConnectionException
     */
    public function estimatePrice(float $amount, string $currencyFrom, string $currencyTo): EstimatedPriceDTO
    {
        $response = $this->get(
            url: '/estimate',
            params: [
                'amount'        => $amount,
                'currency_from' => $currencyFrom,
                'currency_to'   => $currencyTo,
            ]
        );

        return EstimatedPriceDTO::make($response->json());
    }

    /**
     * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#62a6d281-478d-4927-8cd0-f96d677b8de6
     *
     * @throws ConnectionException
     */
    public function paymentStatus(string $paymentId): PaymentStatusDTO
    {
        $response = $this->get(
            url: '/payment/' . $paymentId,
        );

        return PaymentStatusDTO::make($response->json());
    }
}
