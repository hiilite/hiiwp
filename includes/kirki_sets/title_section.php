<?php
$section = 'title_section';
Kirki::add_section( $section, array(
    'priority'    => 5,
    'title'       => __( 'Title', 'textdomain' ),
    'description' => __( 'Page Title settings', 'textdomain' ),
    'icon' => 'dashicons-feedback'
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'show_page_titles',
    'label'       => __( 'Show page titles', 'my_textdomain' ),
    'description'  => __( 'can be overwritten per page', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'title_height',
    'label'       => __( 'Title Height', 'hiiwp' ),
    'section'     => $section,
    'default'     => '100px',
    'priority'    => 5,
    'active_callback'	=> array(
		array(
			'setting'  => 'show_page_titles',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element'  => '.page-title',
			'property' => 'min-height',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '.page-title',
			'property' => 'min-height',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'title_padding',
	'label'       => __( 'Title Padding', 'hiiwp' ),
	'section'     => $section,
	'default'     => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
	),
	'priority'    => 5,
	'active_callback'	=> array(
		array(
			'setting'  => 'show_page_titles',
			'operator' => '==',
			'value'    => true,
		),
	),
) );




Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'title_background',
    'label'       => __( 'Title Background', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 7,
    'default'     => array(
		'color'    => ' ',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'show_page_titles',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

	?>