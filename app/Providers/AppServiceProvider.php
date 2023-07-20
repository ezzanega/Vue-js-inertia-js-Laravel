<?php

namespace App\Providers;

use App\Models\User;
use App\Models\MovingJob;
use App\Models\Quotation;
use App\Models\Waybill;
use App\Models\EmailTemplates;
use App\Models\Organization;
use App\Observers\UserObserver;
use App\Observers\MovingJobObserver;
use App\Observers\QuotationObserver;
use App\Observers\WaybillObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\EmailTemplatesObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(125);
        User::observe(UserObserver::class);
        Quotation::observe(QuotationObserver::class);
        MovingJob::observe(MovingJobObserver::class);
        Waybill::observe(WaybillObserver::class);
        EmailTemplates::observe(EmailTemplatesObserver::class);
    }
}
