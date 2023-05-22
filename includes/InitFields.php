<?php

namespace App;

use Roots\Acorn\Application;

class InitFields
{
    public static function initialize(Application $app)
    {
        $field_classes = [
            \App\Fields\Padding::class,
            // \App\Fields\BackgroundColor::class,
            // Add more field classes here
        ];

        foreach ($field_classes as $field_class) {
            $formatted_field_class = str_replace('App\\Fields\\', '', $field_class);

            if (!file_exists(get_theme_file_path("app/Fields/{$formatted_field_class}.php"))) {
                $field = new $field_class($app);

                $field->compose();
            }
        }
    }
}
