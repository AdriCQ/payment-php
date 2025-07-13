<?php

namespace AdriCQ\Payment\Services\ElToque\DTOs;

final class CurrencyRateDTO
{
    public function __construct(
        public float $USD = 0,
        public float $EUR = 0,
        public float $MLC = 0,
        public float $Zelle = 0,
        public float $CUP = 0,
        public float $USDT_TRC20 = 0,
        public float $TRX = 0,
        public float $BTC = 0,
        public float $QvaPay = 0,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            USD: $data['USD']               ?? 0,
            EUR: $data['EUR']               ?? $data['ECU'] ?? 0,
            MLC: $data['MLC']               ?? 0,
            Zelle: $data['Zelle']           ?? 0,
            CUP: $data['CUP']               ?? 0,
            USDT_TRC20: $data['USDT_TRC20'] ?? 0,
            TRX: $data['TRX']               ?? 0,
            BTC: $data['BTC']               ?? 0,
            QvaPay: $data['QvaPay']         ?? 0,
        );
    }

    public function toArray(): array
    {
        return [
            'USD'        => $this->USD,
            'EUR'        => $this->EUR,
            'MLC'        => $this->MLC,
            'CUP'        => $this->CUP,
            'USDT_TRC20' => $this->USDT_TRC20,
            'TRX'        => $this->TRX,
            'BTC'        => $this->BTC,
            'Zelle'      => $this->Zelle,
            'QvaPay'     => $this->QvaPay,
        ];
    }
}
