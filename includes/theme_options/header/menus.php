<?php
$section = 'header_menu_section';
Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Menus', 'hiiwp' ),
    'description' => __( 'Menus settings', 'hiiwp' ),
    'panel'		 => 'header_panel',
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'dropdown_background_color',
	'label'       => __( 'Dropdown Menu Background', 'hiiwp' ),
	'description' => __('Choose a color and transparency for the main menu background', 'hiiwp'),
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
	'description' => __('Choose color for the main menu background', 'hiiwp'),
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
	'description' => __('Choose color for mobile menu background', 'hiiwp'),
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
    'label'       => esc_attr__( 'Main Menu Alignment', 'hiiwp' ),
    'description' => __( 'Change the text align of the main menu', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['main_menu_align'], 
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'menu_margin',
	'label'       => __( 'Menu Margin', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['menu_margin'],
	'priority'    => 1,
	
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'left_menu_align',
    'label'       => esc_attr__( 'Left Menu Alignment', 'hiiwp' ),
    'description' => __( 'Change the text align of the left menu', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['left_menu_align'], 
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
    'label'       => esc_attr__( 'Right Menu Alignment', 'hiiwp' ),
    'description' => __( 'Change the text align of the right menu', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['right_menu_align'], 
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
    'label'       => esc_attr__( 'Bottom Menu Alignment', 'hiiwp' ),
    'description' => __( 'Change the text align of the bottom menu', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['bottom_menu_align'], 
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
    'label'       => __( 'Mobile Menu Switch', 'hiiwp' ),
    'description'  => __( 'At what size should the menu switch to the mobile menu', 'hiiwp' ),
    'section'     => $section,
    'default'     => '768px',
    'priority'    => 11,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'mobile_menu_icon_color',
	'label'       => __( 'Mobile Menu Icon', 'hiiwp' ),
	'description' => __('Change the color of the mobile menu icon', 'hiiwp'),
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