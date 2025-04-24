<?php

// namespace Log1x\AcfComposer\Providers;

// use Illuminate\Support\ServiceProvider;
// use App\Console\CustomBlockMakeCommand;

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
        $this->publishes([
            __DIR__.'/../../config/acf.php' => $this->app->configPath('acf.php'),
        ], 'acf-composer');

        $this->mergeConfigFrom(__DIR__.'/../../config/acf.php', 'acf');

        $composer = $this->app->make('AcfComposer');

        $composer->boot();

        if ($this->app->runningInConsole()) {
            $this->commands([
                CustomBlockMakeCommand::class,
            ]);
        }
    }
}