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

        app()->bind(MyServiceSet::class, function () {
            $myservice = new MyServiceSet(1);
            $myservice->setId(0);
            return $myservice;
        });
        // app()->when(MyServiceSet::class)->needs('$id')->give(1);

        app()->resolving(function ($obj, $app) {
            if (is_object($obj)) {
                echo get_class($obj) . '<br>';
            } else {
                echo $obj . '<br>';
            }
        });
        app()->resolving(PowerMyServiceSet::class, function ($obj, $app) {
            $obj->setId(1000);
        });

        app()->bind(MyServiceInterface::class, PowerMyServiceSet::class);
    }
}
