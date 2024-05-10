<div class="wrap">
    <h1>ByDN Instagram Settings</h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('bydn_instagram_settings');
        do_settings_sections('bydn_instagram_settings');
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Instagram Account</th>
                <td><input type="text" name="bydn_instagram_account" value="<?php echo esc_attr(get_option('bydn_instagram_account')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Instagram Token</th>
                <td><input type="text" name="bydn_instagram_token" value="<?php echo esc_attr(get_option('bydn_instagram_token')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
