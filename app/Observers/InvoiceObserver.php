<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class InvoiceObserver
{
    public function creating(Invoice $invoice): void
    {
        $date = Carbon::now();

        $number = Str::of(strval($date->format('d')))->append(strval($date->format('m')));
        $number = Str::of($number)->append(strval($date->year));
        $organization = Auth::user()->organization;
        $invoiceCount = Invoice::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->where('organization_id', $organization->id)
            ->count();

        $number = Str::of($number)->append(strval(str_pad(($invoiceCount + 1), 3, '0', STR_PAD_LEFT)));

        $invoice->number = $number;
        $invoice->uuid = Str::uuid();
    }
}
