<?php
/**
 * @wordpress-plugin
 * Plugin Name:        emBold Tailwind Blocks
 * Plugin URI:         https://embold.com
 * Description:        A collection of Tailwind Blocks, written with ACF Composer and Blade Templates.
 * Version:            0.6.0
 * Author:             example
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
