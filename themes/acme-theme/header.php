<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body>

<header>
    <div class="container header-inner">
        
        <div class="logo">
            <h1><?php bloginfo('name'); ?></h1>
        </div>

        <nav class="nav-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'container' => false,
                'menu_class' => 'menu'
            ));
            ?>
        </nav>

    </div>
</header>
