<?php

if (!defined('ABSPATH')) {
    exit;
}

function acme_register_instructor_cpt() {

    $labels = array(
        'name' => 'Instructors',
        'singular_name' => 'Instructor',
        'add_new' => 'Add Instructor',
        'add_new_item' => 'Add New Instructor',
        'edit_item' => 'Edit Instructor',
        'new_item' => 'New Instructor',
        'view_item' => 'View Instructor',
        'search_items' => 'Search Instructors',
        'not_found' => 'No Instructors found',
        'all_items' => 'Instructors',
        'menu_name' => 'Instructors'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'show_in_menu' => false
    );

    register_post_type('instructor', $args);
}

add_action('init', 'acme_register_instructor_cpt');

/**
 * Add Meta Box for Instructor Details
 */
function acme_add_instructor_meta_box() {
    add_meta_box(
        'acme_instructor_fields',
        'Instructor Details',
        'acme_render_instructor_meta_box',
        'instructor',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'acme_add_instructor_meta_box');

/**
 * Render Meta Box Content
 */
function acme_render_instructor_meta_box($post) {
    // Add Nonce
    wp_nonce_field('acme_instructor_meta_nonce', 'acme_instructor_nonce');

    // Get existing values
    $experience = get_post_meta($post->ID, '_instructor_experience', true);
    $specialization = get_post_meta($post->ID, '_instructor_specialization', true);
    $bio = get_post_meta($post->ID, '_instructor_bio', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="acme_instructor_experience">Experience (Years)</label></th>
            <td>
                <input type="number" id="acme_instructor_experience" name="acme_instructor_experience" value="<?php echo esc_attr($experience); ?>" min="0" required class="small-text">
            </td>
        </tr>
        <tr>
            <th><label for="acme_instructor_specialization">Specialization</label></th>
            <td>
                <input type="text" id="acme_instructor_specialization" name="acme_instructor_specialization" value="<?php echo esc_attr($specialization); ?>" required class="regular-text" placeholder="e.g. Full Stack Web Development">
            </td>
        </tr>
        <tr>
            <th><label for="acme_instructor_bio">Bio</label></th>
            <td>
                <textarea id="acme_instructor_bio" name="acme_instructor_bio" rows="5" required class="large-text" style="width: 100%;"><?php echo esc_textarea($bio); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="acme_instructor_courses">Assign Courses</label></th>
            <td>
                <?php
                $courses = get_posts([
                    'post_type' => 'course',
                    'numberposts' => -1,
                    'post_status' => 'publish'
                ]);

                $selected_courses = get_post_meta($post->ID, '_instructor_courses', true);
                if (!is_array($selected_courses)) {
                    $selected_courses = [];
                }
                ?>
                <select name="acme_instructor_courses[]" id="acme_instructor_courses" multiple size="5" style="width: 100%; min-height: 120px;">
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo esc_attr($course->ID); ?>"
                            <?php echo in_array($course->ID, $selected_courses) ? 'selected' : ''; ?>>
                            <?php echo esc_html($course->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="description">Hold Ctrl (Cmd on Mac) to select multiple courses.</p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Instructor Meta Data
 */
function acme_save_instructor_meta($post_id) {
    // Post type check
    if (get_post_type($post_id) !== 'instructor') {
        return;
    }

    // Security Checks
    if (!isset($_POST['acme_instructor_nonce']) || !wp_verify_nonce($_POST['acme_instructor_nonce'], 'acme_instructor_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Combined isset check (Micro Fix)
    if (
        !isset($_POST['acme_instructor_experience']) ||
        !isset($_POST['acme_instructor_specialization']) ||
        !isset($_POST['acme_instructor_bio'])
    ) {
        return;
    }

    // Backend validation strict (Critical Fix)
    if (!is_numeric($_POST['acme_instructor_experience']) || intval($_POST['acme_instructor_experience']) < 0) {
        return;
    }

    if (empty($_POST['acme_instructor_specialization']) || empty($_POST['acme_instructor_bio'])) {
        return;
    }

    // Sanitization & Saving
    $experience = intval($_POST['acme_instructor_experience']);
    $specialization = sanitize_text_field($_POST['acme_instructor_specialization']);
    $bio = sanitize_textarea_field($_POST['acme_instructor_bio']);

    update_post_meta($post_id, '_instructor_experience', $experience);
    update_post_meta($post_id, '_instructor_specialization', $specialization);
    update_post_meta($post_id, '_instructor_bio', $bio);

    // Save Courses Relationship
    $course_ids = isset($_POST['acme_instructor_courses'])
        ? $_POST['acme_instructor_courses']
        : [];

    if (!is_array($course_ids)) {
        $course_ids = [];
    }

    $clean_ids = [];
    foreach ($course_ids as $id) {
        $id = intval($id);
        $course_post = get_post($id);
        if ($course_post && $course_post->post_type === 'course') {
            $clean_ids[] = $id;
        }
    }

    if (empty($clean_ids)) {
        delete_post_meta($post_id, '_instructor_courses');
    } else {
        update_post_meta($post_id, '_instructor_courses', $clean_ids);
    }
}
add_action('save_post', 'acme_save_instructor_meta');
