<?php
$section = 'typography_header_menu_section';
/*
*
*
*	Header & Menu
*
*/

/*
*
*	1st Level Menu
*
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'main_menu_font',
    'label'       => esc_attr__( '1st Level Menu', 'kirki' ),
    'description' => __( 'Define styles for 1st level in Top Navigation Menu' ),
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
	'label'       => __( 'Padding', 'my_textdomain' ),
	'section'     => $section,
	'default'     => $hiilite_options['main_menu_padding'],
	'priority'    => 1,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '.menu .menu-item a, .search_button .fa',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '.menu .menu-item a, .search_button .fa',
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
    'label'       => esc_attr__( '2nd Level Menu', 'kirki' ),
    'description' => __( 'Define styles for 2nd level in Top Navigation Menu' ),
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
	'label'       => __( 'Padding', 'my_textdomain' ),
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
    'label'       => esc_attr__( '3rd Level Menu', 'kirki' ),
    'description' => __( 'Define styles for 3rd level in Top Navigation Menu' ),
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
    'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'third_level_menu_colors',
    'label'       => __( 'Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 3,
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
	'label'       => __( 'Padding', 'my_textdomain' ),
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
	'priority'    => 4,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );	

/*
Header Top	
*/
Kirki::add_field( 'hiiwp', array(
	'type'        => 'typography',
	'settings'    => 'header_top_font',
	'label'       => __( 'Header Top Font', 'hiiwp' ),
	'description' => __('Define styles for Header Top area'),
	'section'     => $section,
	'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'text-transform' => 'none',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => ' ',
    ),
	'priority'    => 5,
	'required'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'header_top_colors',
    'label'       => __( 'Link Colors', 'hiiwp' ),
    'description' => __('Header Top link colors'),
    'section'     => $section,
    'priority'    => 6,
    'choices'     => array(
	    'link'   => esc_attr__( 'Link Color', 'hiiwp' ),
        'hover'   => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
    'default'     => array(
        'link'   => '',
        'hover'  => '',
    ),
) );

/*
Header Top	
*/
Kirki::add_field( 'hiiwp', array(
	'type'        => 'typography',
	'settings'    => 'header_bottom_font',
	'label'       => __( 'Header Bottom Font', 'hiiwp' ),
	'description' => __('Define styles for Header Bottom area'),
	'section'     => $section,
	'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'text-transform' => 'none',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => ' ',
    ),
	'priority'    => 7,
	'required'	  => array(
		array(
		    'setting'  => 'header_bottom_on',
			'operator' => '==',
			'value'    => true,
	    )),
) );
?>