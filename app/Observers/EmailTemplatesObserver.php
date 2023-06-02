<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\EmailTemplates;

class EmailTemplatesObserver
{
    public function creating(EmailTemplates $emailTemplate): void
    {
        $emailTemplate->uuid = Str::uuid();
    }
}
