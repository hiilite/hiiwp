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

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'grid_width',
	'label'       => esc_attr__( 'Grid Width', 'my_textdomain' ),
	'section'     => 'general_section_globals',
	'default'     => '1100px',
	'priority'    => 1,
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
// Menus
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




// COLOR PALETTE
Kirki::add_section( 'general_section_color_palette', array(
    'title'          => __( 'Color Palette' ),
    'description'    => __( 'Choose the color palette for the entire site' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_one',
	'label'       => __( 'Primary Color (Color 1)', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#ef5022',
	'priority'    => 1,
	'alpha'       => true,
	'transport'	  => 'postMessage',
	
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_two',
	'label'       => __( 'Secondary Color ( Color 2)', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#71be44',
	'priority'    => 2,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_three',
	'label'       => __( 'Info Color (Color 3)', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#2eb6c4',
	'priority'    => 3,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_four',
	'label'       => __( 'Typography Color (Color 4)', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#555555',
	'priority'    => 4,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_five',
	'label'       => __( 'Text Link Color (Color 5)', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#8f52a0',
	'priority'    => 5,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'default_background_color',
	'label'       => __( 'Background Color', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => 'rgba(255,255,255,1)',
	'priority'    => 6,
	'alpha'       => true,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'secondary_background_color',
	'label'       => __( 'Background Color', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#ebeef1',
	'priority'    => 7,
	'alpha'       => true,
) );


// GLOBAL CSS SETTINGS
Kirki::add_section( 'general_section_custom_css', array(
    'title'          => __( 'Custom CSS' ),
    'description'    => __( 'Custom CSS for whole site' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options'
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_css',
	'label'       => __( 'Custom CSS', 'my_textdomain' ),
	'description' => __( 'Custom style for across the site', 'textdomain' ),
	'section'     => 'general_section_custom_css',
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
	'section'     => 'general_section_custom_css',
	'default'     => '',
	'priority'    => 2,
	'choices'     => array(
		'language' => 'css',
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