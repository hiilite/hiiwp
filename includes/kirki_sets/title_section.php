<?php
Kirki::add_section( 'title_section', array(
    'priority'    => 5,
    'title'       => __( 'Page Titles', 'textdomain' ),
    'description' => __( 'Title settings', 'textdomain' ),
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
    'default'     => '200px',
    'priority'    => 5,
    'output' => '.page-title',
    'required' => array(
    array(
    	'setting' => 'show_page_titles',
    	'operator' => '==',
    	'value'		=> true,
    	
    )),
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'title_font',
    'label'       => esc_attr__( 'Title Style', 'kirki' ),
    'description' => __( 'Define styles for page title' ),
    'section'     => 'title_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 6,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'title_background',
    'label'       => __( 'Title Background', 'my_textdomain' ),
    'section'     => 'title_section',
    'priority'    => 7,
    'default'     => array(
		'color'    => '',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
		'opacity'  => 90,
	),
	'output' => '.page-title',
) );

	?>