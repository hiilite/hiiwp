<?php
Kirki::add_panel( 'typography_panel', array(
    'priority'    => 6,
    'title'       => __( 'Fonts', 'textdomain' ),
    'description' => __( 'Typography settings', 'textdomain' ),
    'icon' => 'dashicons-editor-textcolor'
) );
Kirki::add_section( 'typography_headings_section', array(
    'priority'    => 6,
    'title'       => __( 'Headings', 'textdomain' ),
    'description' => __( 'Typography settings', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_text_section', array(
    'priority'    => 6,
    'title'       => __( 'Text', 'textdomain' ),
    'description' => __( 'Links, Icons, and Custom Formats', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_header_menu_section', array(
    'priority'    => 6,
    'title'       => __( 'Header & Menu', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_page_title_section', array(
    'priority'    => 6,
    'title'       => __( 'Page Title', 'textdomain' ),
    'description' => __( 'Page Title font settings', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );



Kirki::add_section( 'typography_footer_section', array(
    'priority'    => 6,
    'title'       => __( 'Footer', 'textdomain' ),
    'description' => __( 'Footer title and text properties', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );



include_once 'typography/headings.php';
include_once 'typography/text.php';
include_once 'typography/header_menu.php';
include_once 'typography/page_title.php';
include_once 'typography/footer.php';

?>