<?php

namespace Tests\Unit;

use AdriCQ\Payment\DTOs\InvoiceMetadataDTO;
use AdriCQ\Payment\Services\PaymentService;
use Illuminate\Http\Client\ConnectionException;
use Tests\TestCase;

final class NowPaymentTest extends TestCase
{
    public function test_create_invoice(): void
    {
        $paymentService = app(PaymentService::class);

        try {
            $invoice      = $paymentService->createInvoice(
                amount: 100,
                description: 'Test Invoice',
                metadata: new InvoiceMetadataDTO(
                    payableClass: self::class,
                    payableId: '123',
                    currency: 'usd'
                )
            );
            $invoiceArray = $invoice->toArray();

            $this->assertNotNull($invoice);
            $this->assertIsArray($invoiceArray);
            $this->assertArrayHasKey('id', $invoiceArray);
            $this->assertArrayHasKey('invoice_url', $invoiceArray);
            $this->assertTrue((bool) filter_var($invoiceArray['invoice_url'], FILTER_VALIDATE_URL));

            echo 'Now payment Invoice URL: ' . $invoiceArray['invoice_url'];
        } catch (ConnectionException $e) {
            echo 'Invoice Error: ' . $e->getMessage();
        }
    }
}
