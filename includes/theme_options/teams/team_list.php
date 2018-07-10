<?php
//////////////////////
//
//	Team Section
//
//////////////////////
$section = 'team_section';
////////////////////////////

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'teams_cols',
	'label'       => esc_attr__( 'Columns', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_cols'],
	'priority'    => 1,
	'choices'     => array(
		'col-6'   => '2 Columns',
		'col-4'   => '3 Columns',
		'col-3'		=> '4 Columns',
		'col-2'		=> '6 Columns',
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'teams_show_image',
	'label'       => esc_attr__( 'Show Image', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_show_image'],
	'priority'	  => 1,
	'description'    => __( 'Show team members image', 'hiiwp' ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'select',
	'settings'    => 'teams_image_style', 
	'label'       => esc_attr__( 'Image Style', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_image_style'],
	'choices'     => array(
		'default'   => esc_attr__( 'Default', 'hiiwp' ),
		'square' 	=> esc_attr__( 'Square', 'hiiwp' ),
		'circle'  	=> esc_attr__( 'Circle', 'hiiwp' ),
	),
	'priority'	  => 1,
	'description'    => __( 'Choose how you would like your team photos to display', 'hiiwp' ),
	'active_callback'	=> array(
		array(
			'setting'  => 'teams_show_image',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
	'settings'    => 'teams_image_position',
	'label'       => esc_attr__( 'Image Position', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_image_position'],
	'choices'     => array(
        'image-left' => get_template_directory_uri() . '/images/icons/image-left.png',
        'image-above' => get_template_directory_uri() . '/images/icons/image-above.png',
    ),
	'priority'	  => 1,
	'description'    => __( 'Select position of the image', 'hiiwp' ),
	'active_callback'	=> array(
		array(
			'setting'  => 'teams_show_image',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'teams_title_show',
    'label'       => __( 'Show Title', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['teams_title_show'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'teams_heading_tag',
	'label'       => esc_attr__( 'Title Size', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_heading_tag'],
	'priority'    => 1,
	'choices'     => array(
		'h2'    => 'h2',
		'h3'	=> 'h3',
		'h4'	=> 'h4',
		'h5'	=> 'h5',
		'h6'	=> 'h6',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'teams_title_show',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'teams_heading_font',
    'label'       => esc_attr__( 'Title Font', 'hiiwp' ),
    'description' => __( 'Define font for the team members name', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['teams_heading_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'teams_title_show',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.team-member-name, .team-member-name a',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'teams_show_position',
	'label'       => esc_attr__( 'Show Positions', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_show_position'],
	'priority'	  => 1,
	'description'    => __( 'Show the team members position', 'hiiwp' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'teams_position_font',
    'label'       => esc_attr__( 'Position Font', 'hiiwp' ),
    'description' => __( 'Define font for the team members position', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['teams_position_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'teams_show_position',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.team-member-position',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'teams_show_excerpt',
	'label'       => esc_attr__( 'Show Excerpt', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_show_excerpt'],
	'priority'	  => 1,
	'description'    => __( 'Show a short excerpt from the team members bio', 'hiiwp' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'teams_excerpt_font',
    'label'       => esc_attr__( 'Excerpt Font', 'hiiwp' ),
    'description' => __( 'Define font for the team members excerpt', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['teams_excerpt_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'teams_show_excerpt',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.team-member-excerpt',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'teams_show_button',
	'label'       => esc_attr__( 'Show Button', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_show_button'],
	'priority'	  => 1,
	'description'    => __( 'Show a button bellow each team member', 'hiiwp' ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'text',
	'settings'    => 'teams_button_text',
	'label'       => esc_attr__( 'Button Text', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_button_text'],
	'priority'	  => 1,
	'description'    => __( 'What text would you like displayed on your button', 'hiiwp' ),
	'active_callback'	=> array(
		array(
			'setting'  => 'teams_show_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'teams_button_style',
	'label'       => esc_attr__( 'Button Style', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_button_style'],
	'choices'     => array(
		'default'   		=> esc_attr__( 'Default', 'hiiwp' ),
		'button-primary' 	=> esc_attr__( 'Primary', 'hiiwp' ),
		'button-secondary'  => esc_attr__( 'Secondary', 'hiiwp' ),
	),
	'priority'	  => 1,
	'description'    => __( 'Choose from your theme button styles', 'hiiwp' ),
	'active_callback'	=> array(
		array(
			'setting'  => 'teams_show_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'teams_border_width',
	'label'       => esc_attr__( 'Border Width', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_border_width'],
	'priority'	  => 1,
	'description'    => __( 'Add a border around the team members', 'hiiwp' ),
	'output'      => array(
		array(
			'element' => '.team-member-wrapper',
			'property'	=> 'border-width',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'teams_border_color',
	'label'       => esc_attr__( 'Border Color', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_border_color'],
	'priority'	  => 1,
	'description'    => __( 'Set the border color around the team members', 'hiiwp' ),
	'output'      => array(
		array(
			'element' => '.team-member-wrapper',
			'property'	=> 'border-color',
		),
	),
) );