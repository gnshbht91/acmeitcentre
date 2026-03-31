<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACME Admin Menu
 */
function acme_register_admin_menu() {

    add_menu_page(
        'ACME Settings',
        'ACME',
        'manage_options',
        'acme-dashboard',
        'acme_admin_dashboard_page',
        'dashicons-admin-generic',
        25
    );

    // Add Dashboard Submenu
    add_submenu_page(
        'acme-dashboard',
        'Dashboard',
        'Dashboard',
        'manage_options',
        'acme-dashboard',
        'acme_admin_dashboard_page'
    );

    // Add Courses Submenu
    add_submenu_page(
        'acme-dashboard',
        'Courses',
        'Courses',
        'manage_options',
        'edit.php?post_type=course'
    );

    // Add Instructors Submenu
    add_submenu_page(
        'acme-dashboard',
        'Instructors',
        'Instructors',
        'manage_options',
        'edit.php?post_type=instructor'
    );

    // Add Batches Submenu
    add_submenu_page(
        'acme-dashboard',
        'Batches',
        'Batches',
        'manage_options',
        'edit.php?post_type=batch'
    );

    // Add Reviews Submenu
    add_submenu_page(
        'acme-dashboard',
        'Reviews',
        'Reviews',
        'manage_options',
        'edit.php?post_type=review'
    );

    // Add FAQ Submenu
    add_submenu_page(
        'acme-dashboard',
        'FAQ',
        'FAQ',
        'manage_options',
        'edit.php?post_type=faq'
    );

}
add_action('admin_menu', 'acme_register_admin_menu');

/**
 * ACME Admin Dashboard Callback
 */
function acme_admin_dashboard_page() {
    ?>
    <div class="wrap">
        <h1>ACME Dashboard</h1>
        <form method="post" action="">
            <h2>Contact Settings</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="acme_phone">Phone Number</label></th>
                    <td><input name="acme_phone" type="text" id="acme_phone" value="" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_email">Email Address</label></th>
                    <td><input name="acme_email" type="email" id="acme_email" value="" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_address">Office Address</label></th>
                    <td><textarea name="acme_address" id="acme_address" rows="5" cols="50" class="large-text"></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="acme_map">Google Map Link</label></th>
                    <td><input name="acme_map" type="url" id="acme_map" value="" class="regular-text"></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Settings">
            </p>
        </form>
    </div>
    <?php
}
