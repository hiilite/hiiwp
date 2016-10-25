<?php
Kirki::add_section( 'title_section', array(
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
    'section'     => 'title_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'title_height',
    'label'       => __( 'Title Height', 'my_textdomain' ),
    'section'     => 'title_section',
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
			'property' => 'height',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '.page-title',
			'property' => 'height',
		),
	),
) );




Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'title_background',
    'label'       => __( 'Title Background', 'my_textdomain' ),
    'section'     => 'title_section',
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