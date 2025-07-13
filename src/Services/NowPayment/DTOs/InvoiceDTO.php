<?php

namespace AdriCQ\Payment\Services\NowPayment\DTOs;

use AdriCQ\Payment\DTOs\InvoiceDTO as GenericInvoiceDTO;

/**
 * @ref https://documenter.getpostman.com/view/7907941/2s93JusNJt#f5e4e645-dce2-4b06-b2ca-2a29aaa5e845
 */
final class InvoiceDTO extends GenericInvoiceDTO
{
    public function __construct(
        public string $id,
        public string $order_id,
        public string $order_description,
        public string $price_amount,
        public string $price_currency,
        public ?string $pay_currency = null,
        public string $ipn_callback_url = '',
        public string $invoice_url = '',
        public string $success_url = '',
        public string $cancel_url = '',
        public string $created_at = '',
        public string $updated_at = ''
    ) {
        parent::__construct(
            id: $id,
            order_id: $order_id,
            order_description: $order_description,
            price_amount: $price_amount,
            price_currency: $price_currency,
            invoice_url: $invoice_url,
        );
    }

    /**
     * Create a new instance from an array of data.
     *
     * @param array{
     *      "id": "4522625843",
     *      "order_id": "RGDBP-21314",
     *      "order_description": "Apple Macbook Pro 2019 x 1",
     *      "price_amount": "1000",
     *      "price_currency": "usd",
     *      "pay_currency": null,
     *      "ipn_callback_url": "https://nowpayments.io",
     *      "invoice_url": "https://nowpayments.io/payment/?iid=4522625843",
     *      "success_url": "https://nowpayments.io",
     *      "cancel_url": "https://nowpayments.io",
     *      "created_at": "2020-12-22T15:05:58.290Z",
     *      "updated_at": "2020-12-22T15:05:58.290Z"
     * } $data
     */
    public static function make(array $data): self
    {
        return new self(
            id: $data['id']                               ?? '',
            order_id: $data['order_id']                   ?? '',
            order_description: $data['order_description'] ?? '',
            price_amount: $data['price_amount']           ?? '',
            price_currency: $data['price_currency']       ?? '',
            pay_currency: $data['pay_currency']           ?? null,
            ipn_callback_url: $data['ipn_callback_url']   ?? '',
            invoice_url: $data['invoice_url']             ?? '',
            success_url: $data['success_url']             ?? '',
            cancel_url: $data['cancel_url']               ?? '',
            created_at: $data['created_at']               ?? '',
            updated_at: $data['updated_at']               ?? ''
        );
    }

    /**
     * Convert the object to its array representation.
     */
    public function toArray(): array
    {
        return [
            'id'                => $this->id,
            'order_id'          => $this->order_id,
            'order_description' => $this->order_description,
            'price_amount'      => $this->price_amount,
            'price_currency'    => $this->price_currency,
            'pay_currency'      => $this->pay_currency,
            'ipn_callback_url'  => $this->ipn_callback_url,
            'invoice_url'       => $this->invoice_url,
            'success_url'       => $this->success_url,
            'cancel_url'        => $this->cancel_url,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
