<?php
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
Kirki::add_section( 'general_section_globals', array(
    'title'          => __( 'Global Settings' ),
    'description'    => __( 'Some basic settings for the site' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options'
) );

//////////////////
// Make AMP
Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'amp',
	'label'       => esc_attr__( 'Make AMP Site', 'my_textdomain' ),
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Make whole site AMP compatible. This means no external CSS or JS is allowed, so many plugins will not work. Any forms must be loaded in an iframe (can be done in row options) and be 75% or 600px from the top of the page. No in tag CSS is allowed, and no use of !important in custom CSS. all image and other embedded elements are converted to there amp counterparts' ),
) );

//////////////////
// Portfolio
Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'portfolio_on',
	'label'       => esc_attr__( 'Portfolio', 'my_textdomain' ),
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Turn on the Portfolio post type' ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_title',
    'label'       => __( 'Portfolio Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the Portfolio post-type'),
    'section'     => 'general_section_globals',
    'default'     => 'Portfolio',
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
    'section'     => 'general_section_globals',
    'default'     => 'portfolio',
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
    'section'     => 'general_section_globals',
    'default'     => 'Work',
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
    'section'     => 'general_section_globals',
    'default'     => 'work',
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
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Turn on the Teams post type' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'team_title',
    'label'       => __( 'Teams Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the Team post-type'),
    'section'     => 'general_section_globals',
    'default'     => 'Team',
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
    'section'     => 'general_section_globals',
    'default'     => 'team',
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
    'section'     => 'general_section_globals',
    'default'     => 'Position',
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
    'section'     => 'general_section_globals',
    'default'     => 'position',
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
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Turn on the Restaurant Menu post type' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'menu_title',
    'label'       => __( 'Menu Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the Menu post-type'),
    'section'     => 'general_section_globals',
    'default'     => 'Menu',
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
    'section'     => 'general_section_globals',
    'default'     => 'menu',
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
    'section'     => 'general_section_globals',
    'default'     => 'Menu Section',
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
    'section'     => 'general_section_globals',
    'default'     => 'menu-section',
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
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Turn on the testimonials post type' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'testimonials_title',
    'label'       => __( 'Testimonials Title', 'my_textdomain' ),
    'description'    => __('Re-title the menus for the testimonials post-type'),
    'section'     => 'general_section_globals',
    'default'     => 'Testimonials',
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
    'section'     => 'general_section_globals',
    'default'     => 'testimonials',
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
    'section'     => 'general_section_globals',
    'default'     => 'Testimonials Categories',
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
    'section'     => 'general_section_globals',
    'default'     => 'testimonials_category',
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
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Turn on Real Estate Listing functionality for connection with SimplyRETS' ),
) );


