<?php

namespace App;

use Illuminate\Config\Repository as ConfigRepository;
use Log1x\AcfComposer\AcfComposer;
use Roots\Acorn\Application;

class EmboldTailwindBlocks
{
    protected $app;

    protected $composer;

    public function __construct()
    {
        // Initialize the application
        $this->app = $this->createApplication();

        $this->composer = new AcfComposer($this->app);

        // Auto-load blocks
        add_action('acf/init', [$this, 'init']);
    }

    protected function createApplication()
    {
        $app = new Application();
        $app->singleton('config', function () {
            return new ConfigRepository();
        });

        return $app;
    }

    public function init()
    {
        InitOptions::initialize();

        InitBlocks::initialize($this->composer);

        InitFields::initialize($this->composer);

        add_filter('acf/register_block_type_args', [$this, 'add_validate_key_to_block_settings'], 10, 1);
    }

    public function add_validate_key_to_block_settings($settings)
    {
        if (!isset($settings['validate'])) {
            $settings['validate'] = false; // Set to true if you prefer
        }
        return $settings;
    }

    public function insertBlockCategory()
    {
        add_filter('block_categories_all', function ($categories, $post) {
            return array_merge(
                [
                    [
                        'slug' => 'embold',
                        'title' => __('emBold', 'embold'),
                    ],
                ],
                $categories
            );
        }, 10, 2);
    }

    public function formatSubfieldsToArrays()
    {
        // Add the filter with a higher priority
        add_filter('acf/format_value', [$this, 'convertSubfieldsToArrays'], 30, 3);
    }

    public function convertSubfieldsToArrays($value, $post_id, $field)
    {
        // Apply the conversion only to repeater fields
        if ($field['type'] === 'repeater') {
            $value = $this->convertSubfieldsRecursive($value);
        }

        return $value;
    }

    public function convertSubfieldsRecursive($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->convertSubfieldsRecursive($value);
            }
        } elseif (is_object($data)) {
            $data = (array)$data;
            foreach ($data as $key => $value) {
                $data[$key] = $this->convertSubfieldsRecursive($value);
            }
        }

        return $data;
    }
}
