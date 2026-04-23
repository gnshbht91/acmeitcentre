<?php
if (!defined('ABSPATH'))
    exit;

/**
 * Register form shortcode
 */
function acme_register_form_shortcode()
{
    add_shortcode('acme_form', 'acme_render_form');
    return false;
}
add_action('init', 'acme_register_form_shortcode');

/**
 * Render form UI
 */
function acme_render_form()
{
    ob_start();
    ?>

    <form method="post" class="acme-form">
        <?php wp_nonce_field('acme_crm_form_nonce', 'acme_form_nonce', false); ?>
        <div style="position:absolute; left:-9999px;">
            <input type="text" name="acme_hp_field" value="" autocomplete="off">
        </div>

        <input type="hidden" name="url" id="acme_url">
        <input type="hidden" name="utm_source" id="acme_utm_source">
        <input type="hidden" name="utm_medium" id="acme_utm_medium">
        <input type="hidden" name="utm_campaign" id="acme_utm_campaign">

        <p>
            <label><?php echo esc_html('Name'); ?></label><br>
            <input type="text" name="name" required>
        </p>

        <p>
            <label><?php echo esc_html('Phone'); ?></label><br>
            <input type="text" name="phone" required>
        </p>

        <p>
            <label><?php echo esc_html('Email'); ?></label><br>
            <input type="email" name="email" required>
        </p>

        <p>
            <label><?php echo esc_html('Course'); ?></label><br>
            <input type="text" name="course" required>
        </p>

        <p>
            <button type="submit"><?php echo esc_html('Submit'); ?></button>
        </p>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.querySelector('.acme-form');
            if (!form) return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Populate tracking fields
                document.getElementById('acme_url').value = window.location.href;
                var params = new URLSearchParams(window.location.search);
                document.getElementById('acme_utm_source').value = params.get('utm_source') || '';
                document.getElementById('acme_utm_medium').value = params.get('utm_medium') || '';
                document.getElementById('acme_utm_campaign').value = params.get('utm_campaign') || '';

                var formData = new FormData(form);
                formData.append('action', 'acme_form_submit');

                fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(function (res) { return res.json(); })
                .then(function (response) {
                    if (response.success) {
                        alert(response.data.message);
                        form.reset();
                    } else {
                        alert((response.data && response.data.message) || 'Submission failed');
                    }
                })
                .catch(function () {
                    alert('Request failed. Please try again.');
                });
            });
        });
    </script>

    <?php
    return ob_get_clean();
}

/**
 * AJAX Handler Registration
 * Audited for capability coverage: Phase 9.12.1
 */


/**
 * Basic AJAX handler
 */
function acme_process_lead_submission($raw_data)
{
    $clean_name = isset($raw_data['name']) ? sanitize_text_field($raw_data['name']) : '';
    $clean_phone = isset($raw_data['phone']) ? sanitize_text_field($raw_data['phone']) : '';
    $clean_email = isset($raw_data['email']) ? sanitize_email($raw_data['email']) : '';
    $clean_course = isset($raw_data['course']) ? sanitize_text_field($raw_data['course']) : '';

    if (empty($clean_name) || empty($clean_phone) || empty($clean_email) || empty($clean_course)) {
        return [
            'success' => false,
            'message' => 'Required fields missing'
        ];
    }

    if (!is_email($clean_email)) {
        return [
            'success' => false,
            'message' => 'Invalid email'
        ];
    }

    $clean_url = isset($raw_data['url']) ? esc_url_raw($raw_data['url']) : '';
    $clean_utm_source = isset($raw_data['utm_source']) ? sanitize_text_field($raw_data['utm_source']) : '';
    $clean_utm_medium = isset($raw_data['utm_medium']) ? sanitize_text_field($raw_data['utm_medium']) : '';
    $clean_utm_campaign = isset($raw_data['utm_campaign']) ? sanitize_text_field($raw_data['utm_campaign']) : '';
    $clean_ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '';

    $existing_id = acme_check_duplicate($clean_email, $clean_phone);

    if ($existing_id) {
        $parent_id = (int) $existing_id;
        $status = 'duplicate';
    } else {
        $parent_id = null;
        $status = 'new';
    }

    if (!in_array($status, acme_get_valid_statuses(), true)) {
        return [
            'success' => false,
            'message' => 'Invalid status'
        ];
    }

    $insert_id = acme_insert_form_entry(
        $clean_name,
        $clean_phone,
        $clean_email,
        $clean_course,
        $clean_url,
        $clean_utm_source,
        $clean_utm_medium,
        $clean_utm_campaign,
        $clean_ip,
        $parent_id,
        $status
    );

    if (!$insert_id) {
        error_log('ACME INSERT FAILED');

        return [
            'success' => false,
            'message' => 'Failed to save data'
        ];
    }

    $email_to = get_option('admin_email');
    $subject = 'New Lead Received';
    $message = sprintf(
        "New lead submitted:\n\nName: %s\nPhone: %s\nEmail: %s\nCourse: %s",
        $clean_name,
        $clean_phone,
        $clean_email,
        $clean_course
    );
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    if (!wp_mail($email_to, $subject, $message, $headers)) {
        error_log('ACME MAIL FAILED');
    }

    return [
        'success' => true,
        'message' => 'Form submitted successfully',
        'data' => [
            'status' => 'saved',
            'entry_id' => $insert_id,
            'fields' => [
                'name' => $clean_name,
                'phone' => $clean_phone,
                'email' => $clean_email,
                'course' => $clean_course
            ]
        ]
    ];
}

