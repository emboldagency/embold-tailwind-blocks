<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Blocks
  |--------------------------------------------------------------------------
  |
  | Here you can decide which plugin blocks you would like to register. Each item in
  | the array is a block class that should be enabled.
  |
  */

  // alphabetical please
  'block_classes' => [
    'Blocks\Accordion::class',
    'Blocks\Button::class',
    'Blocks\Slider::class',
    'Blocks\Statistics::class',
    'Blocks\TestimonialMultiple::class',
    'Blocks\TestimonialSingle::class',
  ],

  /*
  |--------------------------------------------------------------------------
  | Fields
  |--------------------------------------------------------------------------
  |
  | Here you can decide which plugin fields you would like to register. Each item in
  | the array is a field class that should be enabled.
  |
  */

  // alphabetical please
  'field_classes' => [
    'Fields\Padding::class',
    // 'Fields\BackgroundColor::class',
  ],

  /*
  |--------------------------------------------------------------------------
  | Modifiers
  |--------------------------------------------------------------------------
  |
  | Here you can decide which plugin modifiers you would like to register. Each item in
  | the array is a modifier class that should be enabled.
  |
  */

  // alphabetical please
  'modifier_classes' => [
    // 'Modifiers\CoreGroup::class',
  ],

  /*
  |--------------------------------------------------------------------------
  | Features
  |--------------------------------------------------------------------------
  |
  | Here you can decide which plugin features you would like to enable. Each key
  | is a feature name and the value is a boolean to determine if the feature 
  | should be enabled or not.
  |
  */

  // Enable the theme options page?
  'theme_options_page' => true,
];