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
        if ($this->app->runningInConsole()) {
            $this->commands([
                CustomBlockMakeCommand::class,
            ]);
        }
    }
}
