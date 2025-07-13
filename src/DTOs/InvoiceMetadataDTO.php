<?php

namespace AdriCQ\Payment\DTOs;

final class InvoiceMetadataDTO
{
    public function __construct(
        public string $payableClass,
        public string $payableId,
        public string $currency
    ) {}
}
