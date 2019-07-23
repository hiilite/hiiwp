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
    'type'        => 'spacing',
    'settings'    => 'typography_h1_margin',
    'label'       => esc_attr__( 'H1 Margin', 'hiiwp' ),
    'description' => __( 'Set the top and bottom margin for the h1 elements' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h1_margin'], 
    'priority'    => 1,
    'output'	  => array(
		array(
			'element'	=> 'h1',
			'property'	=> 'margin',
		)  
    ),
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
    'type'        => 'spacing',
    'settings'    => 'typography_h2_margin',
    'label'       => esc_attr__( 'H2 Margin', 'hiiwp' ),
    'description' => __( 'Set the top and bottom margin for the h2 elements' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h2_margin'], 
    'priority'    => 1,
    'output'	  => array(
		array(
			'element'	=> 'h2',
			'property'	=> 'margin',
		)  
    ),
    'js_vars' => array(
		array(
			'element'  => 'h2',
			'property' => 'margin',
		),
	),
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
    'type'        => 'spacing',
    'settings'    => 'typography_h3_margin',
    'label'       => esc_attr__( 'H3 Margin', 'hiiwp' ),
    'description' => __( 'Set the top and bottom margin for the h3 elements' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h3_margin'], 
    'priority'    => 1,
    'output'	  => array(
		array(
			'element'	=> 'h3',
			'property'	=> 'margin',
		)  
    ),
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
    'type'        => 'spacing',
    'settings'    => 'typography_h4_margin',
    'label'       => esc_attr__( 'H4 Margin', 'hiiwp' ),
    'description' => __( 'Set the top and bottom margin for the h4 elements' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h4_margin'], 
    'priority'    => 1,
    'output'	  => array(
		array(
			'element'	=> 'h4',
			'property'	=> 'margin',
		)  
    ),
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
    'type'        => 'spacing',
    'settings'    => 'typography_h5_margin',
    'label'       => esc_attr__( 'H5 Margin', 'hiiwp' ),
    'description' => __( 'Set the top and bottom margin for the h5 elements' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h5_margin'], 
    'priority'    => 1,
    'output'	  => array(
		array(
			'element'	=> 'h5',
			'property'	=> 'margin',
		)  
    ),
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
Kirki::add_field( 'hiiwp', array(
    'type'        => 'spacing',
    'settings'    => 'typography_h6_margin',
    'label'       => esc_attr__( 'H6 Margin', 'hiiwp' ),
    'description' => __( 'Set the top and bottom margin for the h6 elements' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['typography_h6_margin'], 
    'priority'    => 1,
    'output'	  => array(
		array(
			'element'	=> 'h6',
			'property'	=> 'margin',
		)  
    ),
) );
?>