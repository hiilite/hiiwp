<?php
Kirki::add_panel( 'typography_panel', array(
    'priority'    => 6,
    'title'       => __( 'Fonts', 'hiiwp' ),
    'description' => __( 'Typography settings', 'hiiwp' ),
    'icon' => 'dashicons-editor-textcolor'
) );
Kirki::add_section( 'typography_headings_section', array(
    'priority'    => 6,
    'title'       => __( 'Headings', 'hiiwp' ),
    'description' => __( 'Typography settings', 'hiiwp' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_text_section', array(
    'priority'    => 6,
    'title'       => __( 'Text', 'hiiwp' ),
    'description' => __( 'Customize fonts for Paragraphs, Links, and Custom Formats', 'hiiwp' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_social_icons_section', array(
    'priority'    => 6,
    'title'       => __( 'Social Icons', 'hiiwp' ),
    'description' => __( 'Customize the default social icons', 'hiiwp' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_header_menu_section', array(
    'priority'    => 6,
    'title'       => __( 'Header & Menu', 'hiiwp' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_page_title_section', array(
    'priority'    => 6,
    'title'       => __( 'Page Title', 'hiiwp' ),
    'description' => __( 'Page Title font settings', 'hiiwp' ),
    'panel'		 => 'typography_panel',
) );



Kirki::add_section( 'typography_footer_section', array(
    'priority'    => 6,
    'title'       => __( 'Footer', 'hiiwp' ),
    'description' => __( 'Footer title and text properties', 'hiiwp' ),
    'panel'		 => 'typography_panel',
) );



include_once 'typography/headings.php';
include_once 'typography/text.php';
include_once 'typography/social_icons.php';
include_once 'typography/header_menu.php';
include_once 'typography/page_title.php';
include_once 'typography/footer.php';

?>