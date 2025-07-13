<?php

namespace AdriCQ\Payment;

use AdriCQ\Payment\Contracts\PaymentServiceContract;
use AdriCQ\Payment\Services\ElToque\ElToqueService;
use AdriCQ\Payment\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

final class PaymentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/payment.php' => config_path('payment.php'),
        ]);
    }

    public function register(): void
    {
        app()->singleton(PaymentServiceContract::class, PaymentService::class);
        app()->singleton(ElToqueService::class, fn () => ElToqueService::make());
    }
}
