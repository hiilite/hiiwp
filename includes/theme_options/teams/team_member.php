<?php
//////////////////////
//
//	Team Member Section
//
//////////////////////
$section = 'team_member_section';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'spacing',
    'settings'    => 'team_member_content_padding',
    'label'       => esc_attr__( 'Content Spacing', 'hiiwp' ),
    'description' => __( 'Add padding to the top and bottom of the content area' , 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['team_member_content_padding'], 
    'priority'    => 1,
    'output'	  => array(
		array(
			'element'	=> '.single-team-member',
			'property'	=> 'padding',
		)  
    ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'team_member_show_image',
	'label'       => esc_attr__( 'Show Image', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['team_member_show_image'],
	'priority'	  => 1,
	'description'    => __( 'Show team members image', 'hiiwp' ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'select',
	'settings'    => 'team_member_image_style',
	'label'       => esc_attr__( 'Image Style', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['team_member_image_style'],
	'choices'     => array(
		'default'   => esc_attr__( 'Default', 'textdomain' ),
		'square' 	=> esc_attr__( 'Square', 'textdomain' ),
		'circle'  	=> esc_attr__( 'Circle', 'textdomain' ),
	),
	'priority'	  => 1,
	'description'    => __( 'Choose how you would like your team photos to display', 'hiiwp' ),
	'active_callback'	=> array(
		array(
			'setting'  => 'team_member_show_image',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'team_member_content_layout',
	'label'       => esc_attr__( 'Content Layout', 'hiiwp' ),
	'description' => __( 'Image to text layout ratio', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['team_member_content_layout'],
	'priority'    => 1,
	'choices'     => array(
		'col-12'   	=> '1/1 + 1/1',
		'col-3'   	=> '1/4 + 3/4',
		'col-4'		=> '1/3 + 2/3',
		'col-6'		=> '1/2 + 1/2',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'team_member_show_image',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'team_member_title_show',
	'label'       => esc_attr__( 'Show Name in Content', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['team_member_title_show'],
	'priority'	  => 1,
	'description'    => __( 'Show team members name in the content area', 'hiiwp' ),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'team_member_heading_tag',
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
			'setting'  => 'team_member_title_show',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'team_member_heading_font',
    'label'       => esc_attr__( 'Title Font', 'hiiwp' ),
    'description' => __( 'Define font for the team members name', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['team_member_heading_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'team_member_title_show',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.single-team-member .team-member-name, .single-team-member .team-member-name a, .single-team-member .team-member-wrapper .team-member-name a, .single-team-member .team-member-wrapper .team-member-name',
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'team_member_show_position',
	'label'       => esc_attr__( 'Show Positions', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['team_member_show_position'],
	'priority'	  => 1,
	'description'    => __( 'Show the team members position', 'hiiwp' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'team_member_position_font',
    'label'       => esc_attr__( 'Position Font', 'hiiwp' ),
    'description' => __( 'Define font for the team members position', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['team_member_position_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'team_member_show_position',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.single-team-member .team-member-position',
		),
	),
) );