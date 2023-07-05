<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Waybill;

class WaybillObserver
{
    public function creating(Waybill $waybill): void
    {
        $waybill->uuid = Str::uuid();
    }
}
