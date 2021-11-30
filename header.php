<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="wrapper" class="hfeed">
        <header id="header" class="container site-header">
            <div id="branding" class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?>" rel="home">
                    <img src="<?= get_template_directory_uri() ?>/img/logo.png" alt="<?= esc_html(get_bloginfo('name')) ?>" title="<?= esc_html(get_bloginfo('name')) ?>" class="brand-img">
                </a>
            </div>

            <div class="burger">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <nav id="menu">

                <div class="burger_close">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                </div>

                <?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
            </nav>
        </header>
        <div id="outer_container" class="container">