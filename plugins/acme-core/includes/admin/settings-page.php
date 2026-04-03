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
            'business_name' => !empty($_POST['acme_business_name']) ? sanitize_text_field($_POST['acme_business_name']) : '',
            'business_hours' => !empty($_POST['acme_business_hours']) ? sanitize_text_field($_POST['acme_business_hours']) : '',
            'map_link' => !empty($_POST['acme_map_link']) ? esc_url_raw($_POST['acme_map_link']) : '',
        );

        update_option('acme_settings', $settings);
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html('Acme Settings'); ?></h1>


        <?php $settings = acme_get_settings(); ?>
        <form method="post">

            <?php wp_nonce_field('acme_settings_save', 'acme_settings_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="acme_phone">Phone Number</label></th>
                    <td><input type="text" id="acme_phone" name="acme_phone" value="<?php echo esc_attr($settings['phone'] ?? ''); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_email">Email Address</label></th>
                    <td><input type="email" id="acme_email" name="acme_email" value="<?php echo esc_attr($settings['email'] ?? ''); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_address">Address</label></th>
                    <td><input type="text" id="acme_address" name="acme_address" value="<?php echo esc_attr($settings['address'] ?? ''); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_whatsapp">WhatsApp Number</label></th>
                    <td><input type="text" id="acme_whatsapp" name="acme_whatsapp" value="<?php echo esc_attr($settings['whatsapp'] ?? ''); ?>" class="regular-text"></td>
                </tr>

                <tr>
                    <th><label for="acme_business_name">Business Name</label></th>
                    <td>
                        <input type="text" id="acme_business_name" name="acme_business_name" value="<?php echo esc_attr($settings['business_name'] ?? ''); ?>" class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th><label for="acme_business_hours">Business Hours</label></th>
                    <td>
                        <input type="text" id="acme_business_hours" name="acme_business_hours" value="<?php echo esc_attr($settings['business_hours'] ?? ''); ?>" class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th><label for="acme_map_link">Google Map Link</label></th>
                    <td>
                        <input type="url" id="acme_map_link" name="acme_map_link" value="<?php echo esc_attr($settings['map_link'] ?? ''); ?>" class="regular-text">
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
