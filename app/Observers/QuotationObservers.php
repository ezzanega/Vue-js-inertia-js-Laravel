<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Quotation;
use Illuminate\Support\Carbon;

class QuotationObserver
{
    public function creating(Quotation $quotation): void
    {
        $date = Carbon::now();
        
        $number = Str::of(strval($date->day))->append(strval($date->month));
        $number = Str::of($number)->append(strval($date->year));
        $number = Str::of($number)->append(strval($quotation->id));

        $quotation->number = $number;
        $quotation->uuid = Str::uuid();
    }
}
