<?php
if (!defined('ABSPATH')) exit;

function acme_render_settings_page() {
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['acme_settings_nonce']) &&
        wp_verify_nonce($_POST['acme_settings_nonce'], 'acme_settings_save') &&
        current_user_can('manage_options')
    ) {

        $settings = array(
            'phone' => !empty($_POST['acme_phone']) ? sanitize_text_field($_POST['acme_phone']) : '',
            'email' => !empty($_POST['acme_email']) ? sanitize_email($_POST['acme_email']) : '',
            'address' => !empty($_POST['acme_address']) ? sanitize_text_field($_POST['acme_address']) : '',
            'whatsapp' => !empty($_POST['acme_whatsapp']) ? sanitize_text_field($_POST['acme_whatsapp']) : '',
        );

        update_option('acme_settings', $settings);
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html('Acme Settings'); ?></h1>

        <form method="post">
            <?php wp_nonce_field('acme_settings_save', 'acme_settings_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="acme_phone">Phone Number</label></th>
                    <td><input type="text" id="acme_phone" name="acme_phone" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_email">Email Address</label></th>
                    <td><input type="email" id="acme_email" name="acme_email" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_address">Address</label></th>
                    <td><input type="text" id="acme_address" name="acme_address" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_whatsapp">WhatsApp Number</label></th>
                    <td><input type="text" id="acme_whatsapp" name="acme_whatsapp" class="regular-text"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
