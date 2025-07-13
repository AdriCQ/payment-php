<?php

namespace AdriCQ\Payment\Services\NowPayment\Helpers;

final class ConfigHelper
{
    public static function webhookFullUrl(): string
    {
        return config('app.url') . self::webhookUrl();
    }

    public static function webhookUrl(): string
    {
        return config('payment.webhook_url');
    }

    public static function apiUrl(): string
    {
        return config('payment.now_payments.url');
    }

    public static function apiKey(): string
    {
        return config('payment.now_payments.secret_token');
    }

    public static function successInvoiceUrl(): string
    {
        return config('payment.now_payments.invoice.success_url');
    }

    public static function cancelInvoiceUrl(): string
    {
        return config('payment.now_payments.invoice.cancel_url');
    }

    public static function webhookToken(): string
    {
        return config('payment.now_payment.webhook.token');
    }
}
