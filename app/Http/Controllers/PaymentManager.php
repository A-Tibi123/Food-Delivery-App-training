<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentManager extends Controller
{
    // Fetch all active payments ordered by position
    public function getActivePayments()
    {
        $payments = Payment::where('active', true)
            ->orderBy('position', 'asc')
            ->get();

        return response()->json($payments);
    }

    // Mark a payment as active or inactive
    public function markStatus(Request $request, $status)
    {
        $payment = Payment::find($request->input('payment_id'));

        if (!$payment) {
            return response("failed", 404);
        }

        $payment->active = $status === 'active';
        $payment->save();

        return response("success");
    }

    public function activate(Request $request)
    {
        return $this->markStatus($request, 'active');
    }

    public function deactivate(Request $request)
    {
        return $this->markStatus($request, 'inactive');
    }
}