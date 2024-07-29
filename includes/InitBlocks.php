<?php

namespace App;

class InitBlocks
{
    public static function initialize($composer)
    {
        $block_namespace = 'Blocks';
        $block_classes = config('emblocks.block_classes', []);

        foreach ($block_classes as $block_class) {
            $block_path = "app/{$block_namespace}/{$block_class}.php";

            if (! file_exists(get_theme_file_path($block_path))) {
                $class = '\App\\' . $block_namespace . '\\' . $block_class;

                (new $class($composer))->compose();
            }
        }
    }
}
