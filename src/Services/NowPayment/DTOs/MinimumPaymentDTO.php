<?php

namespace AdriCQ\Payment\Services\NowPayment\DTOs;

/**
 * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#ce3fe3a3-00cd-4df2-bfba-641fde741da7
 *
 * @example
 * {
 * "currency_from": "eth",
 * "currency_to": "trx",
 * "min_amount": 0.0078999,
 * "fiat_equivalent": 35.40626584
 * }
 */
final readonly class MinimumPaymentDTO
{
    public function __construct(
        public string $currency_from,
        public string $currency_to,
        public float $min_amount,
        public float $fiat_equivalent
    ) {}

    /**
     * Create a new instance from an array of data.
     *
     * @param array{
     *     currency_from: string,
     *     currency_to: string,
     *     min_amount: float,
     *     fiat_equivalent: float
     * } $data
     */
    public static function make(array $data): self
    {
        return new self(
            currency_from: $data['currency_from'],
            currency_to: $data['currency_to'],
            min_amount: (float) $data['min_amount'],
            fiat_equivalent: (float) $data['fiat_equivalent']
        );
    }
}
