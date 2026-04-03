<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACME Admin Menu
 */
function acme_register_admin_menu() {

    add_menu_page(
        'ACME Dashboard',
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

    // Add Settings Submenu
    add_submenu_page(
        'acme-dashboard',
        'Settings',
        'Settings',
        'manage_options',
        'acme-settings',
        'acme_admin_settings_page'
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
        <p>Welcome to the ACME system dashboard.</p>
    </div>
    <?php
}
