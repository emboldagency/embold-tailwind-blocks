<?php

namespace App;

class InitBlocks
{
    public static function initialize($composer)
    {
        $block_classes = config('embold_tailwind_blocks.block_classes', []);

        foreach ($block_classes as $block) {
            $formatted_block_class = str_replace('App\\Blocks\\', '', $block);

            if (! file_exists(get_theme_file_path("app/Blocks/{$formatted_block_class}.php"))) {

                (new $block($composer))->compose();
            }
        }
    }
}
