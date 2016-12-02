<?php
$section = 'sidebar_section';
Kirki::add_section( $section, array(
    'priority'    => 6,
    'title'       => __( 'Sidebar', 'textdomain' ),
    'description' => __( 'Widget Styles', 'textdomain' ),
    'icon' => 'dashicons-editor-indent'
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'sidebar_widget_title_font',
    'label'       => esc_attr__( 'Title Style', 'kirki' ),
    'description' => __( 'Define styles for widgets title' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'sidebar_widget_text_font',
    'label'       => esc_attr__( 'Text Style', 'kirki' ),
    'description' => __( 'Define styles for widget text' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'sidebar_widget_link_font',
    'label'       => esc_attr__( 'Link Style', 'kirki' ),
    'description' => __( 'Define styles for widget links' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );
?>