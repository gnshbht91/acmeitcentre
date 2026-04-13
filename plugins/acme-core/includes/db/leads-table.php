<?php

function acme_get_leads_table_sql() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'acme_leads';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        email VARCHAR(255) DEFAULT '' NOT NULL,
        course VARCHAR(255) DEFAULT '' NOT NULL,
        source VARCHAR(100) DEFAULT '' NOT NULL,
        status VARCHAR(50) DEFAULT 'new' NOT NULL,
        note TEXT NULL,
        user_id INT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    return $sql;
}