///////////////////
//
// DESIGN STYLE
//
///////////////////
Kirki::add_section( 'general_section_design_style', array(
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
    'section'     => 'general_section_design_style',
    'default'     => array(
        'font-family'    => 'Raleway',
        'variant'        => '400',
        'font-size'      => '14px',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'text-transform' => 'none',
        'color'          => '#818181',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'additional_google_fonts_yesno',
	'label'       => esc_attr__( 'Additional Google Fonts', 'hiiwp' ),
	'section'     => 'general_section_design_style',
	'default'     => false,
	'priority'	  => 1,
) );

// Font Family
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'additional_google_font1',
    'label'       => esc_attr__( 'Font Family', 'kirki' ),
    'description'    => __( 'Choose additional Google font for your site' ),
    'section'     => 'general_section_design_style',
    'default'     => array(
        'font-family'    => 'Serif',
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
    'section'     => 'general_section_design_style',
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
    'section'     => 'general_section_design_style',
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
    'section'     => 'general_section_design_style',
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
    'section'     => 'general_section_design_style',
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
	'description' => __('Choose the most dominant theme color'),
	'section'     => 'general_section_design_style',
	'default'     => '',
	'priority'    => 1,
	
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_two',
	'label'       => __( 'Second Main Color ( Color 2)', 'my_textdomain' ),
	'section'     => 'general_section_design_style',
	'description' => __('Choose the second most dominant theme color'),
	'default'     => '',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_three',
	'label'       => __( 'Third Main Color (Color 3)', 'my_textdomain' ),
	'description' => __('Choose the third most dominant theme color'),
	'section'     => 'general_section_design_style',
	'default'     => '',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_four',
	'label'       => __( 'Fourth Main Color (Color 4)', 'my_textdomain' ),
	'description' => __('Choose the fourth most dominant theme color'),
	'section'     => 'general_section_design_style',
	'default'     => '',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_five',
	'label'       => __( 'Fifth Main Color (Color 5)', 'my_textdomain' ),
	'description' => __('Choose the fifth most dominant theme color'),
	'section'     => 'general_section_design_style',
	'default'     => '',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'default_background_color',
	'label'       => __( 'Content Background Color', 'my_textdomain' ),
	'description' => __('Choose the background color for page content area'),
	'section'     => 'general_section_design_style',
	'default'     => '#f6f6f6',
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
	'section'     => 'general_section_design_style',
	'default'     => '#fff',
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
	'section'     => 'general_section_design_style',
	'default'     => '',
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
    'section'     => 'general_section_design_style',
    'default'     => false,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'overlapping_content_amount',
	'label'       => esc_attr__( 'Overlapping amount', 'my_textdomain' ),
	'description' => __('Enter amount of pixels you would like content to overlap title area or slider'),
	'section'     => 'general_section_design_style',
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

// Above Header Content
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_above_content',
    'label'       => __( 'Always put content below header', 'hiiwp' ),
    'description' => __('Enabling this option always will put content below header'),
    'section'     => 'general_section_design_style',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'grid_width',
	'label'       => esc_attr__( 'Initial Width of Content', 'my_textdomain' ),
	'description' => __('Choose the initial width of content which is in grid'),
	'section'     => 'general_section_design_style',
	'default'     => '1100px',
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
	'default'     => '',
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
	'default'     => '',
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
	'default'     => '',
	'priority'    => 2,
	'choices'     => array(
		'language' => 'javascript',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );

// GLOBAL SEO SETTINGS
/*
Kirki::add_section( 'general_section_seo', array(
    'title'          => __( 'SEO' ),
    'description'    => __( 'Define the preferred title and description Meta for the home page. Other pages should have their titles and description edited individually.' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 3,
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'text',
	'settings'    => 'analytics_id',
	'label'       => __( 'Google Analytics ID', 'my_textdomain' ),
	'section'     => 'general_section_seo',
	'default'     => '',
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'textlimited',
	'settings'    => 'brand_seo_title',
	'label'       => __( 'Brand Name', 'my_textdomain' ),
	'description'    => __( 'Limit of 20 characters. This will be used by default for all pages (can be overwritten via the Page options) to append to the existing page title: "{Page Title} | {Brand Name}"' ),
	'section'     => 'general_section_seo',
	'default'     => get_bloginfo('title'),
	'transport'	  => 'refresh',
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'textlimited',
	'settings'    => 'site_seo_title',
	'label'       => __( 'Site Title', 'my_textdomain' ),
	'description'    => __( 'Limit of 55 characters. This will be used by default for the Home page (can be overwritten via the Page options) Optimal Format: "Primary Keyword - Secondary Keyword | Brand Name"' ),
	'section'     => 'general_section_seo',
	'default'     => get_bloginfo('title'),
	'transport'	  => 'refresh',
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'textarealimited',
	'settings'    => 'site_seo_description',
	'label'       => __( 'Site Description', 'my_textdomain' ),
	'description'    => __( 'Limit of 155 characters' ),
	'tooltip'		=> __("Google announced in September of 2009 that neither meta descriptions nor meta keywords factor into Google`s ranking algorithms for web search. Google uses meta descriptions to return results when searchers use advanced search operators to match meta tag content, as well as to pull preview snippets on search result pages, but it`s important to note that meta descriptions do nothing to influence Google`s ranking algorithms for normal web search."),
	'section'     => 'general_section_seo',
	'default'     => get_bloginfo('description'),
	'priority'    => 1,
) );
*/
	?>