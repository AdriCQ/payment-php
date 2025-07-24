<?php

namespace AdriCQ\Payment\Services\NowPayment\DTOs;

/**
 * @see https://documenter.getpostman.com/view/7907941/2s93JusNJt#a0989056-1313-49bc-becd-e11c7e9337eb
 * {
 * "payment_id": "5745459419",
 * "payment_status": "waiting",
 * "pay_address": "3EZ2uTdVDAMFXTfc6uLDDKR6o8qKBZXVkj",
 * "price_amount": 3999.5,
 * "price_currency": "usd",
 * "pay_amount": 0.17070286,
 * "pay_currency": "btc",
 * "order_id": "RGDBP-21314",
 * "order_description": "Apple Macbook Pro 2019 x 1",
 * "ipn_callback_url": "https://nowpayments.io",
 * "created_at": "2020-12-22T15:00:22.742Z",
 * "updated_at": "2020-12-22T15:00:22.742Z",
 * "purchase_id": "5837122679",
 * "amount_received": null,
 * "payin_extra_id": null,
 * "smart_contract": "",
 * "network": "btc",
 * "network_precision": 8,
 * "time_limit": null,
 * "burning_percent": null,
 * "expiration_estimate_date": "2020-12-23T15:00:22.742Z"
 * }
 */
final readonly class PaymentDTO
{
    public function __construct(
        public string $payment_id,
        public string $payment_status,
        public string $pay_address,
        public float $price_amount,
        public string $price_currency,
        public float $pay_amount,
        public string $pay_currency,
        public string $order_id,
        public string $order_description,
        public string $ipn_callback_url,
        public string $created_at,
        public string $updated_at,
        public string $purchase_id,
        public ?float $amount_received,
        public ?string $payin_extra_id,
        public string $smart_contract,
        public string $network,
        public int $network_precision,
        public ?int $time_limit,
        public ?string $burning_percent,
        public ?string $expiration_estimate_date,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            payment_id: $data['payment_id'],
            payment_status: $data['payment_status'],
            pay_address: $data['pay_address'],
            price_amount: (float) $data['price_amount'],
            price_currency: $data['price_currency'],
            pay_amount: (float) $data['pay_amount'],
            pay_currency: $data['pay_currency'],
            order_id: $data['order_id'],
            order_description: $data['order_description'],
            ipn_callback_url: $data['ipn_callback_url'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
            purchase_id: $data['purchase_id'],
            amount_received: $data['amount_received']                   ?? null,
            payin_extra_id: $data['payin_extra_id']                     ?? null,
            smart_contract: $data['smart_contract'],
            network: $data['network'],
            network_precision: $data['network_precision'],
            time_limit: $data['time_limit']                             ?? null,
            burning_percent: $data['burning_percent']                   ?? null,
            expiration_estimate_date: $data['expiration_estimate_date'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'payment_id'               => $this->payment_id,
            'payment_status'           => $this->payment_status,
            'pay_address'              => $this->pay_address,
            'price_amount'             => $this->price_amount,
            'price_currency'           => $this->price_currency,
            'pay_amount'               => $this->pay_amount,
            'pay_currency'             => $this->pay_currency,
            'order_id'                 => $this->order_id,
            'order_description'        => $this->order_description,
            'ipn_callback_url'         => $this->ipn_callback_url,
            'created_at'               => $this->created_at,
            'updated_at'               => $this->updated_at,
            'purchase_id'              => $this->purchase_id,
            'amount_received'          => $this->amount_received,
            'payin_extra_id'           => $this->payin_extra_id,
            'smart_contract'           => $this->smart_contract,
            'network'                  => $this->network,
            'network_precision'        => $this->network_precision,
            'time_limit'               => $this->time_limit,
            'burning_percent'          => $this->burning_percent,
            'expiration_estimate_date' => $this->expiration_estimate_date,
        ];
    }
}
