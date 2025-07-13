<?php

namespace Tests\Unit;

use AdriCQ\Payment\Services\ElToque\ElToqueService;
use Tests\TestCase;

final class ElToqueTest extends TestCase
{
    public function test_currency_rates(): void
    {
        $elToque = app(ElToqueService::class);
        $rates   = $elToque->run()->toArray();
        $this->assertArrayHasKey('CUP', $rates);
        $this->assertArrayHasKey('Zelle', $rates);
        $this->assertArrayHasKey('USD', $rates);
    }
}