function acme_handle_form()
{
    error_log('ACME FORM HIT: ' . wp_json_encode($_POST));

    if (empty($_POST)) {
        wp_send_json_error(['message' => 'No data received']);
    }

    // 1. Nonce verification
    check_ajax_referer('acme_crm_form_nonce', 'acme_form_nonce');

    // 2. Honeypot check
    if (isset($_POST['acme_hp_field']) && !empty($_POST['acme_hp_field'])) {
        wp_send_json_error(['message' => 'Invalid input']);
    }

    $result = acme_process_lead_submission($_POST);

    if (!$result['success']) {
        wp_send_json_error([
            'message' => $result['message']
        ]);
    }

    wp_send_json_success([
        'message' => $result['message'],
        'data' => $result['data']
    ]);

}

add_action('wp_ajax_acme_export_data', 'acme_export_data');

function acme_export_data()
{
    if (empty($_POST)) {
        wp_send_json_error(['message' => 'No data received']);
    }
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    // 1. Nonce verification
    check_ajax_referer('acme_crm_export_nonce', '_wpnonce');

    $clean_email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $clean_phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

    if (empty($clean_email) && empty($clean_phone)) {
        wp_send_json_error(['message' => 'Email or phone required']);
    }

    $data = acme_export_user_data($clean_email, $clean_phone);

    wp_send_json_success([
        'message' => 'Data exported successfully',
        'data' => $data
    ]);
}

add_action('wp_ajax_acme_delete_data', 'acme_delete_data');

function acme_delete_data()
{
    if (empty($_POST)) {
        wp_send_json_error(['message' => 'No data received']);
    }
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    // 1. Nonce verification
    check_ajax_referer('acme_crm_export_nonce', '_wpnonce');

    $clean_email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $clean_phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

    if (empty($clean_email) && empty($clean_phone)) {
        wp_send_json_error(['message' => 'Email or phone required']);
    }

    $deleted = acme_delete_user_data($clean_email, $clean_phone);

    wp_send_json_success([
        'message' => 'Data deleted successfully',
        'data' => [
            'deleted' => $deleted
        ]
    ]);
}



/**
 * AJAX Handler for lead deletion
 */
