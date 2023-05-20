<?php

namespace App;

use Roots\Acorn\Application;

class InitBlocks
{
    public static function initialize(Application $app)
    {
        $block_classes = [
            \App\Blocks\Statistics::class,
            // \App\Blocks\Button::class,
            // \App\Blocks\Accordion::class,
            // Add more block classes here
        ];

        foreach ($block_classes as $block_class) {
            /** @var CustomBlock $block */
            $formatted_block_class = str_replace('App\\Blocks\\', '', $block_class);

            if (!file_exists(get_theme_file_path("app/Blocks/{$formatted_block_class}.php"))) {
                $block = new $block_class($app);

                $block->compose();
            }
        }
    }
}
