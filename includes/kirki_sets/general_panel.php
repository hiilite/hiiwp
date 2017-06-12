<?php
$section = 'general_section_globals';
//////////////////////
//
//	GENERAL PANEL
//
//////////////////////
Kirki::add_panel( 'general_panel', array(
    'priority'    => 1,
    'title'       => __( 'General', 'textdomain' ),
    'description' => __( 'Global settings', 'textdomain' ),
    'icon' => 'dashicons-admin-home'
) );
//////////////////////
//
// GENERAL SETTINGS
//
//////////////////////
Kirki::add_section( $section, array(
    'title'          => __( 'Global Settings' ),
    'description'    => __( 'Some basic settings for the site' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options'
) );


//////////////////
// Portfolio
Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'portfolio_on',
	'label'       => esc_attr__( 'Portfolio', 'my_textdomain' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_on'],
	'priority'	  => 1,
	'description'    => __( 'Turn on the Portfolio post type' ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_title',
    'label'       => __( 'Portfolio Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the Portfolio post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_slug',
    'label'       => __( 'Portfolio Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the portfolio post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_tax_title',
    'label'       => __( 'Portfolio Taxonomy Title', 'my_textdomain' ),
    'description'    => __('Change the menu title of the portfolios Work taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_tax_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_tax_slug',
    'label'       => __( 'Portfolio Taxonomy Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the portfolios taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_tax_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


//////////////////
// Teams
Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'teams_on',
	'label'       => esc_attr__( 'Teams', 'my_textdomain' ),
	'section'     => $section,
	'default'     => $hiilite_options['teams_on'],
	'priority'	  => 1,
	'description'    => __( 'Turn on the Teams post type' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'team_title',
    'label'       => __( 'Teams Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the Team post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['teams_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'teams_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'team_slug',
    'label'       => __( 'Teams Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the team post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['teams_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'teams_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'team_tax_title',
    'label'       => __( 'Team Taxonomy Title', 'my_textdomain' ),
    'description'    => __('Change the menu title of the teams Position taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['team_tax_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'teams_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'team_tax_slug',
    'label'       => __( 'Team Taxonomy Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the teams Position taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['team_tax_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'teams_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


//////////////////
// Menus
Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'menus_on',
	'label'       => esc_attr__( 'Food Menu', 'my_textdomain' ),
	'section'     => $section,
	'default'     => $hiilite_options['menus_on'],
	'priority'	  => 1,
	'description'    => __( 'Turn on the Restaurant Menu post type' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'menu_title',
    'label'       => __( 'Menu Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the Menu post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['menu_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'menus_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'menu_slug',
    'label'       => __( 'Menu Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the menu post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['menu_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'menus_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'menu_tax_title',
    'label'       => __( 'Menu Taxonomy Title', 'my_textdomain' ),
    'description'    => __('Change the menu title of the menus Section taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['menu_tax_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'menus_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'menu_tax_slug',
    'label'       => __( 'Team Taxonomy Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the Menu Section taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['menu_tax_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'menus_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );



//////////////////
// Testimonials
Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'testimonials_on',
	'label'       => esc_attr__( 'Testimonials On', 'my_textdomain' ),
	'section'     => $section,
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Turn on the testimonials post type' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'testimonials_title',
    'label'       => __( 'Testimonials Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the testimonials post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['testimonials_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'testimonials_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'testimonials_slug',
    'label'       => __( 'Testimonials Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the testimonials post-type'),
    'section'     => $section,
    'default'     => $hiilite_options['testimonials_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'testimonials_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'testimonials_tax_title',
    'label'       => __( 'Testimonials Taxonomy Title', 'my_textdomain' ),
    'description'    => __('Change the menu title of the testimonials taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['testimonials_tax_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'testimonials_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'testimonials_tax_slug',
    'label'       => __( 'Testimonials Taxonomy Slug', 'my_textdomain' ),
    'description'    => __('Change the url slug used for the testimonials taxonomy'),
    'section'     => $section,
    'default'     => $hiilite_options['testimonials_tax_slug'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'testimonials_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

//////////////////
// RETS Listings
Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'rets_listings_on',
	'label'       => esc_attr__( 'RETS Listings On', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['rets_listings_on'],
	'priority'	  => 1,
	'description'    => __( 'Turn on Real Estate Listing functionality for connection with SimplyRETS' ),
) );


///////////////////
//
// DESIGN STYLE
//
///////////////////
$section = 'general_section_design_style';
Kirki::add_section( $section, array(
    'title'          => __( 'Design Style' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options'
) );

// Font Family
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'default_font',
    'label'       => esc_attr__( 'Font Family', 'kirki' ),
    'description'    => __( 'Choose a default Google font for your site' ),
    'section'     => $section,
    'default'     => $hiilite_options['default_font'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'additional_google_fonts_yesno',
	'label'       => esc_attr__( 'Additional Google Fonts', 'hiiwp' ),
	'section'     => $section,
	'default'     => false,
	'priority'	  => 1,
) );

// Font Family
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'additional_google_font1',
    'label'       => esc_attr__( 'Font Family', 'kirki' ),
    'description'    => __( 'Choose additional Google font for your site' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Serif',
        'variant'        => '',
    ),
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'additional_google_fonts_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'additional_google_font2',
    'label'       => esc_attr__( 'Font Family', 'kirki' ),
    'description'    => __( 'Choose additional Google font for your site' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Serif',
        'variant'        => '',
    ),
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'additional_google_fonts_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'additional_google_font3',
    'label'       => esc_attr__( 'Font Family', 'kirki' ),
    'description'    => __( 'Choose additional Google font for your site' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Serif',
        'variant'        => '',
    ),
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'additional_google_fonts_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'additional_google_font4',
    'label'       => esc_attr__( 'Font Family', 'kirki' ),
    'description'    => __( 'Choose additional Google font for your site' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Serif',
        'variant'        => '',
    ),
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'additional_google_fonts_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'additional_google_font5',
    'label'       => esc_attr__( 'Font Family', 'kirki' ),
    'description'    => __( 'Choose additional Google font for your site' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Serif',
        'variant'        => '',
    ),
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'additional_google_fonts_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


// Color Palete
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_one',
	'label'       => __( 'First Main Color (Color 1)', 'my_textdomain' ),
	'description' => __('Choose the most dominant theme color, by default will color link and button hover effects'),
	'section'     => $section,
	'default'     => $hiilite_options['color_one'],
	'priority'    => 1,
	
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_two',
	'label'       => __( 'Second Main Color ( Color 2)', 'my_textdomain' ),
	'section'     => $section,
	'description' => __('Choose the second most dominant theme color, by default will style base and primary buttons and all headings and titles'),
	'default'     => $hiilite_options['color_two'],
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_three',
	'label'       => __( 'Third Main Color (Color 3)', 'my_textdomain' ),
	'description' => __('Choose the third most dominant theme color'),
	'section'     => $section,
	'default'     => $hiilite_options['color_three'],
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_four',
	'label'       => __( 'Fourth Main Color (Color 4)', 'my_textdomain' ),
	'description' => __('Choose the fourth most dominant theme color'),
	'section'     => $section,
	'default'     => $hiilite_options['color_four'],
	'priority'    => 1,
) );
/*
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_five',
	'label'       => __( 'Fifth Main Color (Color 5)', 'my_textdomain' ),
	'description' => __('Choose the fifth most dominant theme color'),
	'section'     => $section,
	'default'     => $hiilite_options['color_five'],
	'priority'    => 1,
) );
*/
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'default_background_color',
	'label'       => __( 'Content Background Color', 'my_textdomain' ),
	'description' => __('Choose the background color for page content area'),
	'section'     => $section,
	'default'     => $hiilite_options['default_background_color'],
	'priority'    => 1,
	'alpha'		  => true,
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => 'body',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => 'body',
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'secondary_background_color',
	'label'       => __( 'Box Background Color', 'my_textdomain' ),
	'description' => __('Choose the background color for boxes that use "in grid"'),
	'section'     => $section,
	'default'     => $hiilite_options['secondary_background_color'],
	'priority'    => 1,
	'transport'   => 'postMessage',
	'alpha'		  => true,
    'output' => array(
		array(
			'element'  => 'section .container_inner > .in_grid',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => 'section .container_inner > .in_grid',
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'selection_color',
	'label'       => __( 'Text Selection Color', 'my_textdomain' ),
	'description' => __('Choose the color users see when selecting text'),
	'section'     => $section,
	'default'     => $hiilite_options['selection_color'],
	'priority'    => 1,
	'transport'   => 'postMessage',
	'output' => array(
		array(
			'element'  => '::selection',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '::selection',
			'property' => 'background-color',
		),
	),
) );

// Enable Overlapping Content
/*
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'overlapping_content_yesno',
    'label'       => __( 'Enable Overlapping Content', 'hiiwp' ),
    'description' => __('Enabling this option will make content overlap title area or slider for set amount of pixels'),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'overlapping_content_amount',
	'label'       => esc_attr__( 'Overlapping amount', 'my_textdomain' ),
	'description' => __('Enter amount of pixels you would like content to overlap title area or slider'),
	'section'     => $section,
	'default'     => '0px',
	'priority'    => 1,
	'active_callback'	=> array(
		array(
			'setting'  => 'overlapping_content_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
*/



Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'grid_width',
	'label'       => esc_attr__( 'Initial Width of Content', 'my_textdomain' ),
	'description' => __('Choose the initial width of content which is in grid'),
	'section'     => $section,
	'default'     => $hiilite_options['grid_width'],
	'priority'    => 1,
) );






// GLOBAL CSS SETTINGS
Kirki::add_section( 'general_section_custom_code', array(
    'title'          => __( 'Custom Code' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options'
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_css',
	'label'       => __( 'Custom CSS', 'my_textdomain' ),
	'description' => __( 'Custom style for across the site', 'textdomain' ),
	'section'     => 'general_section_custom_code',
	'default'     => $hiilite_options['custom_css'],
	'priority'    => 2,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'admin_custom_css',
	'label'       => __( 'Admin Custom CSS', 'my_textdomain' ),
	'description' => __( 'Custom style for wp-login and admin areas', 'textdomain' ),
	'section'     => 'general_section_custom_code',
	'default'     => $hiilite_options['admin_custom_css'],
	'priority'    => 2,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_js',
	'label'       => __( 'Custom JS', 'hiiwp' ),
	'description' => __( 'Enter your custom Javascript here', 'textdomain' ),
	'section'     => 'general_section_custom_code',
	'default'     => $hiilite_options['custom_js'],
	'priority'    => 2,
	'choices'     => array(
		'language' => 'javascript',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );


	?>