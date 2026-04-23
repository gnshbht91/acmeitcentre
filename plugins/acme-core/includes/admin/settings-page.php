<?php
if (!defined('ABSPATH'))
    exit;

function acme_register_settings()
{
    register_setting('acme_settings_group', 'acme_settings', 'acme_sanitize_settings');
}
add_action('admin_init', 'acme_register_settings');

function acme_sanitize_settings($input)
{
    if (!is_array($input)) {
        return [];
    }

    $has_error = false;
    $sanitized = [];

    // PHONE VALIDATION: Required, numbers + optional sign
    $phone = isset($input['phone']) ? sanitize_text_field($input['phone']) : '';
    if (empty($phone) || !preg_match('/^\+?[0-9\s-]+$/', $phone)) {
        add_settings_error('acme_settings', 'invalid_phone', 'Invalid phone number: Please provide a valid number with digits and optional + sign.');
        $has_error = true;
    }
    $sanitized['phone'] = $phone;

    // EMAIL VALIDATION: Must be valid email format
    $email = isset($input['email']) ? sanitize_email($input['email']) : '';
    if (empty($email) || !is_email($email)) {
        add_settings_error('acme_settings', 'invalid_email', 'Invalid email address: Please provide a valid email.');
        $has_error = true;
    }
    $sanitized['email'] = $email;

    // ADDRESS (no specific validation required)
    $sanitized['address'] = isset($input['address']) ? sanitize_text_field($input['address']) : '';

    // WHATSAPP VALIDATION (same as phone)
    $whatsapp = isset($input['whatsapp']) ? sanitize_text_field($input['whatsapp']) : '';
    if (empty($whatsapp) || !preg_match('/^\+?[0-9\s-]+$/', $whatsapp)) {
        add_settings_error('acme_settings', 'invalid_whatsapp', 'Invalid WhatsApp number: Please provide a valid number.');
        $has_error = true;
    }
    $sanitized['whatsapp'] = $whatsapp;

    // BUSINESS DETAILS
    $sanitized['business_name'] = isset($input['business_name']) ? sanitize_text_field($input['business_name']) : '';
    $sanitized['business_hours'] = isset($input['business_hours']) ? sanitize_text_field($input['business_hours']) : '';

    // MAP LINK VALIDATION: Must be valid URL
    $map_link = isset($input['map_link']) ? esc_url_raw($input['map_link']) : '';
    if (!empty($map_link) && !filter_var($map_link, FILTER_VALIDATE_URL)) {
        add_settings_error('acme_settings', 'invalid_map_link', 'Invalid Map link: Please provide a valid URL.');
        $has_error = true;
    }
    $sanitized['map_link'] = $map_link;

    // SOCIAL LINKS VALIDATION
    $sanitized['social_links'] = [];
    if (isset($input['social_links']) && is_array($input['social_links'])) {
        foreach ($input['social_links'] as $link) {
            if (!is_array($link))
                continue;

            $type = isset($link['type']) ? sanitize_text_field($link['type']) : '';
            $url = isset($link['url']) ? esc_url_raw($link['url']) : '';

            // Skip completely empty rows
            if (empty($type) && empty($url)) {
                continue;
            }

            // Validate URL format if URL is provided
            if (!empty($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
                add_settings_error('acme_settings', 'invalid_social_url', "Invalid social URL for: " . esc_html($type));
                $has_error = true;
            }

            $sanitized['social_links'][] = [
                'type' => $type,
                'url' => $url
            ];
        }
    }

    if ($has_error) {
        return get_option('acme_settings');
    }

    wp_cache_delete('acme_settings');
    return $sanitized;
}

function acme_admin_settings_page()
{
    ?>
    <div class="wrap acme-settings-page">
        <h1>ACME Settings</h1>
        <p>Manage your business contact information and social media presence.</p>

        <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('acme_settings_group');

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
            if (!is_array($settings))
                $settings = [];
            ?>

            <h2>Contact Information</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="acme_phone">Phone Number</label></th>
                    <td>
                        <input type="text" id="acme_phone" name="acme_settings[phone]"
                            value="<?php echo esc_attr(isset($settings['phone']) ? $settings['phone'] : ''); ?>"
                            class="regular-text">
                        <p class="description">Enter valid phone number for customer contact.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_email">Email Address</label></th>
                    <td>
                        <input type="email" id="acme_email" name="acme_settings[email]"
                            value="<?php echo esc_attr(isset($settings['email']) ? $settings['email'] : ''); ?>"
                            class="regular-text">
                        <p class="description">Enter valid business email address.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_whatsapp">WhatsApp Number</label></th>
                    <td>
                        <input type="text" id="acme_whatsapp" name="acme_settings[whatsapp]"
                            value="<?php echo esc_attr(isset($settings['whatsapp']) ? $settings['whatsapp'] : ''); ?>"
                            class="regular-text">
                        <p class="description">Enter WhatsApp number with country code.</p>
                    </td>
                </tr>
            </table>

            <h2>Business Details</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="acme_business_name">Business Name</label></th>
                    <td>
                        <input type="text" id="acme_business_name" name="acme_settings[business_name]"
                            value="<?php echo esc_attr(isset($settings['business_name']) ? $settings['business_name'] : ''); ?>"
                            class="regular-text">
                        <p class="description">Enter your official business name.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_business_hours">Business Hours</label></th>
                    <td>
                        <input type="text" id="acme_business_hours" name="acme_settings[business_hours]"
                            value="<?php echo esc_attr(isset($settings['business_hours']) ? $settings['business_hours'] : ''); ?>"
                            class="regular-text">
                        <p class="description">e.g. Mon-Fri: 9AM - 6PM</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_address">Address</label></th>
                    <td>
                        <input type="text" id="acme_address" name="acme_settings[address]"
                            value="<?php echo esc_attr(isset($settings['address']) ? $settings['address'] : ''); ?>"
                            class="regular-text">
                        <p class="description">Physical address of the institute.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_map_link">Google Map Link</label></th>
                    <td>
                        <input type="url" id="acme_map_link" name="acme_settings[map_link]"
                            value="<?php echo esc_url(isset($settings['map_link']) ? $settings['map_link'] : ''); ?>"
                            class="regular-text">
                        <p class="description">Paste the Google Map link for location.</p>
                    </td>
                </tr>
            </table>

            <h2>Social Profiles</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">Social Links</th>
                    <td>
                        <div id="acme-social-links-container">
                            <?php
                            if (!empty($settings['social_links']) && is_array($settings['social_links'])) {
                                foreach ($settings['social_links'] as $index => $link) {
                                    ?>
                                    <div class="acme-social-item" style="margin-bottom: 10px;">
                                        <input type="text" name="acme_settings[social_links][<?php echo esc_attr($index); ?>][type]"
                                            placeholder="Platform"
                                            value="<?php echo esc_attr(isset($link['type']) ? $link['type'] : ''); ?>"
                                            class="regular-text" style="width: 150px;">
                                        <input type="url" name="acme_settings[social_links][<?php echo esc_attr($index); ?>][url]"
                                            placeholder="URL"
                                            value="<?php echo esc_url(isset($link['url']) ? $link['url'] : ''); ?>"
                                            class="regular-text" style="width: 250px;">
                                        <button type="button" class="button acme-remove-social-row">Remove</button>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="acme-social-item" style="margin-bottom: 10px;">
                                    <input type="text" name="acme_settings[social_links][0][type]" placeholder="Platform"
                                        value="" class="regular-text" style="width: 150px;">
                                    <input type="url" name="acme_settings[social_links][0][url]" placeholder="URL" value=""
                                        class="regular-text" style="width: 250px;">
                                    <button type="button" class="button acme-remove-social-row">Remove</button>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <button type="button" class="button" id="acme-add-social-row">Add Social Link</button>
                    </td>
                </tr>
            </table>

            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <?php
}

function acme_enqueue_admin_scripts($hook)
{
    if ($hook !== 'acme_page_acme-settings') {
        return;
    }
    wp_enqueue_style('acme-admin-style', ACME_URL . 'assets/admin.css', array(), ACME_VERSION);
    wp_enqueue_script('acme-admin-script', ACME_URL . 'assets/js/admin.js', array('jquery'), ACME_VERSION, true);
    wp_localize_script(
        'acme-admin-script',
        'acme_admin',
        array(
            'nonce' => wp_create_nonce('acme_admin_nonce')
        )
    );
}
add_action('admin_enqueue_scripts', 'acme_enqueue_admin_scripts');

