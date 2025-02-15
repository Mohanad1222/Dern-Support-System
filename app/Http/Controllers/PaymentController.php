<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function updatePayment(Request $request, $payment){
        $payment = Payment::where('request_id', $payment);

        $payment->update([
            "payment_amount" => $request->payment_amount,
            "payment_method" => $request->payment_method,
            "payment_status" => $request->payment_status
        ]);

        return redirect()->back();

    }
}
