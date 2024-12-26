<?php

// Shortcode Function
function bydn_instagram_shortcode($atts) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'bydn_instagram';

    // Extract shortcode attributes
    $atts = shortcode_atts(
        ['caption' => ''],
        $atts,
        'instagram_posts'
    );

    // Fetch Instagram posts from the database
    if (!empty($atts['caption'])) {
        $caption = '%' . $wpdb->esc_like($atts['caption']) . '%';
        $posts = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE caption LIKE %s ORDER BY insta_timestamp DESC",
                $caption
            )
        );
    } else {
        $posts = $wpdb->get_results("SELECT * FROM $table_name ORDER BY insta_timestamp DESC");
    }

    // Include Template
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/shortcode-instagram-posts.php';

    return ob_get_clean();
}
add_shortcode('instagram_posts', 'bydn_instagram_shortcode');
