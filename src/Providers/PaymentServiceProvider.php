<?php

namespace AdriCQ\Payment\Providers;

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
//        $this->forceTestEnvs();
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/payment.php', 'payment'
        );

        app()->singleton(PaymentServiceContract::class, PaymentService::class);
        app()->singleton(ElToqueService::class, fn () => ElToqueService::make());
    }

    private function forceTestEnvs(): void
    {
        // 👇 Ir 2 niveles arriba desde /src para llegar a raíz del paquete
        $rootPath = dirname(__DIR__, 2);
        $envFile = $rootPath . '/.env';

        if (file_exists($envFile)) {
            echo "✅ Loading .env from: $envFile" . PHP_EOL;
            $dotenv = \Dotenv\Dotenv::createImmutable($rootPath);
            $dotenv->load();

            foreach ($_ENV as $key => $value) {
                putenv("$key=$value");
            }
        } else {
            echo "⚠️ .env file not found at $envFile" . PHP_EOL;
        }
    }
}
