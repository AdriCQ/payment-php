<?php

namespace AdriCQ\Payment\Enums;

/**
 * waiting - waiting for the customer to send the payment. The initial status of each payment;
 * confirming - the transaction is being processed on the blockchain. Appears when NOWPayments detect the funds from the user on the blockchain;
 * confirmed - the process is confirmed by the blockchain. Customer’s funds have accumulated enough confirmations;
 * sending - the funds are being sent to your personal wallet. We are in the process of sending the funds to you;
 * partially_paid - it shows that the customer sent the less than the actual price. Appears when the funds have arrived in your wallet;
 * finished - the funds have reached your personal address and the payment is finished;
 * failed - the payment wasn't completed due to the error of some kind;
 * refunded - the funds were refunded back to the user;
 * expired - the user didn't send the funds to the specified address in the 7 days time window;.
 */
enum PaymentStatus: string
{
    case Waiting       = 'waiting';
    case Confirming    = 'confirming';
    case Confirmed     = 'confirmed';
    case Sending       = 'sending';
    case PartiallyPaid = 'partially_paid';
    case Finished      = 'finished';
    case Failed        = 'failed';
    case Refunded      = 'refunded';
    case Expired       = 'expired';
}
