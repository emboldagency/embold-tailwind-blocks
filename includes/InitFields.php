<?php

namespace App;

use Log1x\AcfComposer\AcfComposer;

class InitFields
{
    public static function initialize(AcfComposer $composer)
    {
        $field_namespace = 'Fields';
        $field_classes = config('emblocks.field_classes', []);

        foreach ($field_classes as $field_class) {
            $field_path = "app/{$field_namespace}/{$field_class}.php";

            if (! file_exists(get_theme_file_path($field_path))) {
                $class = '\App\\' . $field_namespace . '\\' . $field_class;

                (new $class($composer))->compose();
            }
        }
    }
}
