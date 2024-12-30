<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function qrisPayment($code)
    {
        // Decode QRIS code
        $decodedCode = urldecode($code);
        
        // TODO: Implement actual QRIS payment processing
        // For now, we'll just pass the code to the view
        return view('payment.qris', [
            'qrisCode' => $decodedCode
        ]);
    }

    public function manualPayment()
    {
        return view('payment.manual');
    }
}
