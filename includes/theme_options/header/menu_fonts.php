<?php
$section = 'menu_menu_fonts_section';
Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Menu Fonts', 'hiiwp' ),
    'description' => __( 'Main menu font settings', 'hiiwp' ),
    'panel'		 => 'header_panel',
) );
/*
*
*	1st Level Menu
*
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'main_menu_font',
    'label'       => esc_attr__( '1st Level Menu', 'hiiwp' ),
    'description' => __( 'Define styles for 1st level in Top Navigation Menu', 'hiiwp' ),
    'section'     => $section,
    'default'     =>  $hiilite_options['main_menu_font'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'main_menu_colors',
    'label'       => __( 'Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 1,
    'choices'     => array(
        'hover'   => esc_attr__( 'Hover Color', 'hiiwp' ),
        'active'  => esc_attr__( 'Active Color', 'hiiwp' ),
        'hover_background'  => esc_attr__( 'Hover Background', 'hiiwp' ),
    ),
    'default'     => $hiilite_options['main_menu_colors'],
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'main_menu_padding',
	'label'       => __( 'Padding', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['main_menu_padding'],
	'priority'    => 1,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '.menu .menu-item a, .search_button .fa, .nav-link',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '.menu .menu-item a, .search_button .fa, .nav-link',
			'property' => 'padding',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'main_menu_links_css',
	'label'       => __( 'Menu Custom CSS (.menu .menu-item a)', 'hiiwp' ),
	'section'     => $section,
	'default'     => '',
	'priority'    => 2,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );



/*
*
*	2nd Level Menu
*
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'second_level_menu_font',
    'label'       => esc_attr__( '2nd Level Menu', 'hiiwp' ),
    'description' => __( 'Define styles for 2nd level in Top Navigation Menu', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['second_level_menu_font'],
    'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'second_level_menu_colors',
    'label'       => __( 'Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 3,
    'choices'     => array(
        'hover'   => esc_attr__( 'Hover Color', 'hiiwp' ),
        'active'  => esc_attr__( 'Active Color', 'hiiwp' ),
        'hover_background'  => esc_attr__( 'Hover Background', 'hiiwp' ),
    ),
    'default'     => $hiilite_options['second_level_menu_colors'],
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'second_level_menu_padding',
	'label'       => __( 'Padding', 'hiiwp' ),
	'section'     => $section,
	'default'     => array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	),
	'priority'    => 3,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#main_header .menu ul.sub-menu .menu-item a',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#main_header .menu ul.sub-menu .menu-item a',
			'property' => 'padding',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'second_level_menu_links_css',
	'label'       => __( 'Menu Custom CSS (.menu .menu-item a)', 'hiiwp' ),
	'section'     => $section,
	'default'     => '',
	'priority'    => 4,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );	

/*
*
*	3rd Level Menu
*
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'third_level_menu_font',
    'label'       => esc_attr__( '3rd Level Menu', 'hiiwp' ),
    'description' => __( 'Define styles for 3rd level in Top Navigation Menu', 'hiiwp' ),
    'section'     => $section,
    'default'     =>  array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => 'None',
        'color'			 => ' ',
    ),
    'priority'    => 5,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'third_level_menu_colors',
    'label'       => __( 'Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 5,
    'choices'     => array(
        'hover'   => esc_attr__( 'Hover Color', 'hiiwp' ),
        'active'  => esc_attr__( 'Active Color', 'hiiwp' ),
        'hover_background'  => esc_attr__( 'Hover Background', 'hiiwp' ),
    ),
    'default'     => array(
        'hover'   => '',
        'active'  => '',
        'hover_background'  => '',
    ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'third_level_menu_padding',
	'label'       => __( 'Padding', 'hiiwp' ),
	'section'     => $section,
	'default'     => array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	),
	'priority'    => 5,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#main_header .menu ul.sub-menu ul.sub-menu .menu-item a',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#main_header .menu ul.sub-menu ul.sub-menu .menu-item a',
			'property' => 'padding',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'third_level_menu_links_css',
	'label'       => __( 'Menu Custom CSS (.menu .menu-item a)', 'hiiwp' ),
	'section'     => $section,
	'default'     => '',
	'priority'    => 5,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );	
