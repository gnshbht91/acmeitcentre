<?php

function acme_enqueue_styles() {
    wp_enqueue_style(
        'acme-main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'acme_enqueue_styles');

function acme_register_menus() {
    register_nav_menus(array(
        'primary_menu' => 'Primary Menu'
    ));
}
add_action('init', 'acme_register_menus');

