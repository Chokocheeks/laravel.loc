<?php

namespace App\Providers;

use App\Contracts\CurServiceInteface;
use App\Services\AnotherCurService;
use Illuminate\Support\ServiceProvider;

class DiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CurServiceInteface::class, AnotherCurService::class);
        // $this->app->singleton(CurServiceInteface::class, new AnotherCurService);
    }
}
