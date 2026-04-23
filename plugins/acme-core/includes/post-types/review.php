<?php

if (!defined('ABSPATH')) {
    exit;
}

function acme_register_review_cpt()
{

    $labels = array(
        'name' => 'Reviews',
        'singular_name' => 'Review',
        'menu_name' => 'Reviews',
        'add_new' => 'Add Review',
        'add_new_item' => 'Add New Review',
        'edit_item' => 'Edit Review',
        'new_item' => 'New Review',
        'view_item' => 'View Review',
        'search_items' => 'Search Reviews',
        'not_found' => 'No Reviews found',
        'all_items' => 'Reviews'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'show_in_menu' => false
    );

    register_post_type('review', $args);
}

add_action('init', 'acme_register_review_cpt');

/**
 * Step 1: Add Meta Box
 */
function acme_add_review_meta_box()
{
    add_meta_box(
        'acme_review_fields',
        esc_html__('Testimonial Details', 'acme-core'),
        'acme_render_review_meta_box',
        'review',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'acme_add_review_meta_box');

/**
 * Step 2 & 3: Render Meta Box UI & Nonce
 */
function acme_render_review_meta_box($post)
{
    // Step 3: Nonce field
    wp_nonce_field('acme_review_nonce', 'acme_review_nonce');

    // Retrieve existing values
    $client_name = get_post_meta($post->ID, '_review_client_name', true);
    $rating = get_post_meta($post->ID, '_review_rating', true);
    $review_text = get_post_meta($post->ID, '_review_text', true);

    ?>
    <div class="acme-meta-box">
        <p>
            <label
                for="acme_review_client_name"><strong><?php esc_html_e('Client Name', 'acme-core'); ?></strong></label><br>
            <input type="text" id="acme_review_client_name" name="acme_review_client_name"
                value="<?php echo esc_attr($client_name); ?>" class="widefat" required>
        </p>
        <p>
            <label for="acme_review_rating"><strong><?php esc_html_e('Rating (1-5)', 'acme-core'); ?></strong></label><br>
            <input type="number" id="acme_review_rating" name="acme_review_rating" value="<?php echo esc_attr($rating); ?>"
                min="1" max="5" class="widefat" required>
        </p>
        <p>
            <label for="acme_review_text"><strong><?php esc_html_e('Review Text', 'acme-core'); ?></strong></label><br>
            <textarea id="acme_review_text" name="acme_review_text" rows="5" class="widefat"
                required><?php echo esc_textarea($review_text); ?></textarea>
        </p>
    </div>
    <?php
}

/**
 * Step 4-9: Save Meta Data
 */
function acme_save_review_meta($post_id)
{
    if (get_post_type($post_id) !== 'review') {
        return;
    }

    if (!isset($_POST['acme_review_nonce']) || !wp_verify_nonce($_POST['acme_review_nonce'], 'acme_review_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (
        !isset($_POST['acme_review_client_name']) ||
        !isset($_POST['acme_review_rating']) ||
        !isset($_POST['acme_review_text'])
    ) {
        return;
    }

    $client_name = $_POST['acme_review_client_name'];
    $rating = intval($_POST['acme_review_rating']);
    $review_text = $_POST['acme_review_text'];

    if (empty($client_name) || empty($review_text)) {
        return;
    }

    if ($rating < 1 || $rating > 5) {
        return;
    }

    update_post_meta($post_id, '_review_client_name', sanitize_text_field($client_name));
    update_post_meta($post_id, '_review_rating', $rating);
    update_post_meta($post_id, '_review_text', sanitize_textarea_field($review_text));
}
add_action('save_post', 'acme_save_review_meta');
