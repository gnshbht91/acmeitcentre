<?php

if (!defined('ABSPATH')) exit;

function acme_settings_page() {
    ?>
    <div class="wrap">
        <h1>ACME Settings</h1>

        <form method="post">

            <h2>Contact Info</h2>

            <table class="form-table">

                <tr>
                    <th>WhatsApp Number</th>
                    <td><input type="text" name="acme_whatsapp" class="regular-text"></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><input type="email" name="acme_email" class="regular-text"></td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td><textarea name="acme_address" class="large-text"></textarea></td>
                </tr>

                <tr>
                    <th>Google Map Link</th>
                    <td><input type="text" name="acme_map" class="regular-text"></td>
                </tr>

            </table>

            <h2>Social Links</h2>

            <table class="form-table">

                <tr>
                    <th>Facebook</th>
                    <td><input type="text" name="acme_facebook" class="regular-text"></td>
                </tr>

                <tr>
                    <th>Instagram</th>
                    <td><input type="text" name="acme_instagram" class="regular-text"></td>
                </tr>

                <tr>
                    <th>YouTube</th>
                    <td><input type="text" name="acme_youtube" class="regular-text"></td>
                </tr>

            </table>

            <p><button class="button button-primary">Save Settings</button></p>

        </form>
    </div>
    <?php
}

/**
 * Register global option for ACME settings
 */
function acme_register_settings_option() {
    if (get_option('acme_settings') === false) {
        add_option('acme_settings', []);
    }
}
add_action('init', 'acme_register_settings_option');

/**
 * Get ACME settings safely
 */
function acme_get_settings() {

    $cache_key = 'acme_settings';

    $cached = wp_cache_get($cache_key);

    if ($cached !== false) {
        return $cached;
    }

    $settings = get_option('acme_settings');

    if (!is_array($settings)) {
        $settings = array();
    }

    wp_cache_set($cache_key, $settings);

    return $settings;
}

