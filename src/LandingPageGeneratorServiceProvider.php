<?php

namespace Mlab\LandingPageGenerator;

use Illuminate\Support\ServiceProvider;
use Mlab\LandingPageGenerator\Commands\GenerateLandingPage;

class LandingPageGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateLandingPage::class,
            ]);
        }
    }

    public function register()
    {
        // ...
    }
}
