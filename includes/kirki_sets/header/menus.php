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
	'default'     => $hiilite_options['dropdown_background_color'],
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
	'label'       => __( 'Main Menu Background Color', 'hiiwp' ),
	'description' => __('Choose color for the main menu background'),
	'section'     => $section,
	'default'     => '',
	'priority'    => 7,
	'output' => array(
		array(
			'element'  => 'nav#main-nav',
			'property' => 'background-color',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'moblie_menu_background_color',
	'label'       => __( 'Mobile Menu Background Color', 'hiiwp' ),
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
    'type'        => 'typography',
    'settings'    => 'main_menu_align',
    'label'       => esc_attr__( 'Main Menu Alignment', 'kirki' ),
    'description' => __( 'Change the text align of the main menu' ),
    'section'     => $section,
    'default'     => array(
        'text-align'          => 'right',
    ), 
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'menu_margin',
	'label'       => __( 'Menu Margin', 'my_textdomain' ),
	'section'     => $section,
	'default'     => $hiilite_options['menu_margin'],
	'priority'    => 1,
	
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'left_menu_align',
    'label'       => esc_attr__( 'Left Menu Alignment', 'kirki' ),
    'description' => __( 'Change the text align of the left menu' ),
    'section'     => $section,
    'default'     => array(
        'text-align'          => 'right',
    ), 
    'priority'    => 1,
    'required'	  => array(
		array(
		    'setting'  => 'header_center_left_on',
			'operator' => '==',
			'value'    => true,
	    )),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'right_menu_align',
    'label'       => esc_attr__( 'Right Menu Alignment', 'kirki' ),
    'description' => __( 'Change the text align of the right menu' ),
    'section'     => $section,
    'default'     => array(
        'text-align'          => 'left',
    ), 
    'priority'    => 1,
    'required'	  => array(
		array(
		    'setting'  => 'header_center_right_on',
			'operator' => '==',
			'value'    => true,
	    )),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'bottom_menu_align',
    'label'       => esc_attr__( 'Bottom Menu Alignment', 'kirki' ),
    'description' => __( 'Change the text align of the bottom menu' ),
    'section'     => $section,
    'default'     => array(
        'text-align'          => 'center',
    ), 
    'priority'    => 1,
    'required'	  => array(
		array(
		    'setting'  => 'header_bottom_on',
			'operator' => '==',
			'value'    => true,
	    )),
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
	'default'     => $hiilite_options['mobile_menu_icon_color'],
	'priority'    => 11,
	'alpha'		  => true,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '.mobile_menu_button .fa, .search_button .fa',
			'property' => 'color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '.mobile_menu_button .fa, .search_button .fa',
			'property' => 'color',
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'enable_search_bar_yesno',
    'label'       => __( 'Enable Search Bar', 'hiiwp' ),
    'description'  => __( 'This option enables Search functionality (search icon will appear next to main navigation)', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['enable_search_bar_yesno'],
    'priority'    => 11,
) );
	
?>