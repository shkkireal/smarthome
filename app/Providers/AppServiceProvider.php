<?php

namespace App\Providers;

use App\Models\DutyCycle;
use App\Models\ReferenceTemp;
use App\Models\Temp;
use App\Models\TermoHead;
use App\Observers\DutyCycleObserver;
use App\Observers\ReferenceTempObserver;
use App\Observers\TempObserver;
use App\Observers\TermoHeadObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    DutyCycle::observe(DutyCycleObserver::class);
    ReferenceTemp::observe(ReferenceTempObserver::class);
    Temp::observe(TempObserver::class);
    TermoHead::observe(TermoHeadObserver::class);
    }
}
