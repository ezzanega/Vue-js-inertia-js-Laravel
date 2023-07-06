<?php

namespace App\Observers;

use App\Models\MovingJob;
use Illuminate\Support\Str;

class MovingJobObserver
{
    public function creating(MovingJob $movingjob): void
    {
        $movingjob->uuid = Str::uuid();
    }
}
