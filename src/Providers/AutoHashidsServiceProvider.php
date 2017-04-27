<?php

namespace Shalvah\AutoHashids\Providers;

use Illuminate\Support\Facades\Config;
use Shalvah\AutoHashids\Observers\AutoHashidsObserver;
use Illuminate\Support\ServiceProvider;

class AutoHashidsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $models = Config::get("hashids.models");
        foreach ($models as $model) {
            $model::observe(AutoHashidsObserver::class);
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
