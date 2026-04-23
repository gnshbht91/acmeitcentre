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

function acme_user_can_access_crm($user = null)
{
    if ($user === null) {
        $user = wp_get_current_user();
    }

    return user_can($user, 'manage_options') || user_can($user, 'edit_pages');
}

function acme_get_crm_assignable_users()
{
    $users = get_users([
        'fields' => 'all'
    ]);

    return array_values(array_filter($users, function ($user) {
        return acme_user_can_access_crm($user);
    }));
}

require_once ACME_PATH . 'core/loader.php';

require_once plugin_dir_path(__FILE__) . 'dal/form-dal.php';
require_once plugin_dir_path(__FILE__) . 'modules/module-cron.php';




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
require_once plugin_dir_path(__FILE__) . 'includes/db/form-db.php';


// Include frontend files
require_once plugin_dir_path(__FILE__) . 'includes/frontend/lead-form.php';


/**
 * Register AJAX handlers
 * Audited for capability coverage: Phase 9.12.1
 * Audited for AJAX security standardization: Phase 9.13
 */

// Create tables on activation
function acme_create_tables()
{

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta(acme_get_logs_table_sql());
    dbDelta(acme_get_audit_table_sql());
    if (function_exists('acme_create_form_table')) {
        acme_create_form_table();
    }
}

function acme_plugin_activate()
{

    if (function_exists('acme_create_tables')) {
        acme_create_tables();
    }

    update_option('acme_db_version', ACME_DB_VERSION);
    return false;
}

function acme_check_db_version()
{

    // Run only in admin
    if (!is_admin()) {
        return false;
    }

    $stored_version = get_option('acme_db_version');

    // If not set → skip
    if (!$stored_version) {
        return false;
    }

    // If already latest → skip
    if (version_compare($stored_version, ACME_DB_VERSION, '>=')) {
        return false;
    }

    // Lock to prevent multiple execution
    if (get_option('acme_db_migrating')) {
        return false;
    }

    update_option('acme_db_migrating', 1);

    $migration_success = false;

    if (function_exists('acme_create_tables')) {
        acme_create_tables();

        global $wpdb;

        $tables = array(
            $wpdb->prefix . 'acme_leads',
            $wpdb->prefix . 'acme_logs',
            $wpdb->prefix . 'acme_audit',
            $wpdb->prefix . 'acme_form_entries'
        );

        $all_tables_exist = true;

        foreach ($tables as $table) {
            $result = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table));
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

    return $migration_success;
}

add_action('admin_init', 'acme_check_db_version');

function acme_schedule_cleanup()
{
    if (!wp_next_scheduled('acme_cleanup_cron')) {
        wp_schedule_event(time(), 'daily', 'acme_cleanup_cron');
    }
    return false;
}
add_action('wp', 'acme_schedule_cleanup');


function acme_clear_cleanup_cron()
{
    wp_clear_scheduled_hook('acme_cleanup_cron');
    return false;
}
register_deactivation_hook(__FILE__, 'acme_clear_cleanup_cron');

register_activation_hook(__FILE__, 'acme_plugin_activate');







/**
 * AJAX Handlers Registration
 * Audited for capability coverage: Phase 9.12.1
 */
add_action('wp_ajax_acme_form_submit', 'acme_handle_form');
add_action('wp_ajax_nopriv_acme_form_submit', 'acme_handle_form');

/**
 * CRM Menu registration
 * Restored to acme-core.php (Phase 9.14.1)
 */
add_action('admin_menu', 'acme_crm_menu');

/**
 * Enqueue jQuery on the frontend (required by form scripts)
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery');
});

/**
 * Enqueue scripts for CRM page
 */
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook === 'toplevel_page_acme-crm') {
        wp_enqueue_script('acme-admin-script', ACME_URL . 'assets/js/admin.js', array('jquery'), ACME_VERSION, true);
        wp_localize_script('acme-admin-script', 'acme_admin', [
            'nonce' => wp_create_nonce('acme_crm_ajax_nonce')
        ]);
    }
});

function acme_crm_menu()
{
    add_menu_page(
        'ACME CRM',
        'ACME CRM',
        'edit_pages',
        'acme-crm',
        'acme_crm_page',
        'dashicons-groups',
        25
    );
    return false;
}

/**
 * CRM Page Handler
 * Restored to acme-core.php (Phase 9.14.1)
 */
