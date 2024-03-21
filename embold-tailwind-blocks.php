<?php
/**
 * @wordpress-plugin
 * Plugin Name:        emBold Tailwind Blocks
 * Plugin URI:         https://embold.com
 * Description:        A collection of Tailwind Blocks, written with ACF Composer and Blade Templates. REQUIRES ACF to be enabled!
 * Version:            1.0.0
 * Author:             emBold
 * Author URI:         https://embold.com/
 * Primary Branch:     master
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Load the autoloader
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Include the main plugin class
require_once plugin_dir_path(__FILE__) . 'includes/EmboldTailwindBlocks.php';

// Check if ACF or ACF Pro is active, deactivate our plugin if not
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!is_plugin_active('advanced-custom-fields/acf.php') && !is_plugin_active('advanced-custom-fields-pro/acf.php')) {
    // Deactivate the plugin
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}

global $allow_updates;
$allow_updates = true;

function check_theme_acorn_version() {
    global $allow_updates;

    // Get the active theme directory
    $theme_dir = get_template_directory();

    // Check if the theme directory exists
    if (is_dir($theme_dir)) {
        // Get the path to the composer.json file of the active theme
        $composer_json_path = $theme_dir.'/composer.json';

        // Check if composer.json file exists
        if (file_exists($composer_json_path)) {
            // Read the composer.json file
            $composer_json = file_get_contents($composer_json_path);

            // Decode the JSON data
            $composer_data = json_decode($composer_json, true);

            // Check if the composer.json data contains 'require' key
            if (isset($composer_data['require'])) {
                // Check if Acorn is listed in the 'require' section
                if (isset($composer_data['require']['roots/acorn'])) {
                    $acorn_version = str_replace('^', '', $composer_data['require']['roots/acorn']);

                    // Check if the Acorn version is v3 or v4
                    if (version_compare($acorn_version, '4.0.0', '<')) {
                        $allow_updates = false;
                    }
                }

                if (isset($composer_data['require']['log1x/acf-composer'])) {
                    $acf_composer_version = str_replace('^', '', $composer_data['require']['log1x/acf-composer']);

                    // Check if the Acorn version is v3 or v4
                    if (version_compare($acf_composer_version, '2.9.0', '<')) {
                        $allow_updates = false;
                    }
                }
            }
        }
    }
}

add_action('plugins_loaded', 'check_theme_acorn_version');

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

add_action('plugins_loaded', function() {
    global $allow_updates;
    if ($allow_updates) {
        $embold_update_checker = PucFactory::buildUpdateChecker(
            'https://github.com/emboldagency/embold-tailwind-blocks/',
            __FILE__,
            'embold-tailwind-blocks'
        );

        // Set to use GitHub Releases
        $embold_update_checker->getVcsApi()->enableReleaseAssets();
    }
}, 20);

// Plugin initialization
function embold_tailwind_blocks_init() {
    // Create an instance of your plugin class
    $plugin = new \App\EmboldTailwindBlocks();

    // Insert the block category
    $plugin->insertBlockCategory();

    // Initialize the plugin
    $plugin->init();

    // Add compatibility with Laraish Themes
    $plugin->formatSubfieldsToArrays();
}

add_action('plugins_loaded', 'embold_tailwind_blocks_init');
