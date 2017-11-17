<?php
$section = 'typography_headings_section';
$default_font = get_theme_mod( 'default_font' );
$default_h1 = get_theme_mod( 'heading_font' );
$default_h1['font-size'] = '2em';
$default_h1['text-transform'] = 'none';
$default_h1['line-height'] = '1.5';
$default_h1['font-size'] = '2em';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h1_font',
    'label'       => esc_attr__( 'H1 Style', 'hiiwp' ),
    'description' => __( 'Define styles for H1 heading' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h1_font'], 
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h2_font',
    'label'       => esc_attr__( 'H2 Style', 'hiiwp' ),
    'description' => __( 'Define styles for H2 heading', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h2_font'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h3_font',
    'label'       => esc_attr__( 'H3 Style', 'hiiwp' ),
    'description' => __( 'Define styles for H3 heading', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h3_font'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h4_font',
    'label'       => esc_attr__( 'H4 Style', 'hiiwp' ),
    'description' => __( 'Define styles for H4 heading', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h4_font'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h5_font',
    'label'       => esc_attr__( 'H5 Style', 'hiiwp' ),
    'description' => __( 'Define styles for H5 heading', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h5_font'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h6_font',
    'label'       => esc_attr__( 'H6 Style', 'hiiwp' ),
    'description' => __( 'Define styles for H6 heading', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h6_font'],
    'priority'    => 1,
) );	
?>