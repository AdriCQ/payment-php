<?php

namespace AdriCQ\Payment\DTOs;

class InvoiceDTO
{
    public function __construct(
        public string $id,
        public string $order_id,
        public string $order_description,
        public string $price_amount,
        public string $price_currency,
        public string $invoice_url,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            id: $data['id'],
            order_id: $data['order_id'],
            order_description: $data['order_description'],
            price_amount: $data['price_amount'],
            price_currency: $data['price_currency'],
            invoice_url: $data['invoice_url'],
        );

    }
}
