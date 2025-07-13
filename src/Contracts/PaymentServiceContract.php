<?php

namespace AdriCQ\Payment\Contracts;

use AdriCQ\Payment\DTOs\InvoiceDTO;
use AdriCQ\Payment\DTOs\InvoiceMetadataDTO;
use AdriCQ\Payment\Services\NowPayment\DTOs\PaymentStatusDTO;

interface PaymentServiceContract
{
    public function createInvoice(float $amount, string $description, InvoiceMetadataDTO $metadata): InvoiceDTO;

    public function serviceStatus(): bool;

    public function paymentStatus(string $paymentId): PaymentStatusDTO;
}
