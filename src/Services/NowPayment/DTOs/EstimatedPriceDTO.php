<?php

namespace AdriCQ\Payment\Services\NowPayment\DTOs;

/**
 * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#3c86a16e-94ad-4230-a470-4e833766a4c7
 *
 * @example
 * {
 * "currency_from": "usd",
 * "amount_from": 3999.5,
 * "currency_to": "btc",
 * "estimated_amount": 0.17061637
 * }
 */
final readonly class EstimatedPriceDTO
{
    public function __construct(
        public string $currency_from,
        public float $amount_from,
        public string $currency_to,
        public float $estimated_amount
    ) {}

    /**
     * Create a new instance from an array of data.
     *
     * @param array{
     *     currency_from: string,
     *     amount_from: float|int,
     *     currency_to: string,
     *     estimated_amount: float|int
     * } $data
     */
    public static function make(array $data): self
    {
        return new self(
            currency_from: (string) $data['currency_from'],
            amount_from: (float) $data['amount_from'],
            currency_to: (string) $data['currency_to'],
            estimated_amount: (float) $data['estimated_amount']
        );
    }
}
