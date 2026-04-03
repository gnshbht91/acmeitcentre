<?php
/*
Plugin Name: ACME Core
Description: Core plugin for ACME system
Version: 1.0.0
Author: ACME
*/

if (!defined('ACME_VERSION')) {
    define('ACME_VERSION', '1.0.0');
}

if (!defined('ACME_DB_VERSION')) {
    define('ACME_DB_VERSION', '1.0');
}

if (!defined('ACME_PATH')) {
    define('ACME_PATH', plugin_dir_path(__FILE__));
}

if (!defined('ACME_URL')) {
    define('ACME_URL', plugin_dir_url(__FILE__));
}

require_once ACME_PATH . 'core/loader.php';


if (file_exists(ACME_PATH . 'includes/post-types/course.php')) {
    require_once ACME_PATH . 'includes/post-types/course.php';
}

if (file_exists(ACME_PATH . 'includes/post-types/instructor.php')) {
    require_once ACME_PATH . 'includes/post-types/instructor.php';
}

if (file_exists(ACME_PATH . 'includes/post-types/batch.php')) {
    require_once ACME_PATH . 'includes/post-types/batch.php';
}

if (file_exists(ACME_PATH . 'includes/post-types/review.php')) {
    require_once ACME_PATH . 'includes/post-types/review.php';
}

if (file_exists(ACME_PATH . 'includes/post-types/faq.php')) {
    require_once ACME_PATH . 'includes/post-types/faq.php';
}

if (file_exists(ACME_PATH . 'includes/admin/menu.php')) {
    require_once ACME_PATH . 'includes/admin/menu.php';
}

if (file_exists(ACME_PATH . 'includes/admin/settings.php')) {
    require_once ACME_PATH . 'includes/admin/settings.php';
}

if (file_exists(ACME_PATH . 'includes/admin/settings-page.php')) {
    require_once ACME_PATH . 'includes/admin/settings-page.php';
}

if (file_exists(ACME_PATH . 'includes/init.php')) {
    require_once ACME_PATH . 'includes/init.php';
}

if (file_exists(ACME_PATH . 'admin/admin.php')) {
    require_once ACME_PATH . 'admin/admin.php';
}

if (file_exists(ACME_PATH . 'public/public.php')) {
    require_once ACME_PATH . 'public/public.php';
}

// Include DB files
require_once plugin_dir_path(__FILE__) . 'includes/db/leads-table.php';
require_once plugin_dir_path(__FILE__) . 'includes/db/logs-table.php';
require_once plugin_dir_path(__FILE__) . 'includes/db/audit-table.php';

// Include frontend files
require_once plugin_dir_path(__FILE__) . 'includes/frontend/lead-form.php';


// Create tables on activation
function acme_create_tables() {

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta(acme_get_leads_table_sql());
    dbDelta(acme_get_logs_table_sql());
    dbDelta(acme_get_audit_table_sql());
}

function acme_plugin_activate() {

    if (function_exists('acme_create_tables')) {
        acme_create_tables();
    }

    update_option('acme_db_version', ACME_DB_VERSION);
}

function acme_check_db_version() {

    // Run only in admin
    if (!is_admin()) {
        return;
    }

    $stored_version = get_option('acme_db_version');

    // If not set → skip
    if (!$stored_version) {
        return;
    }

    // If already latest → skip
    if (version_compare($stored_version, ACME_DB_VERSION, '>=')) {
        return;
    }

    // Lock to prevent multiple execution
    if (get_option('acme_db_migrating')) {
        return;
    }

    update_option('acme_db_migrating', 1);

    $migration_success = false;

    if (function_exists('acme_create_tables')) {
        acme_create_tables();

        global $wpdb;

        $tables = array(
            $wpdb->prefix . 'acme_leads',
            $wpdb->prefix . 'acme_logs',
            $wpdb->prefix . 'acme_audit'
        );

        $all_tables_exist = true;

        foreach ($tables as $table) {
            $result = $wpdb->get_var("SHOW TABLES LIKE '{$table}'");
            if ($result !== $table) {
                $all_tables_exist = false;
                break;
            }
        }

        if ($all_tables_exist) {
            $migration_success = true;
        }
    }

    // Update version ONLY if success
    if ($migration_success) {
        update_option('acme_db_version', ACME_DB_VERSION);
    }

    // Remove lock
    delete_option('acme_db_migrating');
}

add_action('admin_init', 'acme_check_db_version');

register_activation_hook(__FILE__, 'acme_plugin_activate');


