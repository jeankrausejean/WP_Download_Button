<?php
/*
Plugin Name: WP Download Button
Plugin URI: 
Description: Adiciona um botão de download personalizado aos posts
Version: 1.1
Author: Dev Jean Krause
Author URI: https://devjean.com.br
*/

if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WP_DOWNLOAD_BUTTON_VERSION', '1.1');
define('WP_DOWNLOAD_BUTTON_PATH', plugin_dir_path(__FILE__));
define('WP_DOWNLOAD_BUTTON_URL', plugin_dir_url(__FILE__));

// Autoload classes
require_once WP_DOWNLOAD_BUTTON_PATH . 'includes/class-wp-download-button-loader.php';

// Initialize the plugin
function wp_download_button_init() {
    $loader = new WP_Download_Button_Loader();
    $loader->run();
}

wp_download_button_init();