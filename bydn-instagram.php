<?php
/*
Plugin Name: ByDN Instagram
Plugin URI: https://danielnavarro.es
Description: A simple Instagram plugin for WordPress by DN.
Version: 1.0.0
Author: Daniel Navarro
Author URI: https://danielnavarro.es
License: GPLv2 or later
Text Domain: bydn-instagram
*/

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Include Required Files
require_once plugin_dir_path(__FILE__) . 'includes/bydn-instagram-admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/bydn-instagram-cron.php';
require_once plugin_dir_path(__FILE__) . 'includes/bydn-instagram-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/bydn-instagram-functions.php';

// Activation Hook
function bydn_instagram_activate() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'bydn_instagram';
    $charset_collate = $wpdb->get_charset_collate();

    // SQL statement to create the table
    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        insta_id VARCHAR(32) NOT NULL UNIQUE,
        caption TEXT NULL,
        thumbnail_url TEXT NULL DEFAULT NULL,
        url TEXT NOT NULL,
        permalink TEXT NULL,
        insta_timestamp datetime NOT NULL, 
        downloaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Load the 'dbDelta' function
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Schedule the Cron Job
    if (!wp_next_scheduled('bydn_instagram_sync_event')) {
        wp_schedule_event(time(), 'hourly', 'bydn_instagram_sync_event');
    }
}
register_activation_hook(__FILE__, 'bydn_instagram_activate');


// Deactivation Hook
function bydn_instagram_deactivate() {
    // Code to run when the plugin is deactivated
    wp_clear_scheduled_hook('bydn_instagram_sync_event');
}
register_deactivation_hook(__FILE__, 'bydn_instagram_deactivate');


// Enqueue CSS File
function bydn_instagram_enqueue_styles() {
    wp_enqueue_style(
        'bydn-instagram-style',
        plugin_dir_url(__FILE__) . 'assets/css/style.css',
        [],
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'bydn_instagram_enqueue_styles');


// Main Functionality Placeholder
function bydn_instagram_init() {
    // Add your main functionality here
}

add_action('init', 'bydn_instagram_init');
