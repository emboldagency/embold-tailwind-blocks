<?php
/**
 * @wordpress-plugin
 * Plugin Name:        emBold Tailwind Blocks
 * Plugin URI:         https://embold.com
 * Description:        A collection of Tailwind Blocks, written with ACF Composer and Blade Templates. REQUIRES ACF to be enabled!
 * Version:            0.11.0
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

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$embold_update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/emboldagency/embold-tailwind-blocks/',
	__FILE__,
	'embold-tailwind-blocks'
);

$update_key_url = 'https://embold.net/api/wp-plugin-key';

// Initialize cURL session
$ch = curl_init($update_key_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 0.2); // Set timeout in seconds

// Execute cURL session
$update_key = @curl_exec($ch);

if ($update_key !== false && ($update_key = trim($update_key))) {
    // Close cURL session
    curl_close($ch);

    // Set authentication and enable release assets
    $embold_update_checker->setAuthentication($update_key);
    $embold_update_checker->getVcsApi()->enableReleaseAssets();
}

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
