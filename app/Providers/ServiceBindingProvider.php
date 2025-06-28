<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ServiceBindingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $servicesPath = app_path('Services');

        if (!File::exists($servicesPath)) {
            return;
        }

        foreach (File::directories($servicesPath) as $directory) {
            $serviceName = basename($directory); // e.g. Post
            $interface = "App\\Services\\$serviceName\\{$serviceName}ServiceInterface";
            $implementation = "App\\Services\\$serviceName\\{$serviceName}Service";

            if (interface_exists($interface) && class_exists($implementation)) {
                $this->app->bind($interface, $implementation);
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
