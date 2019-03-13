<?php 
$section = 'portfolio_piece_section';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_single_in_grid',
    'label'       => __( 'Portfolio Piece in Grid', 'hiiwp' ),
    'description' => __('Enabling this option will display a portfolio pieces content in grid', 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_single_in_grid'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'radio-image',
    'settings'    => 'portfolio_template',
    'label'       => __( 'Portfolio Template', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_template'],
    'description' => 'Select the layout type for your blog',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'default' => get_template_directory_uri() . '/images/icons/portfolio-default.png',
        'split' => get_template_directory_uri() . '/images/icons/portfolio-split.png',
    ),
) );



Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'portfolio_background',
	'label'       => __( 'Portfolio Background', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_background'],
	'priority'    => 1,
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_template',
			'operator' => '==',
			'value'    => 'split',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'portfolio_panel_background',
	'label'       => __( 'Info Panel Background', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_panel_background'],
	'priority'    => 1,
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_template',
			'operator' => '==',
			'value'    => 'split',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'portfolio_info_colors',
    'label'       => __( 'Info Panel Text Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 1,
    'choices'     => array(
        'title'    => esc_attr__( 'Title', 'hiiwp' ),
        'text'   => esc_attr__( 'Text', 'hiiwp' ),
        'link'  => esc_attr__( 'Link', 'hiiwp' ),
        'hover'  => esc_attr__( 'Link Hover', 'hiiwp' ),
    ),
    'default' => array(
        'title' => $hiilite_options['portfolio_info_colors']['title'],
        'text'	=> $hiilite_options['portfolio_info_colors']['text'],
        'link'  => $hiilite_options['portfolio_info_colors']['link'],
        'hover' => $hiilite_options['portfolio_info_colors']['hover'],
    ),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_template',
			'operator' => '==',
			'value'    => 'split',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'show_more_projects',
    'label'       => __( 'Show More Projects', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['show_more_projects'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_comments',
    'label'       => __( 'Show Comments', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );