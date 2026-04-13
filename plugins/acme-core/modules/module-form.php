<?php
if (!defined('ABSPATH')) exit;

/**
 * Register form shortcode
 */
function acme_register_form_shortcode() {
    add_shortcode('acme_form', 'acme_render_form');
    return false;
}
add_action('init', 'acme_register_form_shortcode');

/**
 * Render form UI
 */
function acme_render_form() {
    ob_start();
    ?>

    <form method="post" class="acme-form">
        <?php wp_nonce_field('acme_form_action', 'acme_form_nonce'); ?>
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
    jQuery(document).ready(function($) {
        $('.acme-form').on('submit', function(e) {
            e.preventDefault();

            // Populate tracking fields
            document.getElementById('acme_url').value = window.location.href;
            const params = new URLSearchParams(window.location.search);
            document.getElementById('acme_utm_source').value = params.get('utm_source') || '';
            document.getElementById('acme_utm_medium').value = params.get('utm_medium') || '';
            document.getElementById('acme_utm_campaign').value = params.get('utm_campaign') || '';

            var form = $(this);
            var data = form.serialize() + '&action=acme_form_submit';

            $.post('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', data, function(response) {
                if (response.success) {
                    alert(response.data.message);
                    form[0].reset();
                } else {
                    alert(response.data.message || 'Submission failed');
                }
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
function acme_handle_form() {
    if (empty($_POST)) {
        wp_send_json_error(['message' => 'No data received']);
    }

    // 1. Nonce verification
    check_ajax_referer('acme_form_action', 'acme_form_nonce');

    // 2. Honeypot check
    if (isset($_POST['acme_hp_field']) && !empty($_POST['acme_hp_field'])) {
        wp_send_json_error(['message' => 'Invalid input']);
    }

    // 3. Sanitize input
    $clean_name   = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $clean_phone  = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $clean_email  = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $clean_course = isset($_POST['course']) ? sanitize_text_field($_POST['course']) : '';

    // 4. Basic validation
    if (empty($clean_name) || empty($clean_phone) || empty($clean_email) || empty($clean_course)) {
        error_log('ACME VALIDATION FAILED: Missing fields');

        wp_send_json_error([
            'message' => 'Required fields missing'
        ]);
    }

    if (!is_email($clean_email)) {
        wp_send_json_error(['message' => 'Invalid email']);
    }

    // 5. Insert to DB
    $clean_url = isset($_POST['url']) ? esc_url_raw($_POST['url']) : '';
    $clean_utm_source = isset($_POST['utm_source']) ? sanitize_text_field($_POST['utm_source']) : '';
    $clean_utm_medium = isset($_POST['utm_medium']) ? sanitize_text_field($_POST['utm_medium']) : '';
    $clean_utm_campaign = isset($_POST['utm_campaign']) ? sanitize_text_field($_POST['utm_campaign']) : '';
    $clean_ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '';

    $existing_id = acme_check_duplicate($clean_email, $clean_phone);

    if ($existing_id) {
        $parent_id = intval($existing_id);
        $status = 'duplicate';
    } else {
        $parent_id = null;
        $status = 'new';
    }

    // Strict status validation
    if (!in_array($status, acme_get_valid_statuses(), true)) {
        wp_send_json_error(['message' => 'Invalid status']);
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

        wp_send_json_error([
            'message' => 'Failed to save data'
        ]);
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

    $mail_sent = wp_mail($email_to, $subject, $message, $headers);

    if (!$mail_sent) {
        error_log('ACME MAIL FAILED');
    }

    wp_send_json_success([
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
    ]);

}

add_action('wp_ajax_acme_export_data', 'acme_export_data');

function acme_export_data() {
    if (empty($_POST)) {
        wp_send_json_error(['message' => 'No data received']);
    }
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    // 1. Nonce verification
    check_ajax_referer('acme_export_nonce', '_wpnonce');

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

function acme_delete_data() {
    if (empty($_POST)) {
        wp_send_json_error(['message' => 'No data received']);
    }
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    // 1. Nonce verification
    check_ajax_referer('acme_export_nonce', '_wpnonce');

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


