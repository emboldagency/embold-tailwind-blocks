<?php
/**
 * @wordpress-plugin
 * Plugin Name:        emBold Tailwind Blocks
 * Plugin URI:         https://embold.com
 * Description:        A collection of Tailwind Blocks, written with ACF Composer and Blade Templates.
 * Version:            0.9.0
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

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$embold_update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/emboldagency/embold-wordpress-tweaks/',
	__FILE__,
	'embold-wordpress-tweaks'
);

$update_key_url = 'https://embold.net/api/wp-plugin-key';
$update_key = file_get_contents($update_key_url);

$embold_update_checker->setAuthentication($update_key);
$embold_update_checker->getVcsApi()->enableReleaseAssets();

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
