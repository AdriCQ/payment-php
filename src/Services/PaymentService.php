<?php

namespace AdriCQ\Payment\Services;

use AdriCQ\Payment\Contracts\PaymentServiceContract;
use AdriCQ\Payment\Services\NowPayment\NowPaymentService;

final readonly class PaymentService extends NowPaymentService implements PaymentServiceContract {}
