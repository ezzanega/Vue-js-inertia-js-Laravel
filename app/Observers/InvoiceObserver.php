<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Invoice;

class InvoiceObserver
{
    public function creating(Invoice $invoice): void
    {
        $invoice->uuid = Str::uuid();
    }
}
