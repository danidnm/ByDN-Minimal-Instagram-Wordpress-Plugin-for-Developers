<?php

// Sync Instagram Function
function bydn_instagram_sync_function() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'bydn_instagram';

    // Retrieve Instagram Account and Token
    $instagram_account = get_option('bydn_instagram_account');
    $instagram_token = get_option('bydn_instagram_token');

    // Check if both are set
    if (empty($instagram_account) || empty($instagram_token)) {
        error_log("ByDN Instagram: Missing Instagram Account or Token in plugin settings.");
        return;
    }

    // Delete all posts
    $wpdb->query("DELETE FROM `{$table_name}` WHERE 1=1");

    // Build the Instagram API URL
    $url = "https://graph.instagram.com/v19.0/me/media?access_token={$instagram_token}&fields=id,caption,media_type,thumbnail_url,media_url,permalink,timestamp";

    while ($url) {

        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
        ]);

        // Execute cURL request and fetch response
        $response = curl_exec($curl);
        $curl_error = curl_error($curl);

        // Close cURL session
        curl_close($curl);

        // Check for errors
        if ($curl_error) {
            error_log("ByDN Instagram: cURL error: " . $curl_error);
            return;
        }

        // Decode JSON response
        $data = json_decode($response, true);

        //die(var_dump($data));

        // Check for valid JSON data
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("ByDN Instagram: JSON decode error: " . json_last_error_msg());
            return;
        }

        // Ensure that 'data' exists in the response
        if (!isset($data['data']) || !is_array($data['data'])) {
            error_log("ByDN Instagram: Invalid or empty Instagram API response.");
            return;
        }

        // Process each Instagram post
        foreach ($data['data'] as $post) {
            $insta_id = $post['id'];
            $caption = isset($post['caption']) ? sanitize_text_field($post['caption']) : '';
            $thumbnail_url = isset($post['thumbnail_url']) ? esc_url_raw($post['thumbnail_url']) : '';
            $media_url = isset($post['media_url']) ? esc_url_raw($post['media_url']) : '';
            $insta_timestamp = isset($post['timestamp']) ? sanitize_text_field($post['timestamp']) : '';
            $permalink = isset($post['permalink']) ? sanitize_text_field($post['permalink']) : '';

            // Transform to mySQL timestamp
            if ($insta_timestamp) {
                $insta_timestamp = date('Y-m-d H:i:s', strtotime($insta_timestamp));
            }

            //if ($post['media_type'] == 'VIDEO') {
            //    continue;
            //}

            // Check if the post already exists in the database
            $existing_post = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE insta_id = %s", $insta_id));

            if (!$existing_post) {
                // Insert the new post into the database
                $wpdb->insert(
                    $table_name,
                    [
                        'insta_id' => $insta_id,
                        'caption' => $caption,
                        'thumbnail_url' => $thumbnail_url,
                        'url' => $media_url,
                        'downloaded_at' => current_time('mysql'),
                        'insta_timestamp' => $insta_timestamp,
                        'permalink' => $permalink,
                    ],
                    ['%s', '%s', '%s', '%s', '%s', '%s', '%s']
                );
            }
        }

        // Next URL
        $url = '';
        if (isset($data['paging']['next'])) {
            $url = $data['paging']['next'];
        }
    }

    error_log("ByDN Instagram: Sync Instagram executed successfully.");
}
add_action('bydn_instagram_sync_event', 'bydn_instagram_sync_function');

if (isset($_GET['run_cron']) && $_GET['run_cron'] === 'sync_instagram') {
    do_action('bydn_instagram_sync_event');
    echo 'Instagram synchronization cron executed.';
}
