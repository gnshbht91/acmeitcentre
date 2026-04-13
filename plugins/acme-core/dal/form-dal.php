<?php
if (!defined('ABSPATH')) exit;

/**
 * DAL: Form Entries
 * Audited for user_id = 0 safety (Phase 9.14.1)
 */
function acme_get_valid_statuses() {
    return ['new','duplicate','contacted','qualified','converted','closed'];
}


// Note: acme_create_form_table moved to includes/db/form-db.php

function acme_insert_form_entry(
    $name,
    $phone,
    $email,
    $course,
    $url = '',
    $utm_source = '',
    $utm_medium = '',
    $utm_campaign = '',
    $ip = '',
    $parent_id = null,
    $status = 'new'
) {
    $name = sanitize_text_field($name);
    $phone = sanitize_text_field($phone);
    $email = sanitize_email($email);
    $course = sanitize_text_field($course);
    $url = esc_url_raw($url);
    $utm_source = sanitize_text_field($utm_source);
    $utm_medium = sanitize_text_field($utm_medium);
    $utm_campaign = sanitize_text_field($utm_campaign);
    $ip = sanitize_text_field($ip);
    $parent_id = $parent_id ? intval($parent_id) : null;
    $status = in_array($status, acme_get_valid_statuses(), true) ? $status : 'new';

    global $wpdb;

    $table_name = $wpdb->prefix . 'acme_form_entries';

    $users = get_users([
        'role__in' => ['administrator', 'editor'],
        'fields' => 'ID'
    ]);

    $user_id = 0; // Default to unassigned
    if (!empty($users)) {
        $random_key = array_rand($users);
        $user_id = $users[$random_key];
    }

    $result = $wpdb->insert(
        $table_name,
        [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'course' => $course,
            'url' => $url,
            'utm_source' => $utm_source,
            'utm_medium' => $utm_medium,
            'utm_campaign' => $utm_campaign,
            'ip_address' => $ip,
            'parent_id' => $parent_id,
            'status' => $status,
            'user_id' => $user_id,
            'created_at' => current_time('mysql')
        ],
        [
            '%s','%s','%s','%s',
            '%s','%s','%s','%s',
            '%s','%d','%s','%d',
            '%s'
        ]
    );

    if ($wpdb->last_error) {
        error_log('ACME DB ERROR: ' . $wpdb->last_error);
    }

    if ($result === false) {
        return false;
    }

    return $wpdb->insert_id;
}

function acme_check_duplicate($email, $phone) {
    if (empty($email) && empty($phone)) {
        return false;
    }

    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    $query = $wpdb->prepare(
        "SELECT id FROM $table
         WHERE email = %s
         OR phone = %s
         LIMIT 1",
        $email,
        $phone
    );

    $id = $wpdb->get_var($query);
    return $id ? (int) $id : false;
}



function acme_export_user_data($email = '', $phone = '') {
    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    if (empty($email) && empty($phone)) {
        return [];
    }

    $query = "SELECT * FROM $table WHERE (1=0";

    if (!empty($email)) {
        $query .= $wpdb->prepare(" OR email = %s", $email);
    }

    if (!empty($phone)) {
        $query .= $wpdb->prepare(" OR phone = %s", $phone);
    }

    $query .= ")";

    if (!current_user_can('manage_options')) {
        $user_id = get_current_user_id();
        $query .= $wpdb->prepare(" AND user_id = %d", $user_id);
    }

    $results = $wpdb->get_results($query, ARRAY_A);
    return is_array($results) ? $results : [];
}

function acme_delete_user_data($email = '', $phone = '') {
    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    if (empty($email) && empty($phone)) {
        return false;
    }

    $query = "DELETE FROM $table WHERE (1=0";

    if (!empty($email)) {
        $query .= $wpdb->prepare(" OR email = %s", $email);
    }

    if (!empty($phone)) {
        $query .= $wpdb->prepare(" OR phone = %s", $phone);
    }

    $query .= ")";

    if (!current_user_can('manage_options')) {
        $user_id = get_current_user_id();
        $query .= $wpdb->prepare(" AND user_id = %d", $user_id);
    }

    return $wpdb->query($query);
}

