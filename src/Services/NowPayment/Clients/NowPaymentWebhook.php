<?php

namespace AdriCQ\Payment\Services\NowPayment\Clients;

use AdriCQ\Payment\Services\NowPayment\DTOs\PaymentStatusDTO;
use AdriCQ\Payment\Services\NowPayment\Helpers\ConfigHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

abstract class NowPaymentWebhook extends Controller
{
    private string $ipn_secret;

    public function __construct()
    {
        $this->ipn_secret = ConfigHelper::webhookToken();
    }

    public function handle(Request $request): void
    {
        if ($this->isValid($request)) {
            $payment = PaymentStatusDTO::make($request->all());
            Log::info('NowPayment webhook: ' . $payment->payment_id, [
                'status' => $payment->payment_status,
                'id'     => $payment->payment_id,
            ]);
        }
    }

    public function isValid(Request $request): bool
    {
        $error_msg = 'Unknown error';
        $signature = $request->server('X-NOWPAYMENTS-SIG');
        if (!empty($signature)) {
            $request_data        = $request->all();
            $this->tksort($request_data);
            $sorted_request_json = json_encode($request_data, JSON_UNESCAPED_SLASHES);
            if (!empty($request_data)) {
                $hmac = hash_hmac('sha512', $sorted_request_json, trim($this->ipn_secret));
                if ($hmac == $signature) {
                    return true;
                } else {
                    $error_msg = 'HMAC signature does not match';
                }
            } else {
                $error_msg = 'Error reading POST data';
            }
        } else {
            $error_msg = 'No HMAC signature sent.';
        }
        Log::error('NowPayment webhook error: ' . $error_msg);

        return false;
    }

    private function tksort(&$array)
    {
        ksort($array);
        foreach (array_keys($array) as $k) {
            if (gettype($array[$k]) == 'array') {
                $this->tksort($array[$k]);
            }
        }
    }
}
