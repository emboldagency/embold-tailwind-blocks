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
        // Initialize the options page.
        InitOptions::initialize();

        // Initialize the blocks.
        InitBlocks::initialize($this->app);
        
        // Initialize the fields.
        InitFields::initialize($this->app);
    }

    public function insertBlockCategory()
    {
        add_filter('block_categories', function ($categories, $post) {
            return array_merge(
                [
                    [
                        'slug'  => 'embold',
                        'title' => __( 'emBold', 'embold' ),
                    ],
                ],
                $categories
            );
        }, 10, 2);
    }

    public function formatSubfieldsToArrays() {
        // Add the filter with a higher priority
        add_filter('acf/format_value', [$this, 'convert_subfields_to_array'], 30, 3);
    }

    public function convert_subfields_to_array($value, $post_id, $field)
    {
        // Apply the conversion only to repeater fields
        if ($field['type'] === 'repeater') {
            $value = $this->convert_subfields_recursive($value);
        }

        return $value;
    }

    public function convert_subfields_recursive($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->convert_subfields_recursive($value);
            }
        } elseif (is_object($data)) {
            $data = (array) $data;
            foreach ($data as $key => $value) {
                $data[$key] = $this->convert_subfields_recursive($value);
            }
        }

        return $data;
    }
}
