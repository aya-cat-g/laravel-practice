<?php

namespace App\Providers;

use App\MyClasses\MyService;
use App\MyClasses\MyServiceInterface;
use App\MyClasses\MyServiceSet;
use App\MyClasses\PowerMyServiceSet;
use Illuminate\Support\ServiceProvider;

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
        config(['sample.data' => ['プロバイダ', 'で', '変更']]);
    }
}
