<?php

namespace App;

class InitBlocks
{
    public static function initialize($composer)
    {
        // Register your blocks here
        $block_classes = [
            // alphabetical please
            Blocks\Accordion::class,
            Blocks\Button::class,
            Blocks\Slider::class,
            Blocks\Statistics::class,
            Blocks\TestimonialMultiple::class,
            Blocks\TestimonialSingle::class,
            // Add more block classes here
        ];

        foreach ($block_classes as $block) {
            $formatted_block_class = str_replace('App\\Blocks\\', '', $block);

            if (! file_exists(get_theme_file_path("app/Blocks/{$formatted_block_class}.php"))) {

                (new $block($composer))->compose();
            }
        }
    }
}
