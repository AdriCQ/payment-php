<?php

namespace AdriCQ\Payment\DTOs;

final class InvoiceMetadataDTO
{
    public function __construct(
        public string $payableClass,
        public string $payableId,
        public string $currency,
        public ?string $confirmationUrl=null,
        public ?string $cancelUrl=null
    ) {}

    public function toArray(): array
    {
        return [
            'payable_class'    => $this->payableClass,
            'payable_id'       => $this->payableId,
            'currency'         => $this->currency,
            'confirmation_url' => $this->confirmationUrl,
            'cancel_url'       => $this->cancelUrl,
        ];
    }
}
