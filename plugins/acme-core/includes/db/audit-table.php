<?php

function acme_get_audit_table_sql() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'acme_audit';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT(20) UNSIGNED NOT NULL,
        action VARCHAR(100) NOT NULL,
        target VARCHAR(255) DEFAULT '' NOT NULL,
        ip_address VARCHAR(100) DEFAULT '' NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    return $sql;
}
