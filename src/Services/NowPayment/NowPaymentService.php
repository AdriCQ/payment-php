<?php

namespace AdriCQ\Payment\Services\NowPayment;

use AdriCQ\Payment\Contracts\PaymentServiceContract;
use AdriCQ\Payment\DTOs\InvoiceMetadataDTO;
use AdriCQ\Payment\Services\NowPayment\Clients\NowPaymentClient;
use AdriCQ\Payment\Services\NowPayment\DTOs\PaymentDTO;
use AdriCQ\Payment\Services\NowPayment\DTOs\PaymentFromInvoiceDTO;
use AdriCQ\Payment\Services\NowPayment\DTOs\PaymentStatusDTO;
use Illuminate\Http\Client\ConnectionException;

readonly class NowPaymentService implements PaymentServiceContract
{
    private NowPaymentClient $client;

    public function __construct()
    {
        $this->client = new NowPaymentClient;
    }

    /**
     * @throws ConnectionException
     */
    public function createInvoice(float $amount, string $description, InvoiceMetadataDTO $metadata): DTOs\InvoiceDTO
    {
        return $this->client->invoice(
            amount: $amount,
            currency: $metadata->currency,
            orderId: $metadata->payableId,
            orderDescription: $description,
            confirmationUrl: $metadata->confirmationUrl,
            cancelUrl: $metadata->cancelUrl
        );
    }

    /**
     * @throws ConnectionException
     */
    public function serviceStatus(): bool
    {
        return $this->client->status();
    }

    /**
     * @throws ConnectionException
     */
    public function paymentStatus(string $paymentId): PaymentStatusDTO
    {
        return $this->client->paymentStatus($paymentId);
    }

    /**
     * @throws ConnectionException
     */
    public function createPaymentFromInvoice(PaymentFromInvoiceDTO $request): PaymentDTO
    {
        return $this->client->createPaymentFromInvoice($request);
    }
}
