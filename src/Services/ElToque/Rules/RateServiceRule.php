<?php

namespace AdriCQ\Payment\Services\ElToque\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

final class RateServiceRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = Validator::make($value, [
            'tasas'            => ['required', 'array'],
            'tasas.TRX'        => ['required', 'numeric'],
            'tasas.BTC'        => ['required', 'numeric'],
            'tasas.MLC'        => ['required', 'numeric'],
            'tasas.ECU'        => ['required', 'numeric'],
            'tasas.USDT_TRC20' => ['required', 'numeric'],
            'tasas.USD'        => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            $fail($validator->messages());
        }
    }
}
