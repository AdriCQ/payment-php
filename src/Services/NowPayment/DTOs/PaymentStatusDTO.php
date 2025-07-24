<?php

namespace AdriCQ\Payment\Services\NowPayment\DTOs;

use AdriCQ\Payment\Enums\PaymentStatus;

/**
 * @see https://documenter.getpostman.com/view/7907941/2s93JusNJt#62a6d281-478d-4927-8cd0-f96d677b8de6
 *
 * @example {
 *     "payment_id": 6249365965,
 *     "invoice_id": null,
 *     "payment_status": "finished",
 *     "pay_address": "address",
 *     "payin_extra_id": null,
 *     "price_amount": 1,
 *     "price_currency": "usd",
 *     "pay_amount": 11.8,
 *     "actually_paid": 12,
 *     "pay_currency": "trx",
 *     "order_id": null,
 *     "order_description": null,
 *     "purchase_id": 5312822613,
 *     "outcome_amount": 11.8405,
 *     "outcome_currency": "trx",
 *     "payout_hash": "hash",
 *     "payin_hash": "hash",
 *     "created_at": "2023-07-28T15:06:09.932Z",
 *     "updated_at": "2023-07-28T15:09:40.535Z",
 *     "burning_percent": "null",
 *     "type": "crypto2crypto",
 *     "payment_extra_ids": [5513339153]
 * }
 */
final readonly class PaymentStatusDTO
{
    public function __construct(
        public int $payment_id,
        public ?int $invoice_id,
        public PaymentStatus $payment_status,
        public string $pay_address,
        public ?string $payin_extra_id,
        public float $price_amount,
        public string $price_currency,
        public float $pay_amount,
        public float $actually_paid,
        public string $pay_currency,
        public ?string $order_id,
        public ?string $order_description,
        public int $purchase_id,
        public float $outcome_amount,
        public string $outcome_currency,
        public ?string $payout_hash,
        public ?string $payin_hash,
        public string $created_at,
        public string $updated_at,
        public ?string $burning_percent,
        public string $type,
        public array $payment_extra_ids
    ) {}

    /**
     * Create a new instance from an array of data.
     *
     * @param array{
     *     payment_id: int|string,
     *     invoice_id: int|string|null,
     *     payment_status: string,
     *     pay_address: string,
     *     payin_extra_id: string|null,
     *     price_amount: float|int|string,
     *     price_currency: string,
     *     pay_amount: float|int|string,
     *     actually_paid: float|int|string,
     *     pay_currency: string,
     *     order_id: string|int|null,
     *     order_description: string|null,
     *     purchase_id: int|string,
     *     outcome_amount: float|int|string,
     *     outcome_currency: string,
     *     payout_hash: string|null,
     *     payin_hash: string|null,
     *     created_at: string,
     *     updated_at: string,
     *     burning_percent: string|null,
     *     type: string,
     *     payment_extra_ids: int[]
     * } $data
     */
    public static function make(array $data): self
    {
        return new self(
            payment_id: (int) $data['payment_id'],
            invoice_id: $data['invoice_id']         !== null ? (int) $data['invoice_id'] : null,
            payment_status: PaymentStatus::from((string) $data['payment_status']),
            pay_address: (string) $data['pay_address'],
            payin_extra_id: $data['payin_extra_id'] !== null ? (string) $data['payin_extra_id'] : null,
            price_amount: (float) $data['price_amount'],
            price_currency: (string) $data['price_currency'],
            pay_amount: (float) $data['pay_amount'],
            actually_paid: (float) $data['actually_paid'],
            pay_currency: (string) $data['pay_currency'],
            order_id: $data['order_id']             !== null ? (string) $data['order_id'] : null,
            order_description: $data['order_description'] ?? null,
            purchase_id: (int) $data['purchase_id'],
            outcome_amount: (float) $data['outcome_amount'],
            outcome_currency: (string) $data['outcome_currency'],
            payout_hash: $data['payout_hash']             ?? null,
            payin_hash: $data['payin_hash']               ?? null,
            created_at: (string) $data['created_at'],
            updated_at: (string) $data['updated_at'],
            burning_percent: $data['burning_percent']     ?? null,
            type: (string) $data['type'],
            payment_extra_ids: array_map('intval', $data['payment_extra_ids'] ?? [])
        );
    }

    public function toArray(): array
    {
        return [
            'payment_id'        => $this->payment_id,
            'invoice_id'        => $this->invoice_id,
            'payment_status'    => $this->payment_status,
            'pay_address'       => $this->pay_address,
            'payin_extra_id'    => $this->payin_extra_id,
            'price_amount'      => $this->price_amount,
            'price_currency'    => $this->price_currency,
            'pay_amount'        => $this->pay_amount,
            'actually_paid'     => $this->actually_paid,
            'pay_currency'      => $this->pay_currency,
            'order_id'          => $this->order_id,
            'order_description' => $this->order_description,
            'purchase_id'       => $this->purchase_id,
            'outcome_amount'    => $this->outcome_amount,
            'outcome_currency'  => $this->outcome_currency,
            'payout_hash'       => $this->payout_hash,
            'payin_hash'        => $this->payin_hash,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'burning_percent'   => $this->burning_percent,
            'type'              => $this->type,
            'payment_extra_ids' => $this->payment_extra_ids,
        ];
    }
}
