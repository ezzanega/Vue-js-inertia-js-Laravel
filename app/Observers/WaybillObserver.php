<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Waybill;
use Illuminate\Support\Facades\Auth;

class WaybillObserver
{
    public function creating(Waybill $waybill): void
    {
        $date = Carbon::now();

        $number = Str::of(strval($date->format('d')))->append(strval($date->format('m')));
        $number = Str::of($number)->append(strval($date->year));
        $organization = Auth::user()->organization;
        $waybillCount = Waybill::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->where('organization_id', $organization->id)
            ->count();

        $number = Str::of($number)->append(strval(str_pad(($waybillCount + 1), 3, '0', STR_PAD_LEFT)));

        $waybill->number = $number;
        $waybill->uuid = Str::uuid();
    }
}
