<?php

if (!defined('ABSPATH')) {
    exit;
}

function acme_register_batch_cpt() {

    $labels = array(
        'name' => 'Batches',
        'singular_name' => 'Batch',
        'menu_name' => 'Batches',
        'add_new' => 'Add Batch',
        'add_new_item' => 'Add New Batch',
        'edit_item' => 'Edit Batch',
        'new_item' => 'New Batch',
        'view_item' => 'View Batch',
        'search_items' => 'Search Batches',
        'not_found' => 'No Batches found',
        'all_items' => 'Batches'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'show_in_menu' => false
    );

    register_post_type('batch', $args);
}

add_action('init', 'acme_register_batch_cpt');

/**
 * Add Meta Box for Batch Details
 */
function acme_add_batch_meta_box() {
    add_meta_box(
        'acme_batch_fields',
        'Batch Details',
        'acme_render_batch_meta_box',
        'batch',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'acme_add_batch_meta_box');

/**
 * Render Meta Box UI
 */
function acme_render_batch_meta_box($post) {
    // Add Nonce
    wp_nonce_field('acme_batch_nonce', 'acme_batch_nonce');

    // Get existing values
    $start_date = get_post_meta($post->ID, '_batch_start_date', true);
    $duration = get_post_meta($post->ID, '_batch_duration', true);
    $seats = get_post_meta($post->ID, '_batch_seats', true);
    $mode = get_post_meta($post->ID, '_batch_mode', true);
    $selected_course = get_post_meta($post->ID, '_batch_course_id', true);

    $courses = get_posts([
        'post_type' => 'course',
        'numberposts' => -1,
        'post_status' => 'publish'
    ]);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="acme_batch_course">Select Course</label></th>
            <td>
                <select name="acme_batch_course" id="acme_batch_course" required class="regular-text">
                    <option value="">Select Course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo esc_attr($course->ID); ?>" <?php selected($selected_course, $course->ID); ?>>
                            <?php echo esc_html($course->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="acme_batch_start_date">Start Date</label></th>
            <td>
                <input type="date" name="acme_batch_start_date" id="acme_batch_start_date" value="<?php echo esc_attr($start_date); ?>" required class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="acme_batch_duration">Duration (Months)</label></th>
            <td>
                <input type="number" name="acme_batch_duration" id="acme_batch_duration" value="<?php echo esc_attr($duration); ?>" min="1" required class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="acme_batch_seats">Total Seats</label></th>
            <td>
                <input type="number" name="acme_batch_seats" id="acme_batch_seats" value="<?php echo esc_attr($seats); ?>" min="1" required class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="acme_batch_mode">Mode</label></th>
            <td>
                <select name="acme_batch_mode" id="acme_batch_mode" required class="regular-text">
                    <option value="">Select Mode</option>
                    <option value="Online" <?php selected($mode, 'Online'); ?>>Online</option>
                    <option value="Offline" <?php selected($mode, 'Offline'); ?>>Offline</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Meta Box Data
 */
function acme_save_batch_meta($post_id) {
    // Security Checks
    if (!isset($_POST['acme_batch_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['acme_batch_nonce'], 'acme_batch_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (get_post_type($post_id) !== 'batch') {
        return;
    }

    // Isset Check
    if (
        !isset($_POST['acme_batch_start_date']) ||
        !isset($_POST['acme_batch_duration']) ||
        !isset($_POST['acme_batch_seats']) ||
        !isset($_POST['acme_batch_mode']) ||
        !isset($_POST['acme_batch_course'])
    ) {
        return;
    }

    // Date Validation
    $date = $_POST['acme_batch_start_date'];

    if (empty($date) || strtotime($date) === false) {
        return;
    }

    // Course ID Validation
    $course_id = intval($_POST['acme_batch_course']);

    $course_post = get_post($course_id);

    if (!$course_post || $course_post->post_type !== 'course') {
        return;
    }

    // Strict Numeric Validation
    if (!is_numeric($_POST['acme_batch_duration']) || intval($_POST['acme_batch_duration']) < 1) {
        return;
    }

    if (!is_numeric($_POST['acme_batch_seats']) || intval($_POST['acme_batch_seats']) < 1) {
        return;
    }

    // Safe Variable Assignment
    $duration = intval($_POST['acme_batch_duration']);
    $seats = intval($_POST['acme_batch_seats']);

    // Save (No Change in Keys)
    update_post_meta($post_id, '_batch_start_date', sanitize_text_field($date));
    update_post_meta($post_id, '_batch_duration', $duration);
    update_post_meta($post_id, '_batch_seats', $seats);
    update_post_meta($post_id, '_batch_mode', sanitize_text_field($_POST['acme_batch_mode']));
    update_post_meta($post_id, '_batch_course_id', $course_id);
}
add_action('save_post', 'acme_save_batch_meta');