function acme_get_leads($limit = 20, $offset = 0, $status = '', $search = '', $user_id = 0) {
    $limit = max(1, intval($limit));
    $offset = max(0, intval($offset));
    $user_id = max(0, intval($user_id));
    $status = sanitize_text_field($status);
    $search = sanitize_text_field($search);

    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    $where = "WHERE 1=1";
    $params = [];

    // Enforcement: Non-admins can only see their own leads (Phase 9.15)
    if (!current_user_can('manage_options')) {
        $user_id = get_current_user_id();
        if ($user_id === 0) {
            return []; // Fail-fast for non-logged in or unauthorized access
        }
    }

    if ($user_id > 0) {
        $where .= " AND user_id = %d";
        $params[] = $user_id;
    }

    if (!empty($status)) {
        $where .= " AND status = %s";
        $params[] = $status;
    }

    if (!empty($search)) {
        $where .= " AND (name LIKE %s OR email LIKE %s OR phone LIKE %s)";
        $like = '%' . $wpdb->esc_like($search) . '%';
        $params[] = $like;
        $params[] = $like;
        $params[] = $like;
    }

    $params[] = $limit;
    $params[] = $offset;

    $query = $wpdb->prepare(
        "SELECT * FROM $table $where ORDER BY created_at DESC LIMIT %d OFFSET %d",
        ...$params
    );

    $results = $wpdb->get_results($query, ARRAY_A);
    return is_array($results) ? $results : [];
}

function acme_get_leads_count($status = '', $search = '', $user_id = 0) {
    $user_id = max(0, intval($user_id));
    $status = sanitize_text_field($status);
    $search = sanitize_text_field($search);
    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    $where = "WHERE 1=1";
    $params = [];

    // Enforcement: Non-admins can only see their own leads (Phase 9.15)
    if (!current_user_can('manage_options')) {
        $user_id = get_current_user_id();
        if ($user_id === 0) {
            return 0;
        }
    }

    if ($user_id > 0) {
        $where .= " AND user_id = %d";
        $params[] = $user_id;
    }

    if (!empty($status)) {
        $where .= " AND status = %s";
        $params[] = $status;
    }

    if (!empty($search)) {
        $where .= " AND (name LIKE %s OR email LIKE %s OR phone LIKE %s)";
        $like = '%' . $wpdb->esc_like($search) . '%';
        $params[] = $like;
        $params[] = $like;
        $params[] = $like;
    }

    $query = $wpdb->prepare(
        "SELECT COUNT(*) FROM $table $where",
        ...$params
    );

    return (int) $wpdb->get_var($query);
}
function acme_update_lead_status($lead_id, $status) {
    $lead_id = intval($lead_id);
    $status = sanitize_text_field($status);

    if ($lead_id <= 0 || !in_array($status, acme_get_valid_statuses(), true)) {
        return false;
    }

    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    $where = ['id' => $lead_id];
    $where_format = ['%d'];

    if (!current_user_can('manage_options')) {
        $where['user_id'] = get_current_user_id();
        $where_format[] = '%d';
    }

    return $wpdb->update(
        $table,
        ['status' => $status],
        $where,
        ['%s'],
        $where_format
    );
}

function acme_update_lead_note($lead_id, $note) {
    $clean_lead_id = intval($lead_id);
    $clean_note = sanitize_textarea_field($note);

    if ($clean_lead_id <= 0) {
        return false;
    }

    global $wpdb;

    $table = $wpdb->prefix . 'acme_form_entries';

    $where = ['id' => $clean_lead_id];
    $where_format = ['%d'];

    if (!current_user_can('manage_options')) {
        $where['user_id'] = get_current_user_id();
        $where_format[] = '%d';
    }

    return $wpdb->update(
        $table,
        ['note' => $clean_note],
        $where,
        ['%s'],
        $where_format
    );
}

function acme_update_lead_user($lead_id, $user_id) {
    if (!current_user_can('manage_options')) {
        return false;
    }

    $clean_lead_id = intval($lead_id);
    $clean_user_id = intval($user_id);

    if ($clean_lead_id <= 0) {
        return false;
    }

    global $wpdb;

    // Validate user exists if not unassigning (0)
    if ($clean_user_id > 0) {
        $user = get_user_by('id', $clean_user_id);
        if (!$user) {
            return false;
        }
    }

    $table = $wpdb->prefix . 'acme_form_entries';

    return $wpdb->update(
        $table,
        ['user_id' => $clean_user_id],
        ['id' => $clean_lead_id],
        ['%d'],
        ['%d']
    );
}

