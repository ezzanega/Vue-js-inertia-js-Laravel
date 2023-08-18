<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'payment_channel' => 'required',
            'reference' => 'required',
        ]);
        Payment::create($validated);
        return back();
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        $validated = $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'payment_channel' => 'required',
            'reference' => 'required',
        ]);
        $payment->update($validated);
        return back();
    }
}
