<?php

function acme_lead_form_shortcode() {

    $acme_success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acme_lead_nonce'])) {

        if (!wp_verify_nonce($_POST['acme_lead_nonce'], 'acme_lead_form_action')) {
            return 'Security check failed';
        }

        $name   = sanitize_text_field($_POST['acme_name'] ?? '');
        $phone  = sanitize_text_field($_POST['acme_phone'] ?? '');
        $email  = sanitize_email($_POST['acme_email'] ?? '');
        $course = sanitize_text_field($_POST['acme_course'] ?? '');

        $lead_inserted = false;
        $log_inserted = false;
        $audit_inserted = false;

        global $wpdb;

        $table = $wpdb->prefix . 'acme_leads';

        $lead_inserted = $wpdb->insert(
            $table,
            array(
                'name'   => $name,
                'phone'  => $phone,
                'email'  => $email,
                'course' => $course,
                'source' => 'website',
                'status' => 'new'
            ),
            array('%s','%s','%s','%s','%s','%s')
        );

        if ($lead_inserted) {

            $lead_id = $wpdb->insert_id;

            $log_inserted = $wpdb->insert(
                $wpdb->prefix . 'acme_logs',
                array(
                    'lead_id' => $lead_id,
                    'action'  => 'lead_created',
                    'message' => 'New lead created from form'
                ),
                array('%d','%s','%s')
            );

            if ($log_inserted) {

                $audit_inserted = $wpdb->insert(
                    $wpdb->prefix . 'acme_audit',
                    array(
                        'user_id'    => get_current_user_id() ?: 0,
                        'action'     => 'lead_created',
                        'target'     => 'lead_id_' . intval($lead_id),
                        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? ''
                    ),
                    array('%d','%s','%s','%s')
                );
            }
        }

        $acme_success = ($lead_inserted && $log_inserted && $audit_inserted);
    }


    ob_start();
    ?>

    <?php if ($acme_success): ?>
        <p style="color: green;">
            <?php echo esc_html('Thank you! Your submission has been received.'); ?>
        </p>
    <?php endif; ?>

    <form method="post">

        <?php wp_nonce_field('acme_lead_form_action', 'acme_lead_nonce'); ?>

        <p>
            <label><?php echo esc_html('Name'); ?></label><br>
            <input type="text" name="acme_name" required>
        </p>

        <p>
            <label><?php echo esc_html('Phone'); ?></label><br>
            <input type="text" name="acme_phone" required>
        </p>

        <p>
            <label><?php echo esc_html('Email'); ?></label><br>
            <input type="email" name="acme_email">
        </p>

        <p>
            <label><?php echo esc_html('Course'); ?></label><br>
            <input type="text" name="acme_course">
        </p>

        <p>
            <button type="submit">Submit</button>
        </p>

    </form>

    <?php
    return ob_get_clean();
}

add_shortcode('acme_lead_form', 'acme_lead_form_shortcode');
