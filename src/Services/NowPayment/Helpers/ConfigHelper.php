<?php

namespace AdriCQ\Payment\Services\NowPayment\Helpers;

final class ConfigHelper
{
    public static function paymentCurrency(): string
    {
        return config('payment.now_payments.currency', 'usdttrc20');
    }

    public static function webhookFullUrl(): string
    {
        return config('app.url', 'http://localhost:8000') . self::webhookUrl();
    }

    public static function webhookUrl(): string
    {
        return config('payment.now_payments.webhook.url', '/api/now-payment/webhook');
    }

    public static function apiUrl(): string
    {
        return config('payment.now_payments.url', 'https://api.nowpayments.io');
    }

    public static function apiKey(): ?string
    {
        return config('payment.now_payments.secret_token', 'secret_token');
    }

    public static function successInvoiceUrl(): string
    {
        return config('payment.now_payments.invoice.success_url', 'http://localhost:8000');
    }

    public static function cancelInvoiceUrl(): ?string
    {
        return config('payment.now_payments.invoice.cancel_url', 'http://localhost:8000');
    }

    public static function webhookToken(): ?string
    {
        return config('payment.now_payments.webhook.token', 'token');
    }

    public static function feePaidByUser(): bool
    {
        return config('payment.now_payments.fee_paid_by_user', true);
    }
}
