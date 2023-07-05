<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Quotation;

class QuotationObserver
{
    public function creating(Quotation $quotation): void
    {
        $quotation->uuid = Str::uuid();
    }
}
