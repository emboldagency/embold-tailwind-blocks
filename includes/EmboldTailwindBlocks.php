<?php

namespace App;

use Illuminate\Config\Repository as ConfigRepository;
use Roots\Acorn\Application;

class EmboldTailwindBlocks {
    protected $app;

    public function __construct() {
        // Create an instance of Roots\Acorn\Application
        $this->app = new Application(plugin_dir_path(__FILE__));

        // Register a config repository with the application
        $this->app->singleton('config', function () {
            return new ConfigRepository();
        });
    }

    public function init() {
        // Initialize the blocks.
        InitBlocks::initialize($this->app);
    }
}
