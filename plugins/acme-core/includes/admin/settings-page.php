<?php
if (!defined('ABSPATH')) exit;

function acme_register_settings() {
    register_setting('acme_settings_group', 'acme_settings', 'acme_sanitize_settings');
}
add_action('admin_init', 'acme_register_settings');

function acme_sanitize_settings($input) {
    if (!is_array($input)) {
        return [];
    }
    
    $sanitized = [];
    $sanitized['phone'] = isset($input['phone']) ? sanitize_text_field($input['phone']) : '';
    $sanitized['email'] = isset($input['email']) ? sanitize_email($input['email']) : '';
    $sanitized['address'] = isset($input['address']) ? sanitize_text_field($input['address']) : '';
    $sanitized['whatsapp'] = isset($input['whatsapp']) ? sanitize_text_field($input['whatsapp']) : '';
    $sanitized['business_name'] = isset($input['business_name']) ? sanitize_text_field($input['business_name']) : '';
    $sanitized['business_hours'] = isset($input['business_hours']) ? sanitize_text_field($input['business_hours']) : '';
    $sanitized['map_link'] = isset($input['map_link']) ? esc_url_raw($input['map_link']) : '';
    
    $sanitized['social_links'] = [];
    if (isset($input['social_links']) && is_array($input['social_links'])) {
        $index = 0;
        foreach ($input['social_links'] as $link) {
            if (!is_array($link)) continue;
            $type = isset($link['type']) ? sanitize_text_field($link['type']) : '';
            $url = isset($link['url']) ? esc_url_raw($link['url']) : '';
            if (!empty($type) || !empty($url)) {
                $sanitized['social_links'][$index] = ['type' => $type, 'url' => $url];
                $index++;
            }
        }
    }
    
    wp_cache_delete('acme_settings');
    return $sanitized;
}

function acme_admin_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html('ACME Settings'); ?></h1>

        <form method="post" action="options.php">
            <?php 
            settings_fields('acme_settings_group'); 
            do_settings_sections('acme_settings_group');
            
            $settings = get_option('acme_settings');
            
            if (empty($settings)) {
                $old_phone = get_option('acme_phone', '');
                $old_email = get_option('acme_email', '');
                $old_address = get_option('acme_address', '');
                $old_whatsapp = get_option('acme_whatsapp', '');
                $old_business_name = get_option('acme_business_name', '');
                $old_business_hours = get_option('acme_business_hours', '');
                $old_map_link = get_option('acme_map_link', '');
                
                if (!empty($old_phone) || !empty($old_email) || !empty($old_address) || !empty($old_whatsapp) || !empty($old_business_name) || !empty($old_business_hours) || !empty($old_map_link)) {
                    $new_settings = [
                        'phone' => $old_phone,
                        'email' => $old_email,
                        'address' => $old_address,
                        'whatsapp' => $old_whatsapp,
                        'business_name' => $old_business_name,
                        'business_hours' => $old_business_hours,
                        'map_link' => $old_map_link,
                    ];
                    update_option('acme_settings', $new_settings);
                    $settings = $new_settings;
                } else {
                    $settings = [];
                }
            }
            if (!is_array($settings)) $settings = [];
            ?>

            <table class="form-table">
                <tr>
                    <th><label for="acme_phone">Phone Number</label></th>
                    <td><input type="text" id="acme_phone" name="acme_settings[phone]" value="<?php echo esc_attr(isset($settings['phone']) ? $settings['phone'] : ''); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_email">Email Address</label></th>
                    <td><input type="email" id="acme_email" name="acme_settings[email]" value="<?php echo esc_attr(isset($settings['email']) ? $settings['email'] : ''); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_address">Address</label></th>
                    <td><input type="text" id="acme_address" name="acme_settings[address]" value="<?php echo esc_attr(isset($settings['address']) ? $settings['address'] : ''); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="acme_whatsapp">WhatsApp Number</label></th>
                    <td><input type="text" id="acme_whatsapp" name="acme_settings[whatsapp]" value="<?php echo esc_attr(isset($settings['whatsapp']) ? $settings['whatsapp'] : ''); ?>" class="regular-text"></td>
                </tr>

                <tr>
                    <th><label for="acme_business_name">Business Name</label></th>
                    <td>
                        <input type="text" id="acme_business_name" name="acme_settings[business_name]" value="<?php echo esc_attr(isset($settings['business_name']) ? $settings['business_name'] : ''); ?>" class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th><label for="acme_business_hours">Business Hours</label></th>
                    <td>
                        <input type="text" id="acme_business_hours" name="acme_settings[business_hours]" value="<?php echo esc_attr(isset($settings['business_hours']) ? $settings['business_hours'] : ''); ?>" class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th><label for="acme_map_link">Google Map Link</label></th>
                    <td>
                        <input type="url" id="acme_map_link" name="acme_settings[map_link]" value="<?php echo esc_url(isset($settings['map_link']) ? $settings['map_link'] : ''); ?>" class="regular-text">
                    </td>
                </tr>
            </table>

            <h2>Social Links</h2>
            <div id="acme-social-links-container">
                <?php
                if (!empty($settings['social_links']) && is_array($settings['social_links'])) {
                    foreach ($settings['social_links'] as $index => $link) {
                        ?>
                        <div class="acme-social-row" style="margin-bottom: 10px;">
                            <input type="text" name="acme_settings[social_links][<?php echo esc_attr($index); ?>][type]" placeholder="Platform (e.g. Facebook)" value="<?php echo esc_attr(isset($link['type']) ? $link['type'] : ''); ?>" class="regular-text">
                            <input type="url" name="acme_settings[social_links][<?php echo esc_attr($index); ?>][url]" placeholder="URL" value="<?php echo esc_url(isset($link['url']) ? $link['url'] : ''); ?>" class="regular-text">
                            <button type="button" class="button acme-remove-social-row">Remove</button>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="acme-social-row" style="margin-bottom: 10px;">
                        <input type="text" name="acme_settings[social_links][0][type]" placeholder="Platform (e.g. Facebook)" value="" class="regular-text">
                        <input type="url" name="acme_settings[social_links][0][url]" placeholder="URL" value="" class="regular-text">
                        <button type="button" class="button acme-remove-social-row">Remove</button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <p><button type="button" class="button" id="acme-add-social-row">Add Social Link</button></p>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function acme_enqueue_admin_scripts($hook) {
    if ($hook !== 'acme_page_acme-settings') {
        return;
    }
    wp_enqueue_script('acme-admin-script', ACME_URL . 'assets/js/admin.js', array('jquery'), ACME_VERSION, true);
}
add_action('admin_enqueue_scripts', 'acme_enqueue_admin_scripts');
