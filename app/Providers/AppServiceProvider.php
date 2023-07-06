<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Quotation;
use App\Observers\QuotationObserver;
use App\Models\MovingJob;
use App\Observers\MovingJobObserver;
use App\Models\EmailTemplates;

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
        EmailTemplates::observe(EmailTemplatesObserver::class);
    }
}