function acme_handle_delete_lead()
{
    error_log('DELETE HANDLER HIT');
    // Nonce validation
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'acme_crm_ajax_nonce')) {
        error_log('DELETE FAILED: Invalid nonce. POST: ' . print_r($_POST, true));
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    // Capability check
    if (!acme_user_can_access_crm()) {
        error_log('DELETE FAILED: Unauthorized user.');
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    // Input validation
    $lead_id = isset($_POST['lead_id']) ? intval($_POST['lead_id']) : 0;
    if ($lead_id <= 0) {
        error_log('DELETE FAILED: Invalid ID: ' . $_POST['lead_id']);
        wp_send_json_error(['message' => 'Invalid ID']);
    }

    // Call DAL
    $result = acme_delete_lead_by_id($lead_id);
    if (!$result) {
        error_log('DELETE FAILED: DAL returned false for ID: ' . $lead_id);
    } else {
        error_log('DELETE SUCCESS for ID: ' . $lead_id);
    }

    // Handle result
    if ($result) {
        wp_send_json_success(['message' => 'Deleted']);
    } else {
        wp_send_json_error(['message' => 'Failed']);
    }
}
add_action('wp_ajax_acme_delete_lead', 'acme_handle_delete_lead');

/**
 * AJAX Handler for bulk lead deletion
 */
function acme_handle_bulk_delete()
{
    error_log('BULK DELETE HANDLER HIT');
    // STEP 3 - CHECK NONCE
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'acme_crm_ajax_nonce')) {
        error_log('BULK DELETE FAILED: Invalid nonce. POST: ' . print_r($_POST, true));
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    // STEP 4 - CHECK ADMIN
    if (!acme_user_can_access_crm()) {
        error_log('BULK DELETE FAILED: Unauthorized user.');
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    $raw_lead_ids = isset($_POST['lead_ids']) ? $_POST['lead_ids'] : null;

    if (is_string($raw_lead_ids)) {
        $raw_lead_ids = explode(',', $raw_lead_ids);
    }

    // STEP 5 - CHECK INPUT
    if (!is_array($raw_lead_ids)) {
        error_log('BULK DELETE FAILED: Invalid input. Type: ' . gettype($raw_lead_ids));
        wp_send_json_error(['message' => 'Invalid input']);
    }

    if (empty($raw_lead_ids)) {
        error_log('BULK DELETE FAILED: No IDs provided.');
        wp_send_json_error(['message' => 'No IDs provided']);
    }

    // STEP 6 - CLEAN DATA
    $lead_ids = array_map('intval', $raw_lead_ids);
    $lead_ids = array_filter($lead_ids, function ($id) {
        return $id > 0;
    });

    // STEP 7 - FINAL CHECK
    if (empty($lead_ids)) {
        error_log('BULK DELETE FAILED: No valid IDs after filtering.');
        wp_send_json_error(['message' => 'No valid IDs']);
    }

    // STEP 8 - CALL DAL
    $result = acme_delete_leads_bulk($lead_ids);
    if (!$result) {
        error_log('BULK DELETE FAILED: DAL returned false for IDs: ' . implode(',', $lead_ids));
    } else {
        error_log('BULK DELETE SUCCESS for IDs: ' . implode(',', $lead_ids));
    }

    // STEP 9 - RESPONSE
    if ($result) {
        wp_send_json_success(['message' => 'Bulk delete successful']);
    } else {
        wp_send_json_error(['message' => 'Bulk delete failed']);
    }
}

// STEP 11 - REGISTER AJAX
add_action('wp_ajax_acme_bulk_delete_leads', 'acme_handle_bulk_delete');

/**
 * AJAX Handler for bulk status update
 */
function acme_handle_bulk_status_update()
{

    if (
        !isset($_POST['_wpnonce']) ||
        !wp_verify_nonce($_POST['_wpnonce'], 'acme_crm_ajax_nonce')
    ) {
        wp_send_json_error(array('message' => 'Invalid nonce'));
    }

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    if (!isset($_POST['lead_ids']) || !is_array($_POST['lead_ids'])) {
        wp_send_json_error(array('message' => 'Invalid lead IDs'));
    }

    if (!isset($_POST['status']) || trim($_POST['status']) === '') {
        wp_send_json_error(array('message' => 'Invalid status'));
    }

    $lead_ids = array_map('intval', $_POST['lead_ids']);
    $status = sanitize_text_field($_POST['status']);

    if (!in_array($status, acme_get_valid_statuses(), true)) {
        wp_send_json_error(array('message' => 'Invalid status'));
    }

    $valid_ids = array();

    foreach ($lead_ids as $id) {
        if ($id > 0) {
            $valid_ids[] = $id;
        }
    }

    if (empty($valid_ids)) {
        wp_send_json_error(array('message' => 'No valid IDs'));
    }

    $result = acme_update_leads_status_bulk($valid_ids, $status);

    if ($result) {
        wp_send_json_success(array('message' => 'Status updated'));
    } else {
        wp_send_json_error(array('message' => 'Update failed'));
    }
}

add_action('wp_ajax_acme_bulk_status_update', 'acme_handle_bulk_status_update');
