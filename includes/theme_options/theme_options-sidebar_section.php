<?php
$section = 'sidebar_section';
Kirki::add_section( $section, array(
    'priority'    => 6,
    'title'       => __( 'Sidebar', 'hiiwp' ),
    'description' => __( 'Widget Styles', 'hiiwp' ),
    'icon' => 'dashicons-editor-indent'
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'sidebar_background',
    'label'       => __( 'Sidebar Background Color', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 1,
    'default'     => $hiilite_options['sidebar_background'],
));

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'sidebar_widget_title_font',
    'label'       => esc_attr__( 'Title Style', 'hiiwp' ),
    'description' => __( 'Define styles for widgets title', 'hiiwp' ),
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
    'label'       => esc_attr__( 'Text Style', 'hiiwp' ),
    'description' => __( 'Define styles for widget text', 'hiiwp' ),
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
    'label'       => esc_attr__( 'Link Style', 'hiiwp' ),
    'description' => __( 'Define styles for widget links', 'hiiwp' ),
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
    'type'        => 'spacing',
    'settings'    => 'sidebar_padding',
    'label'       => esc_attr__( 'Sidebar Padding', 'hiiwp' ),
    'description' => __( 'Define padding around the sidebar', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['sidebar_padding'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'spacing',
    'settings'    => 'sidebar_widget_margin',
    'label'       => esc_attr__( 'Widget Margin', 'hiiwp' ),
    'description' => __( 'Define margin around the individual widgets within the sidebar', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['sidebar_widget_margin'],
    'priority'    => 1,
) );
?>