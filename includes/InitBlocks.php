<?php

namespace App;

use Roots\Acorn\Application;

class InitBlocks
{
    public static function initialize(Application $app)
    {
        $blockClasses = [
            \App\Blocks\Statistics::class,
            // \App\Blocks\Button::class,
            // \App\Blocks\Accordion::class,
            // Add more block classes here
        ];

        foreach ($blockClasses as $blockClass) {
            /** @var CustomBlock $block */
            $block = new $blockClass($app);

            if (!file_exists(get_theme_file_path("app/Blocks/{$block->name}.php"))) {
                $block->compose();
            }
        }
    }
}
