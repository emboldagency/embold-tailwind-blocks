<?php

namespace App;

use Log1x\AcfComposer\AcfComposer;

class InitFields
{
    public static function initialize(AcfComposer $composer)
    {
        $field_classes = config('embold_tailwind_blocks.field_classes', []);

        foreach ($field_classes as $field_class) {
            $formatted_field_class = str_replace('App\\Fields\\', '', $field_class);

            if (! file_exists(get_theme_file_path("app/Fields/{$formatted_field_class}.php"))) {
                (new $field_class($composer))->compose();
            }
        }
    }
}
