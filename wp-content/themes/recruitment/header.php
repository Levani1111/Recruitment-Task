<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>Recruitment</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&family=Noto+Sans&family=Open+Sans:wght@400;600&family=Poppins:ital@1&family=Roboto:wght@300&family=Rubik&family=Source+Sans+Pro&family=Wix+Madefor+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/css/main.css">



    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <section class="header-wrapper">
        <header class="header">
            <?php if (has_nav_menu('primary')) : ?>
                <nav class="main-nav">
                    <?php if (get_header_image()) : ?>
                        <div id="site-header">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <img src="<?php header_image(); ?>" width="<?php echo absint(get_custom_header()->width); ?>" height="<?php echo absint(get_custom_header()->height); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                            </a>
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <div class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'nav-menu',
                        'depth' => 0,
                    )); ?>

                    <?php
                    $header_fields = get_theme_mod('header_fields');

                    if (!empty($header_fields)) {
                        echo '<ul class="buttons">';
                        foreach ($header_fields as $field) {
                            $header_text = isset($field['header_text']) ? $field['header_text'] : '';
                            $header_link = isset($field['header_link']) ? $field['header_link'] : '';

                            if (!empty($header_text) && !empty($header_link)) {
                                echo '<li><a href="' . esc_url($header_link) . '" target="_blank">' . esc_html($header_text) . '</a></li>';
                            }
                        }
                        echo '</ul>';
                    }
                    ?>
                    <input type="checkbox" id="menu-toggle">
                    <label class="menu-icon" for="menu-toggle">
                        <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/Vector.png" alt="Menu Icon">
                    </label>
                </nav>

            <?php endif; ?>
        </header>
    </section>