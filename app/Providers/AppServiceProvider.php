<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::composer(
            'layouts.website', 'App\Http\View\Composers\FrontPageComposer'
        );
        View::composer(
            'layouts.admin', 'App\Http\View\Composers\AdminSettingComposer'
        );
    }
}