function acme_crm_page()
{
    if (!acme_user_can_access_crm()) {
        wp_die('Unauthorized');
    }

    // Handle Status Update
    if (
        isset($_POST['lead_id'], $_POST['status'], $_POST['_wpnonce']) &&
        wp_verify_nonce($_POST['_wpnonce'], 'acme_crm_status_nonce')
    ) {

        $clean_lead_id = intval($_POST['lead_id']);
        $clean_status = sanitize_text_field($_POST['status']);
        $valid_statuses = acme_get_valid_statuses();

        if ($clean_lead_id > 0 && in_array($clean_status, $valid_statuses, true)) {
            acme_update_lead_status($clean_lead_id, $clean_status);
        } else {
            // Optional: log or handle invalid status/ID
        }
    }

    // Handle Note Update
    if (
        isset($_POST['note'], $_POST['lead_id'], $_POST['_wpnonce']) &&
        wp_verify_nonce($_POST['_wpnonce'], 'acme_crm_note_nonce')
    ) {

        $clean_lead_id = intval($_POST['lead_id']);
        $clean_note = sanitize_textarea_field($_POST['note']);

        if ($clean_lead_id > 0) {
            acme_update_lead_note($clean_lead_id, $clean_note);
        }
    }

    // Handle Assignment Update (Validated)
    if (
        isset($_POST['lead_id'], $_POST['user_id'], $_POST['_wpnonce']) &&
        wp_verify_nonce($_POST['_wpnonce'], 'acme_crm_assign_nonce')
    ) {

        $clean_lead_id = intval($_POST['lead_id']);
        $clean_user_id = intval($_POST['user_id']);

        if ($clean_lead_id > 0) {
            // Safe user assignment validation (Phase 9.14)
            if ($clean_user_id > 0 && !get_user_by('id', $clean_user_id)) {
                // Invalid user, skip assignment
            } else {
                acme_update_lead_user($clean_lead_id, $clean_user_id);
            }
        }
    }

    $clean_page = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $clean_page = max(1, $clean_page);

    $limit = 20;
    $offset = ($clean_page - 1) * $limit;

    $clean_status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    $clean_search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

    // Validate Status Filter if provided
    if (!empty($clean_status) && !in_array($clean_status, acme_get_valid_statuses(), true)) {
        $clean_status = '';
    }

    $current_user = wp_get_current_user();
    $current_user_id = get_current_user_id();
    $is_admin = in_array('administrator', (array) $current_user->roles);

    $view_user_id = $is_admin ? 0 : $current_user_id;

    $total = acme_get_leads_count($clean_status, $clean_search, $view_user_id);
    $total_pages = max(1, ceil($total / $limit));

    $allowed_orderby = ['name', 'email', 'course', 'created_at'];
    $allowed_order = ['asc', 'desc'];

    $order_by = 'created_at';
    $order = 'desc';

    if (isset($_GET['orderby'])) {
        $temp = strtolower($_GET['orderby']);
        if (in_array($temp, $allowed_orderby)) {
            $order_by = $temp;
        }
    }

    if (isset($_GET['order'])) {
        $temp_order = strtolower($_GET['order']);
        if (in_array($temp_order, $allowed_order)) {
            $order = $temp_order;
        }
    }

    $leads = acme_get_leads($limit, $offset, $clean_status, $clean_search, $view_user_id, $order_by, $order);

    $users = acme_get_crm_assignable_users();

    echo '<div class="wrap">';
    echo '<h1>ACME CRM</h1>';

    echo '<form method="GET">';
    echo '<input type="hidden" name="page" value="acme-crm">';

    echo '<select name="status">';
    echo '<option value="">All Status</option>';
    $valid_statuses = acme_get_valid_statuses();
    foreach ($valid_statuses as $s) {
        $selected = selected($clean_status, $s, false);
        echo '<option value="' . esc_attr($s) . '" ' . $selected . '>' . ucfirst(esc_html($s)) . '</option>';
    }
    echo '</select>';

    echo '<input type="text" name="search" placeholder="Search..." value="' . esc_attr($clean_search) . '">';

    echo '<button class="button">Filter</button>';
    echo '</form>';

    if ($is_admin) {
        echo '<button id="acme-bulk-delete-btn">Delete Selected</button>';
        echo ' | ';
    }
    echo '<input type="text" id="acme-search" placeholder="Search by name or email">';
    echo '<select id="acme-filter-status" style="margin-left: 10px; vertical-align: middle;">';
    echo '<option value="">All Statuses</option>';
    foreach (acme_get_valid_statuses() as $status) {
        echo '<option value="' . esc_attr($status) . '">' . esc_html(ucfirst($status)) . '</option>';
    }
    echo '</select>';
    echo '<button id="acme-export-csv" class="button" style="margin-left: 10px;">Export CSV</button>';
    echo '<span id="acme-search-empty" style="display:none; color:red; margin-left:10px;">No results found in current view</span>';

    ?>
    <?php if ($is_admin): ?>
        <select id="acme-bulk-status">
            <option value="">Select Status</option>
            <?php foreach (acme_get_valid_statuses() as $status): ?>
                <option value="<?php echo esc_attr($status); ?>">
                    <?php echo esc_html(ucfirst($status)); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button id="acme-bulk-status-btn">Update Status</button>
    <?php endif; ?>
    <?php
    echo '<table id="acme-leads-table" class="widefat fixed striped">';
    echo '<thead><tr>
        <th>
            <input type="checkbox" id="acme-select-all">
        </th>
        <th>ID</th>
        <th><a href="' . esc_url(add_query_arg(['orderby' => 'name', 'order' => ($order_by === 'name' && $order === 'asc' ? 'desc' : 'asc')])) . '">Name</a></th>
        <th>Phone</th>
        <th><a href="' . esc_url(add_query_arg(['orderby' => 'email', 'order' => ($order_by === 'email' && $order === 'asc' ? 'desc' : 'asc')])) . '">Email</a></th>
        <th><a href="' . esc_url(add_query_arg(['orderby' => 'course', 'order' => ($order_by === 'course' && $order === 'asc' ? 'desc' : 'asc')])) . '">Course</a></th>
        <th>Status</th>
        <th>Note</th>
        ' . ($is_admin ? '<th>Assign</th>' : '') . '
        <th><a href="' . esc_url(add_query_arg(['orderby' => 'created_at', 'order' => ($order_by === 'created_at' && $order === 'asc' ? 'desc' : 'asc')])) . '">Date</a></th>
        ' . ($is_admin ? '<th>Actions</th>' : '') . '
    </tr></thead>';

    echo '<tbody>';

    if (!empty($leads)) {
        foreach ($leads as $lead) {
            echo '<tr>';
            ?>
            <td>
                <input type="checkbox" class="acme-select-row" value="<?php echo esc_attr($lead['id']); ?>">
            </td>
            <?php
            echo '<td>' . esc_html($lead['id']) . '</td>';
            echo '<td>' . esc_html($lead['name']) . '</td>';
            echo '<td>' . esc_html($lead['phone']) . '</td>';
            echo '<td>' . esc_html($lead['email']) . '</td>';
            echo '<td>' . esc_html($lead['course']) . '</td>';
            echo '<td>';
            echo '<form method="POST">';
            wp_nonce_field('acme_crm_status_nonce');

            echo '<input type="hidden" name="lead_id" value="' . esc_attr($lead['id']) . '">';

            echo '<select name="status" onchange="this.form.submit()">';

            $statuses = acme_get_valid_statuses();

            foreach ($statuses as $s) {
                echo '<option value="' . esc_attr($s) . '" ' . selected($lead['status'], $s, false) . '>' . esc_html(ucfirst($s)) . '</option>';
            }

            echo '</select>';
            echo '</form>';
            echo '</td>';

            echo '<td>';
            echo '<form method="POST">';
            wp_nonce_field('acme_crm_note_nonce');

            echo '<input type="hidden" name="lead_id" value="' . esc_attr($lead['id']) . '">';

            echo '<textarea name="note" rows="2">' . esc_textarea($lead['note']) . '</textarea>';

            echo '<br><button class="button">Save</button>';

            echo '</form>';
            echo '</td>';

            if ($is_admin) {
                echo '<td>';
                echo '<form method="POST">';
                wp_nonce_field('acme_crm_assign_nonce');

                echo '<input type="hidden" name="lead_id" value="' . esc_attr($lead['id']) . '">';

                echo '<select name="user_id">';

                echo '<option value="0" ' . selected($lead['user_id'], 0, false) . '>Unassigned</option>';

                foreach ($users as $user) {
                    echo '<option value="' . esc_attr($user->ID) . '" ' . selected($lead['user_id'], $user->ID, false) . '>' . esc_html($user->display_name) . '</option>';
                }

                echo '</select>';
                echo '<button class="button button-primary">Save</button>';
                echo '</form></td>';
            }

            echo '<td>' . esc_html($lead['created_at']) . '</td>';
            if ($is_admin) {
                echo '<td><button class="acme-delete-btn button" data-id="' . esc_attr($lead['id']) . '">Delete</button></td>';
            }
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="' . ($is_admin ? 10 : 8) . '">No leads found</td></tr>';
    }

    echo '</tbody>';
    echo '</table>';

    echo '<div class="tablenav"><div class="tablenav-pages">';

    $base_url = admin_url('admin.php?page=acme-crm');
    if (!empty($clean_status)) {
        $base_url = add_query_arg('status', $clean_status, $base_url);
    }
    if (!empty($clean_search)) {
        $base_url = add_query_arg('search', $clean_search, $base_url);
    }

    if ($clean_page > 1) {
        $prev_url = add_query_arg('paged', $clean_page - 1, $base_url);
        echo '<a class="button" href="' . esc_url($prev_url) . '">Prev</a> ';
    }

    echo ' Page ' . $clean_page . ' of ' . $total_pages . ' ';

    if ($clean_page < $total_pages) {
        $next_url = add_query_arg('paged', $clean_page + 1, $base_url);
        echo '<a class="button" href="' . esc_url($next_url) . '">Next</a>';
    }

    echo '</div></div>';


    echo '</div>';
    return false;
}
