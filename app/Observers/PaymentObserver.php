<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\MovingJob;
use App\Models\Quotation;
use App\Models\Enums\InvoiceStatus;
use Illuminate\Support\Facades\Auth;
use App\Models\Enums\QuotationStatus;

class PaymentObserver
{
    public function created(Payment $payment): void
    {
        $organization = Auth::user()->organization;
        $quotation = Quotation::find($payment->quotation_id);
        $settings = Settings::where('organization_id', $organization->id)->first();
        $movingjob = MovingJob::where('id', $quotation->moving_job_id)->first();
        $invoice = Invoice::create([
            'type' => $payment->type,
            'date' => now(),
            'amount_ht' => $payment->amount,
            'amount_ttc' => number_format(floatval($payment->amount) + (floatval($payment->amount) * floatval($settings->vat) / 100), 2, '.', ''),
            'amount_tva' => number_format((floatval($payment->amount) * floatval($settings->vat)) / 100, 2, '.', ''),
            'organization_id' => $organization->id,
            'status' => InvoiceStatus::PAID
        ]);

        $quotation->update([
            'status' => QuotationStatus::ACCEPTED,
        ]);

        $invoice->movingJob()->associate($movingjob);
        $invoice->save();
    }
}
