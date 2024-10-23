<?php

namespace App\Providers;

use App\MyClasses\MyServiceInterface;
use App\MyClasses\MyServiceSet;
use App\MyClasses\PowerMyServiceSet;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MyServiceSet::class, function () {
            $myservice = new MyServiceSet(1);
            $myservice->setId(0);
            return $myservice;
        });
        $this->app->singleton('myservice', PowerMyServiceSet::class);
        $this->app->singleton(MyServiceInterface::class, PowerMyServiceSet::class);
        echo "MyServiceProvider/register<br>";
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        echo "MyServiceProvider/boot<br>";
    }
}
