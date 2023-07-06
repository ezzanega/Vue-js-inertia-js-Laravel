<?php

namespace App\Observers;

use App\Models\Quotation;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuotationObserver
{
    public function creating(Quotation $quotation): void
    {
        $date = Carbon::now();

        $number = Str::of(strval($date->format('d')))->append(strval($date->format('m')));
        $number = Str::of($number)->append(strval($date->year));
        $organization = Auth::user()->organization;
        $quotationCount = Quotation::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->where('organization_id', $organization->id)
            ->count();

        $number = Str::of($number)->append(strval(str_pad(($quotationCount + 1), 3, '0', STR_PAD_LEFT)));

        $quotation->number = $number;
        $quotation->uuid = Str::uuid();
    }
}
