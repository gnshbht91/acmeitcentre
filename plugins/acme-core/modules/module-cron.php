<?php
if (!defined('ABSPATH')) exit;

/**
 * Cleanup old duplicate leads.
 */
function acme_cleanup_old_leads() {
    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM $table
             WHERE status = %s
             AND created_at < NOW() - INTERVAL 30 DAY",
            'duplicate'
        )
    );
}

add_action('acme_cleanup_cron', 'acme_cleanup_old_leads');
