<?php
$section = 'header_menu_section';
Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Menus', 'textdomain' ),
    'description' => __( 'Menus settings', 'textdomain' ),
    'panel'		 => 'header_panel',
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'dropdown_background_color',
	'label'       => __( 'Dropdown Menu Background', 'my_textdomain' ),
	'description' => __('Choose a color and transparency for the main menu background'),
	'section'     => $section,
	'default'     => '#808080',
	'priority'    => 7,
	'alpha'		  => true,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => 'ul.sub-menu',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => 'ul.sub-menu',
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'main_menu_background_color',
	'label'       => __( 'Mobile Menu Background Color', 'my_textdomain' ),
	'description' => __('Choose color for mobile menu background'),
	'section'     => $section,
	'default'     => '',
	'priority'    => 7,
	'output' => array(
		array(
			'element'  => 'nav#main-nav .main-menu',
			'property' => 'background-color',
			'media_query' => '@media (max-width:'.get_theme_mod('mobile_menu_switch','768px').')',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'mobile_menu_switch',
    'label'       => __( 'Mobile Menu Switch', 'my_textdomain' ),
    'description'  => __( 'At what size should the menu switch to the mobile menu', 'my_textdomain' ),
    'section'     => $section,
    'default'     => '768px',
    'priority'    => 11,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'mobile_menu_icon_color',
	'label'       => __( 'Mobile Menu Icon', 'my_textdomain' ),
	'description' => __('Change the color of the mobile menu icon'),
	'section'     => $section,
	'default'     => '',
	'priority'    => 11,
	'alpha'		  => true,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#main_header nav#main-nav:before',
			'property' => 'color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#main_header nav#main-nav:before',
			'property' => 'color',
		),
	),
) );
	
?>