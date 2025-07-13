<?php

return [
    'el_toque'     => [
        'url'   => env('EL_TOQUE_URL'),
        'token' => env('EL_TOQUE_TOKEN'),
        'ttl'   => env('EL_TOQUE_CACHE_TTL', 12 * 60 * 60),
    ],

    'qvapay'       => [
        'url'        => env('QVAPAY_URL'),
        'app_id'     => env('QVAPAY_APP_ID'),
        'app_secret' => env('QVAPAY_APP_SECRET'),
    ],

    'now_payments' => [
        'currency'       => env('NOW_PAYMENTS_CURRENCY', 'usdttrc20'),
        'url'            => env('NOW_PAYMENTS_URL', 'https://api.nowpayments.io/v1'),
        'public_token'   => env('NOW_PAYMENTS_PUBLIC_TOKEN'),
        'secret_token'   => env('NOW_PAYMENTS_SECRET_TOKEN'),
        'webhook'        => [
            'url'   => env('NOW_PAYMENTS_WEBHOOK_URL', '/webhook/now-payments'),
            'token' => env('NOW_PAYMENTS_WEBHOOK_TOKEN'),
        ],
        'invoice'        => [
            'success_url' => env('NOW_PAYMENTS_SUCCESS_URL'),
            'cancel_url'  => env('NOW_PAYMENTS_CANCEL_URL'),
        ],
    ],
];
