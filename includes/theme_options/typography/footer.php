<?php
$section = 'typography_footer_section';
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_headings_font',
    'label'       => esc_attr__( 'Footer Headings Font', 'hiiwp' ),
    'description' => __('Define styles for footer widget title', 'hiiwp'),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_text_font',
    'label'       => esc_attr__( 'Footer Text Font', 'hiiwp' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_links_font',
    'label'       => esc_attr__( 'Footer Links Font', 'hiiwp' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );	

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_bottom_text_font',
    'label'       => esc_attr__( 'Footer Bottom Text Font', 'hiiwp' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'			=> ' ',
    ),
    'priority'    => 1,
) );

?>