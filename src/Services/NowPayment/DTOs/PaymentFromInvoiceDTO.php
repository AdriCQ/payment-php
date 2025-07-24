<?php

namespace AdriCQ\Payment\Services\NowPayment\DTOs;

/**
 * @see https://documenter.getpostman.com/view/7907941/2s93JusNJt#a0989056-1313-49bc-becd-e11c7e9337eb
 * {
 * "iid": {{invoice_id}},
 * "pay_currency": "btc",
 * "purchase_id": {{purchase_id}},
 * "order_description": "Apple Macbook Pro 2019 x 1",
 * "customer_email": "test@gmail.com",
 * "payout_address": "0x...",
 * "payout_extra_id": null,
 * "payout_currency": "usdttrc20"
 * }.
 */
final readonly class PaymentFromInvoiceDTO
{
    public function __construct(
        public string $invoice_id,
        public string $pay_currency,
        public string $purchase_id,
        public string $order_description,
        public string $customer_email,
        public string $payout_address,
        public ?string $payout_extra_id,
        public string $payout_currency,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            invoice_id: $data['iid'],
            pay_currency: $data['pay_currency'],
            purchase_id: $data['purchase_id'],
            order_description: $data['order_description'],
            customer_email: $data['customer_email'],
            payout_address: $data['payout_address'],
            payout_extra_id: $data['payout_extra_id'],
            payout_currency: $data['payout_currency'],
        );
    }

    public function toArray(): array
    {
        return [
            'iid'               => $this->invoice_id,
            'pay_currency'      => $this->pay_currency,
            'purchase_id'       => $this->purchase_id,
            'order_description' => $this->order_description,
            'customer_email'    => $this->customer_email,
            'payout_address'    => $this->payout_address,
            'payout_extra_id'   => $this->payout_extra_id,
            'payout_currency'   => $this->payout_currency,
        ];
    }
}
