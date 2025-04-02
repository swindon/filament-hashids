<?php

namespace Swindon\FilamentHashids\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Swindon\FilamentHashids\Middleware\DecodeHashidsMiddleware;
use Swindon\FilamentHashids\Console\Commands\InstallHashidsCommand;
use Swindon\FilamentHashids\Filament\HashidsPlugin;

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
        $this->app['router']->aliasMiddleware('decode-hashids', DecodeHashidsMiddleware::class);

        // Register the Filament Plugin for integration
        Filament::registerPlugin(HashidsPlugin::class);

        // Register the Blade directive for generating Hashids in templates.
        Blade::directive('hashid', function ($expression) {
            // Assumes the expression is a model instance
            return "<?php echo \\Swindon\\FilamentHashids\\Support\\HashidsManager::encode(($expression)->getKey()); ?>";
        });
    }
}
