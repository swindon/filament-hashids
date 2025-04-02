<?php

namespace Swindon\FilamentHashids\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Swindon\FilamentHashids\Middleware\FilamentHashidsMiddleware;
use Swindon\FilamentHashids\Console\Commands\InstallHashidsCommand;

class FilamentHashidsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/filament-hashids.php', 'filament-hashids');
    }

    public function boot()
    {
        // Publish config file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/filament-hashids.php' => config_path('filament-hashids.php'),
            ], 'config');

            // Register Artisan command for installation
            $this->commands([
                InstallHashidsCommand::class,
            ]);
        }

        // Register middleware alias
        $this->app['router']->aliasMiddleware('filament-hashids', FilamentHashidsMiddleware::class);

        // Register the Blade directive for generating Hashids in templates.
        Blade::directive('hashid', function ($expression) {
            // Assumes the expression is a model instance
            return "<?php echo \\Swindon\\FilamentHashids\\Support\\HashidsManager::encode(($expression)->getKey()); ?>";
        });
    }
}
