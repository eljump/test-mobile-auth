<?php

namespace App\Providers;

use App\Services\SmsSenders\SMSRUSender;
use App\Services\SmsSenders\SmsSenderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        SmsSenderInterface::class => SMSRUSender::class,
    ];
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
        //
    }
}
