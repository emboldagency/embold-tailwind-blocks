<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\CustomBlockMakeCommand;

class EmboldServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Log1x\AcfComposer\Block', \App\CustomBlock::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__ . '/../../config/embold-tailwind-blocks.php' => $this->app->configPath('embold-tailwind-blocks.php'),
        ], 'embold-config');

        // Publish block class definitions
        $this->publishes([
            __DIR__ . '/../../app/Blocks' => $this->app->basePath('app/Blocks'),
        ], 'embold-blocks');

        // Publish block views
        $this->publishes([
            __DIR__ . '/../../resources/views/blocks' => resource_path('views/blocks'),
        ], 'embold-blocks');

        // Publish block styles
        $this->publishes([
            __DIR__ . '/../../resources/styles/blocks' => resource_path('styles/blocks'),
        ], 'embold-blocks');

        // Publish block scripts
        $this->publishes([
            __DIR__ . '/../../resources/scripts/blocks' => resource_path('scripts/blocks'),
        ], 'embold-blocks');

        // Publish field groups
        $this->publishes([
            __DIR__ . '/../../app/Fields' => base_path('app/Fields'),
        ], 'embold-fields');

        // Publish core modifiers
        $this->publishes([
            __DIR__ . '/../../app/Modifiers' => base_path('app/Modifiers'),
        ], 'embold-modifiers');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CustomBlockMakeCommand::class,
            ]);
        }
    }
}
