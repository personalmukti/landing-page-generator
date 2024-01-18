<?php

namespace Mlab\LandingPageGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ConfigureMlabPackage extends Command
{
    protected $signature = 'mlab:configure-package';
    protected $description = 'Configure Mlab Package';

    public function handle()
    {
        $this->info('Configuring Mlab Package...');

        // 1. Tambahkan autoload PSR-4 jika belum ada
        $autoloadPath = base_path('composer.json');
        $composer = json_decode(file_get_contents($autoloadPath), true);

        if (!isset($composer['autoload']['psr-4']['Mlab\\LandingPageGenerator\\'])) {
            $composer['autoload']['psr-4']['Mlab\\LandingPageGenerator\\'] = 'src/';
            File::put($autoloadPath, json_encode($composer, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            $this->info('Autoload PSR-4 added successfully.');
        } else {
            $this->info('Autoload PSR-4 already exists.');
        }

        // 2. Daftarkan service provider jika belum terdaftar
        $configPath = config_path('app.php');
        $configContent = File::get($configPath);

        if (strpos($configContent, 'Mlab\LandingPageGenerator\LandingPageGeneratorServiceProvider::class') === false) {
            $providerLine = "Mlab\\LandingPageGenerator\\LandingPageGeneratorServiceProvider::class,";
            File::put($configPath, str_replace(
                "'providers' => [",
                "'providers' => [" . PHP_EOL . "    {$providerLine}",
                $configContent
            ));
            $this->info('Service Provider registered successfully.');
        } else {
            $this->info('Service Provider already registered.');
        }

        $this->info('Mlab Package configured successfully!');
    }
}
