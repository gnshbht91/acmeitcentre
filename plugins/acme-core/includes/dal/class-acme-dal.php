<?php
if (!defined('ABSPATH')) {
    exit;
}

class ACME_DAL {

    public function __construct() {
        // Initialization placeholder
    }

    /**
     * Get all courses from the database
     * 
     * @return array
     */
    public function get_courses() {
        $args = array(
            'post_type' => 'course',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'ID',
            'order' => 'DESC'
        );

        $courses = get_posts($args);

        if (!$courses) {
            return array();
        }

        $results = array();
        foreach ($courses as $course) {
            $results[] = (array) $course;
        }

        return $results;
    }

    /**
     * Get a single course from the database
     * 
     * @param int $id Course ID
     * @return array|null
     */
    public function get_course($id) {
        $id = intval($id);

        if ($id <= 0) {
            return null;
        }

        $post = get_post($id);

        if (!$post || $post->post_type !== 'course') {
            return null;
        }

        return (array) $post;
    }

    /**
     * Get recent leads from the database
     * 
     * @param int $limit Maximum number of results to return
     * @return array
     */
    public function get_leads($limit = 20) {

        global $wpdb;

        $limit = intval($limit);

        if ($limit <= 0) {
            $limit = 20;
        }

        $table = $wpdb->prefix . 'acme_leads';

        // Check table exists
        $table_exists = $wpdb->get_var("SHOW TABLES LIKE '{$table}'");

        if ($table_exists !== $table) {
            return array();
        }

        $query = $wpdb->prepare(
            "SELECT * FROM {$table} ORDER BY id DESC LIMIT %d",
            $limit
        );

        $results = $wpdb->get_results($query, ARRAY_A);

        if (!$results) {
            return array();
        }

        return $results;
    }

    public function acme_get_batches_by_course($course_id) {
        $course_id = intval($course_id);

        if (!$course_id) {
            return [];
        }

        $cache_key = 'acme_batches_' . $course_id;
        $cached = get_transient($cache_key);

        if ($cached !== false) {
            return $cached;
        }

        $args = array(
            'post_type' => 'batch',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => '_batch_course_id',
                    'value' => $course_id,
                    'compare' => '='
                )
            )
        );

        $batches = get_posts($args);
        $results = [];

        if ($batches) {
            foreach ($batches as $batch) {
                $results[] = (array) $batch;
            }
        }

        set_transient($cache_key, $results, 12 * HOUR_IN_SECONDS);

        return $results;
    }

    public function acme_get_instructor_by_batch($batch_id) {
        $batch_id = intval($batch_id);

        if (!$batch_id) {
            return [];
        }

        $cache_key = 'acme_instructor_' . $batch_id;
        $cached = get_transient($cache_key);

        if ($cached !== false) {
            return $cached;
        }

        $course_id = intval(get_post_meta($batch_id, '_batch_course_id', true));

        if (!$course_id) {
            return [];
        }

        $args = array(
            'post_type' => 'instructor',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );

        $instructors = get_posts($args);
        $result = [];

        if ($instructors && !is_wp_error($instructors)) {
            foreach ($instructors as $instructor) {
                $courses = get_post_meta($instructor->ID, '_instructor_courses', true);
                if (is_array($courses) && in_array($course_id, $courses)) {
                    $result = (array) $instructor;
                    break;
                }
            }
        }

        set_transient($cache_key, $result, 12 * HOUR_IN_SECONDS);

        return $result;
    }

    public function acme_clear_batch_cache($course_id, $batch_id) {

        $course_id = intval($course_id);
        $batch_id = intval($batch_id);

        if ($course_id) {
            delete_transient('acme_batches_' . $course_id);
        }

        if ($batch_id) {
            delete_transient('acme_instructor_' . $batch_id);
        }
    }

}




