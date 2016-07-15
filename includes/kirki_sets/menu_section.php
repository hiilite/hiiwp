<?php
Kirki::add_section( 'menu_section', array(
    'priority'    => 4,
    'title'       => __( 'Navigation', 'textdomain' ),
    'description' => __( 'Global settings', 'textdomain' ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'main_menu_font',
    'label'       => esc_attr__( 'Menu Font', 'kirki' ),
    'description' => __( 'Font for main menu' ),
    'section'     => 'menu_section',
    'default'     =>  array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '14px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => 'None'
    ),
    'priority'    => 10,
    'output'      => array(
        array(
            'element' => '.menu',
        ),
    ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'main_menu_background_color',
	'label'       => __( 'Menu Background Color', 'my_textdomain' ),
	'section'     => 'menu_section',
	'default'     => '',
	'priority'    => 7,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'mobile_menu_switch',
    'label'       => __( 'Mobile Menu Switch', 'my_textdomain' ),
    'description'  => __( 'At what size should the menu switch to the mobile menu', 'my_textdomain' ),
    'section'     => 'menu_section',
    'default'     => '768px',
    'priority'    => 11,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'main_menu_links_css',
	'label'       => __( 'Menu Link Custom CSS', 'my_textdomain' ),
	'section'     => 'menu_section',
	'default'     => '',
	'priority'    => 12,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => 250,
	),
) );
	?>