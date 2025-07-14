<?php

namespace AdriCQ\Payment\Services\NowPayment\DTOs;

/**
 * {
 *  "payment_id":123456789,
 *  "parent_payment_id":987654321,
 *  "invoice_id":null,
 *  "payment_status":"finished",
 *  "pay_address":"address",
 *  "payin_extra_id":null,
 *  "price_amount":1,
 *  "price_currency":"usd",
 *  "pay_amount":15,
 *  "actually_paid":15,
 *  "actually_paid_at_fiat":0,
 *  "pay_currency":"trx",
 *  "order_id":null,
 *  "order_description":null,
 *  "purchase_id":"123456789",
 *  "outcome_amount":14.8106,
 *  "outcome_currency":"trx",
 *  "payment_extra_ids":null
 *  "fee": {
 *      "currency":"btc",
 *      "depositFee":0.09853637216235617,
 *      "withdrawalFee":0,
 *      "serviceFee":0
 *  }
 * }.
 */
final readonly class CallbackResponseDTO
{
    public function __construct(
        public int $payment_id,
        public int $parent_payment_id,
        public ?string $invoice_id,
        public string $payment_status,
        public string $pay_address,
        public ?string $payin_extra_id,
        public float $price_amount,
        public string $price_currency,
        public float $pay_amount,
        public float $actually_paid,
        public float $actually_paid_at_fiat,
        public string $pay_currency,
        public ?string $order_id,
        public ?string $order_description,
        public string $purchase_id,
        public float $outcome_amount,
        public string $outcome_currency,
        public ?string $payment_extra_ids,
        public array $fee
    ) {}

    public static function make(array $data): self
    {
        return new self(
            payment_id: $data['payment_id'],
            parent_payment_id: $data['parent_payment_id'],
            invoice_id: $data['invoice_id']               ?? null,
            payment_status: $data['payment_status'],
            pay_address: $data['pay_address'],
            payin_extra_id: $data['payin_extra_id']       ?? null,
            price_amount: (float) $data['price_amount'],
            price_currency: $data['price_currency'],
            pay_amount: (float) $data['pay_amount'],
            actually_paid: (float) $data['actually_paid'],
            actually_paid_at_fiat: (float) ($data['actually_paid_at_fiat'] ?? 0),
            pay_currency: $data['pay_currency'],
            order_id: $data['order_id']                   ?? null,
            order_description: $data['order_description'] ?? null,
            purchase_id: $data['purchase_id'],
            outcome_amount: (float) $data['outcome_amount'],
            outcome_currency: $data['outcome_currency'],
            payment_extra_ids: $data['payment_extra_ids'] ?? null,
            fee: $data['fee']                             ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'payment_id'            => $this->payment_id,
            'parent_payment_id'     => $this->parent_payment_id,
            'invoice_id'            => $this->invoice_id,
            'payment_status'        => $this->payment_status,
            'pay_address'           => $this->pay_address,
            'payin_extra_id'        => $this->payin_extra_id,
            'price_amount'          => $this->price_amount,
            'price_currency'        => $this->price_currency,
            'pay_amount'            => $this->pay_amount,
            'actually_paid'         => $this->actually_paid,
            'actually_paid_at_fiat' => $this->actually_paid_at_fiat,
            'pay_currency'          => $this->pay_currency,
            'order_id'              => $this->order_id,
            'order_description'     => $this->order_description,
            'purchase_id'           => $this->purchase_id,
            'outcome_amount'        => $this->outcome_amount,
            'outcome_currency'      => $this->outcome_currency,
            'payment_extra_ids'     => $this->payment_extra_ids,
            'fee'                   => $this->fee,
        ];
    }
}
