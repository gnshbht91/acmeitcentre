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

if (!defined('ACME_PATH')) {
    define('ACME_PATH', plugin_dir_path(__FILE__));
}

if (!defined('ACME_URL')) {
    define('ACME_URL', plugin_dir_url(__FILE__));
}

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

