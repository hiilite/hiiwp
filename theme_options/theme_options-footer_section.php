<?php

$options = get_option('hii_seo_settings');

Kirki::add_panel( 'footer_panel', array(
    'priority'    => 4,
    'title'       => __( 'Footer', 'hiiwp' ),
    'description' => __( 'Footer settings', 'hiiwp' ),
    'icon' => 'dashicons-download'
) );

Kirki::add_section( 'footer_section', array(
    'priority'    => 6,
    'title'       => __( 'Footer General', 'hiiwp' ),
    'description' => __( 'General footer settings', 'hiiwp' ),
    'panel'		 => 'footer_panel',
) );

Kirki::add_section( 'footer_top_section', array(
    'priority'    => 6,
    'title'       => __( 'Footer Top', 'hiiwp' ),
    'description' => __( 'Footer top settings', 'hiiwp' ),
    'panel'		 => 'footer_panel',
) );

Kirki::add_section( 'footer_bottom_section', array(
    'priority'    => 6,
    'title'       => __( 'Footer Bottom', 'hiiwp' ),
    'description' => __( 'Footer Bottom settings', 'hiiwp' ),
    'panel'		 => 'footer_panel',
) );

Kirki::add_section( 'footer_page_section', array(
    'priority'    => 6,
    'title'       => __( 'Footer Page', 'hiiwp' ),
    'description' => __( 'Footer page settings', 'hiiwp' ),
    'panel'		 => 'footer_panel',
) );

include_once 'footer/footer.php';
include_once 'footer/footer_top.php';
include_once 'footer/footer_bottom.php';
include_once 'footer/footer_page.php';