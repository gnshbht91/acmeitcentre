<?php

if (!defined('ABSPATH')) {
    exit;
}

function acme_register_faq_cpt()
{

    $labels = array(
        'name' => 'FAQ',
        'singular_name' => 'FAQ',
        'menu_name' => 'FAQ',
        'add_new' => 'Add FAQ',
        'add_new_item' => 'Add New FAQ',
        'edit_item' => 'Edit FAQ',
        'new_item' => 'New FAQ',
        'view_item' => 'View FAQ',
        'search_items' => 'Search FAQ',
        'not_found' => 'No FAQ found',
        'all_items' => 'FAQ'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'show_in_menu' => false
    );

    register_post_type('faq', $args);
}

add_action('init', 'acme_register_faq_cpt');
/**
 * Add Meta Box for FAQ Details
 */
function acme_add_faq_meta_box()
{
    add_meta_box(
        'acme_faq_details',
        'FAQ Details',
        'acme_render_faq_meta_box',
        'faq',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'acme_add_faq_meta_box');

/**
 * Render FAQ Meta Box
 */
function acme_render_faq_meta_box($post)
{
    wp_nonce_field('acme_faq_meta_nonce', 'acme_faq_nonce');

    $category = get_post_meta($post->ID, '_faq_category', true);
    $order = get_post_meta($post->ID, '_faq_order', true);

    if ($order === '')
        $order = 0; // Default order

    $categories = array('General', 'Courses', 'Admissions', 'Technical');
    ?>
    <p>
        <label for="acme_faq_category">Category</label><br>
        <select name="acme_faq_category" id="acme_faq_category" class="widefat" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo esc_attr($cat); ?>" <?php selected($category, $cat); ?>>
                    <?php echo esc_html($cat); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="acme_faq_order">Display Order (Lower first)</label><br>
        <input type="number" name="acme_faq_order" id="acme_faq_order" value="<?php echo esc_attr($order); ?>" min="0"
            required class="widefat">
    </p>
    <?php
}

/**
 * Save FAQ Meta Data
 */
function acme_save_faq_meta($post_id)
{
    // Post type check
    if (get_post_type($post_id) !== 'faq') {
        return;
    }

    // Security Checks
    if (!isset($_POST['acme_faq_nonce']) || !wp_verify_nonce($_POST['acme_faq_nonce'], 'acme_faq_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Combined Isset Check
    if (!isset($_POST['acme_faq_category']) || !isset($_POST['acme_faq_order'])) {
        return;
    }

    // Strict Backend Validation
    if (empty($_POST['acme_faq_category'])) {
        return;
    }

    if (!is_numeric($_POST['acme_faq_order']) || intval($_POST['acme_faq_order']) < 0) {
        return;
    }

    // Sanitization & Saving
    $category = sanitize_text_field($_POST['acme_faq_category']);
    $order = intval($_POST['acme_faq_order']);

    $valid_categories = array('General', 'Courses', 'Admissions', 'Technical');
    if (in_array($category, $valid_categories, true)) {
        update_post_meta($post_id, '_faq_category', $category);
    }

    update_post_meta($post_id, '_faq_order', $order);
}
add_action('save_post', 'acme_save_faq_meta');
