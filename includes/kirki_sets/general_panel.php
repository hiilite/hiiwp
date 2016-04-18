<?php
	Kirki::add_panel( 'general_panel', array(
    'priority'    => 1,
    'title'       => __( 'General', 'textdomain' ),
    'description' => __( 'Global settings', 'textdomain' ),
) );
// GLOBAL SETTINGS
Kirki::add_section( 'general_section_globals', array(
    'title'          => __( 'Global Settings' ),
    'description'    => __( 'Some basic settings for the site' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options'
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'amp',
	'label'       => esc_attr__( 'Make AMP Site', 'my_textdomain' ),
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Make whole site AMP compatible. This means no external CSS or JS is allowed, so many plugins will not work. Any forms must be loaded in an iframe (can be done in row options) and be 75% or 600px from the top of the page. No in tag CSS is allowed, and no use of !important in custom CSS. all image and other embedded elements are converted to there amp counterparts' ),
) );

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
	'type'        => 'switch',
	'settings'    => 'teams_on',
	'label'       => esc_attr__( 'Teams', 'my_textdomain' ),
	'section'     => 'general_section_globals',
	'default'     => false,
	'priority'	  => 1,
	'description'    => __( 'Turn on the Teams post type' ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'grid_width',
	'label'       => esc_attr__( 'Grid Width', 'my_textdomain' ),
	'section'     => 'general_section_globals',
	'default'     => '1100px',
	'priority'    => 1,
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_css',
	'label'       => __( 'Custom CSS', 'my_textdomain' ),
	'description' => __( 'Custom style for across the site', 'textdomain' ),
	'section'     => 'general_section_globals',
	'default'     => '',
	'priority'    => 2,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );



// DEFAULT FONTS
Kirki::add_section( 'general_section', array(
    'title'          => __( 'Default Fonts' ),
    'description'    => __( 'Select the fonts to use across the site' ),
    'panel'          => 'general_panel', // Not typically needed.
    'priority'       => 3,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'default_font',
    'label'       => esc_attr__( 'Default Font', 'kirki' ),
    'description'    => __( 'This will be used for all body text (and headings if not defined in Font 1)' ),
    'section'     => 'general_section',
    'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '14px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
    ),
    'priority'    => 9,
    'output'      => array(
        array(
            'element' => 'body',
        ),
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'heading_font',
    'label'       => esc_attr__( 'Heading Font', 'kirki' ),
    'description'    => __( 'This will be used for all body text (and headings if not defined in Font 1)' ),
    'section'     => 'general_section',
    'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'letter-spacing' => '0',
        'color'          => '#333333',
    ),
    'priority'    => 10,
    'output'      => array(
        array(
            'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2',
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
	'label'       => __( 'Primary Color', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#ef5022',
	'priority'    => 1,
	'alpha'       => true,
	'transport'	  => 'postMessage',
	
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_two',
	'label'       => __( 'Secondary Color', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#71be44',
	'priority'    => 2,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_three',
	'label'       => __( 'Info Color', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#2eb6c4',
	'priority'    => 3,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_four',
	'label'       => __( 'Typography Color', 'my_textdomain' ),
	'section'     => 'general_section_color_palette',
	'default'     => '#555555',
	'priority'    => 4,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'color_five',
	'label'       => __( 'Text Link Color', 'my_textdomain' ),
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



// GLOBAL SETTINGS
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
	'default'     => '',
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
	?>