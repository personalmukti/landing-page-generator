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

            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views'),
                __DIR__ . '/../../resources/stubs' => resource_path('stubs'),
                __DIR__ . '/../../config/mlab-menu.php' => config_path('mlab-menu.php'),
            ], 'mlab-views');

            $this->publishes([
                __DIR__ . '/../../resources/views/layouts' => resource_path('views/layouts'),
            ], 'mlab-layouts');

            $this->publishes([
                __DIR__ . '/../../config/mlab-menu.php' => config_path('mlab-menu.php'),
            ], 'mlab-menu-config');
        }
    }

    public function register()
    {
        // Autoload
        $this->app->booted(function () {
            $this->autoload();
        });
    }

    protected function autoload()
    {
        // Autoload PSR-4
        $autoload = [
            'psr-4' => [
                'Mlab\\LandingPageGenerator\\' => '/src',
            ],
        ];

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        if (isset($composer['autoload'])) {
            $composer['autoload'] = array_merge_recursive($composer['autoload'], $autoload);
        } else {
            $composer['autoload'] = $autoload;
        }

        file_put_contents(base_path('composer.json'), json_encode($composer, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        // Dump autoload
        exec('composer dump-autoload');
    }
}
