<?php

// Add Settings Page
function bydn_instagram_add_admin_menu() {
    add_menu_page(
        'ByDN Instagram Settings',          // Page title
        'ByDN Instagram',                   // Menu title
        'manage_options',                   // Capability
        'bydn-instagram',                  // Menu slug
        'bydn_instagram_settings_page',     // Callback function
        'dashicons-camera',                 // Icon
        20                                  // Position
    );
}
add_action('admin_menu', 'bydn_instagram_add_admin_menu');


// Register Settings
function bydn_instagram_register_settings() {
    register_setting('bydn_instagram_settings', 'bydn_instagram_account');
    register_setting('bydn_instagram_settings', 'bydn_instagram_token');
}
add_action('admin_init', 'bydn_instagram_register_settings');


// Settings Page Content
function bydn_instagram_settings_page() {
    include plugin_dir_path(__FILE__) . 'templates/admin-settings-page.php';
}

