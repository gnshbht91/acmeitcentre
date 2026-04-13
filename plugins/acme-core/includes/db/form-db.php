<?php
if (!defined('ABSPATH')) exit;

function acme_create_form_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'acme_form_entries';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        email VARCHAR(255) NOT NULL,
        course VARCHAR(255) DEFAULT '',
        url TEXT,
        utm_source VARCHAR(255),
        utm_medium VARCHAR(255),
        utm_campaign VARCHAR(255),
        ip_address VARCHAR(100),
        parent_id BIGINT DEFAULT NULL,
        status VARCHAR(50) DEFAULT 'new',
        user_id BIGINT DEFAULT NULL,
        note TEXT DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
