<?php

if (!defined('ABSPATH')) {
    exit;
}

function acme_register_course_cpt() {

    $labels = array(
        'name' => 'Courses',
        'singular_name' => 'Course',
        'add_new' => 'Add Course',
        'add_new_item' => 'Add New Course',
        'edit_item' => 'Edit Course',
        'new_item' => 'New Course',
        'view_item' => 'View Course',
        'search_items' => 'Search Courses',
        'not_found' => 'No Courses found',
        'all_items' => 'Courses',
        'menu_name' => 'Courses'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'show_in_menu' => false
    );

    register_post_type('course', $args);
}

add_action('init', 'acme_register_course_cpt');

/**
 * Add Meta Box for Course Details
 */
function acme_add_course_meta_box() {
    add_meta_box(
        'acme_course_fields',
        'Course Details',
        'acme_render_course_meta_box',
        'course',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'acme_add_course_meta_box');

/**
 * Render Meta Box Content
 */
function acme_render_course_meta_box($post) {
    // Add Nonce
    wp_nonce_field('acme_course_meta_nonce', 'acme_course_nonce');

    // Get existing values
    $price = get_post_meta($post->ID, '_course_price', true);
    $duration = get_post_meta($post->ID, '_course_duration', true);
    $duration_unit = get_post_meta($post->ID, '_course_duration_unit', true);
    $level = get_post_meta($post->ID, '_course_level', true);
    $mode = get_post_meta($post->ID, '_course_mode', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="course_price">Price (₹)</label></th>
            <td>
                <span>₹ </span>
                <input type="number" id="course_price" name="course_price" value="<?php echo esc_attr($price); ?>" min="0" required placeholder="Enter price" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="course_duration">Duration</label></th>
            <td>
                <input type="number" id="course_duration" name="course_duration" value="<?php echo esc_attr($duration); ?>" min="1" required class="small-text">
                <select id="course_duration_unit" name="course_duration_unit" required>
                    <option value="">Select Unit</option>
                    <option value="Hours" <?php selected($duration_unit, 'Hours'); ?>>Hours</option>
                    <option value="Days" <?php selected($duration_unit, 'Days'); ?>>Days</option>
                    <option value="Months" <?php selected($duration_unit, 'Months'); ?>>Months</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="course_level">Level</label></th>
            <td>
                <select id="course_level" name="course_level" required>
                    <option value="">Select Level</option>
                    <option value="Beginner" <?php selected($level, 'Beginner'); ?>>Beginner</option>
                    <option value="Intermediate" <?php selected($level, 'Intermediate'); ?>>Intermediate</option>
                    <option value="Advanced" <?php selected($level, 'Advanced'); ?>>Advanced</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="course_mode">Mode</label></th>
            <td>
                <select id="course_mode" name="course_mode" required>
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
 * Save Course Meta Data
 */
function acme_save_course_meta($post_id) {
    // Post type check
    if (get_post_type($post_id) !== 'course') {
        return;
    }

    // Security Checks
    if (!isset($_POST['acme_course_nonce']) || !wp_verify_nonce($_POST['acme_course_nonce'], 'acme_course_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Price Validation
    if (isset($_POST['course_price'])) {
        $price = $_POST['course_price'];
        if (is_numeric($price) && $price >= 0) {
            update_post_meta($post_id, '_course_price', sanitize_text_field($price));
        }
    }

    // Duration Validation
    if (isset($_POST['course_duration'])) {
        $duration = $_POST['course_duration'];
        if (is_numeric($duration) && $duration >= 1) {
            update_post_meta($post_id, '_course_duration', sanitize_text_field($duration));
        }
    }

    // Duration Unit Validation
    if (isset($_POST['course_duration_unit'])) {
        $duration_unit = sanitize_text_field($_POST['course_duration_unit']);
        if (!empty($duration_unit)) {
            update_post_meta($post_id, '_course_duration_unit', $duration_unit);
        }
    }

    // Level Validation
    if (isset($_POST['course_level'])) {
        $level = sanitize_text_field($_POST['course_level']);
        if (!empty($level)) {
            update_post_meta($post_id, '_course_level', $level);
        }
    }

    // Mode Validation
    if (isset($_POST['course_mode'])) {
        $mode = sanitize_text_field($_POST['course_mode']);
        if (!empty($mode)) {
            update_post_meta($post_id, '_course_mode', $mode);
        }
    }
}
add_action('save_post', 'acme_save_course_meta');

