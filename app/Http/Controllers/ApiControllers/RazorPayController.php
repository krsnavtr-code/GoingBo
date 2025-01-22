<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Razorpay\Api\Api as RazorPay;
use Illuminate\Support\Str;
use Razorpay\Api\Order;

class RazorPayController extends Controller
{
    /** Used for production uses */
    private const KEY = "rzp_live_dAEsKFUouC2mC1";
    /** Used for production uses */
    private const SECRET = "KuYcWHRsmt2QPQUK6CIucJFG";

    /* Used For testing Purpose*/
    // private const KEY = "rzp_test_oM8x2ntvPFROyc";
    /* Used For testing Purpose*/
    // private const SECRET = "TicFydp4doL4ZHAH3elLig6Z";



    static function make_order($amount)
    {
        $razorPay = new Razorpay(self::KEY, self::SECRET);
        $orderId = Str::random(5) . now()->timestamp . Str::random(5);
        $orderData = [
            'receipt' => $orderId,
            'amount' => $amount * 100,
            'currency' => 'INR'
        ];
        return [
            "key" => self::KEY,
            "order" => $razorPay->order->create($orderData)
        ];
    }
    static function verify_signature($OrderId, $PaymentId, $Signature)
    {
        $razorPay = new Razorpay(self::KEY, self::SECRET);
        $data = [
            'razorpay_order_id' => $OrderId,
            'razorpay_payment_id' => $PaymentId,
            'razorpay_signature' => $Signature
        ];
        try {
            $razorPay->utility->verifyPaymentSignature($data);
            $success = ["success" => true] + $data;
        } catch (\Throwable $th) {
            $success = false;
        }
        return $success;
    }
    static function confirm_payment($orderId)
    {
    }
}
