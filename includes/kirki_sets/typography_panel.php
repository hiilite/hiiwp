<?php
Kirki::add_panel( 'typography_panel', array(
    'priority'    => 6,
    'title'       => __( 'Typography', 'textdomain' ),
    'description' => __( 'Typography settings', 'textdomain' ),
) );
Kirki::add_section( 'typography_defaults_section', array(
    'title'          => __( 'Default Fonts' ),
    'description'    => __( 'Select the fonts to use across the site' ),
    'panel'          => 'typography_panel', // Not typically needed.
    'priority'       => 6,
) );
Kirki::add_section( 'typography_headings_section', array(
    'priority'    => 6,
    'title'       => __( 'Headings', 'textdomain' ),
    'description' => __( 'Typography settings', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );
Kirki::add_section( 'typography_button_section', array(
    'priority'    => 6,
    'title'       => __( 'Buttons', 'textdomain' ),
    'description' => __( 'Button font settings', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );
Kirki::add_section( 'typography_text_section', array(
    'priority'    => 6,
    'title'       => __( 'Custom Formats', 'textdomain' ),
    'description' => __( 'Links, Icons, and Custom Formats', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );

Kirki::add_section( 'typography_footer_section', array(
    'priority'    => 6,
    'title'       => __( 'Footer', 'textdomain' ),
    'description' => __( 'Footer title and text properties', 'textdomain' ),
    'panel'		 => 'typography_panel',
) );



// DEFAULT FONTS

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'default_font',
    'label'       => esc_attr__( 'Default Font', 'kirki' ),
    'description'    => __( 'This will be used for all body text (and headings if not defined in Font 1)' ),
    'section'     => 'typography_defaults_section',
    'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '14px',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#333333'),
    ),
    'priority'    => 9,
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'heading_font',
    'label'       => esc_attr__( 'Heading Font', 'kirki' ),
    'description'    => __( 'This will be used for all body text (and headings if not defined in Font 1)' ),
    'section'     => 'typography_defaults_section',
    'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'letter-spacing' => '0px',
        'color'          => '#333333',
        'text_transform'  => 'none',
    ),
    'priority'    => 10,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'multicolor',
    'settings'    => 'default_link_colors',
    'label'       => esc_attr__( 'Default Link Color', 'kirki' ),
    'section'     => 'general_section',
    'priority'    => 10,
    'choices'     => array(
        'link'    => esc_attr__( 'Color', 'kirki' ),
        'hover'   => esc_attr__( 'Hover', 'kirki' ),
        'active'  => esc_attr__( 'Active', 'kirki' ),
    ),
    'default'     => array(
        'link'    => get_theme_mod('color_five','#0088cc'),
        'hover'   => get_theme_mod('color_one','#00aaff'),
        'active'  => get_theme_mod('color_two','#00ffff'),
    ),
) );
$default_font = get_theme_mod( 'default_font' );
$default_h1 = get_theme_mod( 'heading_font' );
$default_h1['font-size'] = '2em';
$default_h1['text-transform'] = 'none';
$default_h1['line-height'] = '1.5';
$default_h1['font-size'] = '2em';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h1_font',
    'label'       => esc_attr__( 'H1 Style', 'kirki' ),
    'description' => __( 'Define styles for H1 heading' ),
    'section'     => 'typography_headings_section',
    'default'     => $default_h1,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h2_font',
    'label'       => esc_attr__( 'H2 Style', 'kirki' ),
    'description' => __( 'Define styles for H2 heading' ),
    'section'     => 'typography_headings_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h3_font',
    'label'       => esc_attr__( 'H3 Style', 'kirki' ),
    'description' => __( 'Define styles for H3 heading' ),
    'section'     => 'typography_headings_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
 
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h4_font',
    'label'       => esc_attr__( 'H4 Style', 'kirki' ),
    'description' => __( 'Define styles for H4 heading' ),
    'section'     => 'typography_headings_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h5_font',
    'label'       => esc_attr__( 'H5 Style', 'kirki' ),
    'description' => __( 'Define styles for H5 heading' ),
    'section'     => 'typography_headings_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_h6_font',
    'label'       => esc_attr__( 'H6 Style', 'kirki' ),
    'description' => __( 'Define styles for H1 heading' ),
    'section'     => 'typography_headings_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_link_color',
	'label'       => __( 'Link Color (a)', 'my_textdomain' ),
	'section'     => 'typography_text_section',
	'default'     => get_theme_mod( 'color_one', '#ef5022'),
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_link_custom_css',
	'label'       => __( 'Link Custom CSS (a)', 'my_textdomain' ),
	'section'     => 'typography_text_section',
	'default'     => '{
	text-decoration:none;
}',
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_icon_custom_css',
	'label'       => __( 'Icon Custom CSS (.fa)', 'my_textdomain' ),
	'description' => __( 'Custom style all font-awesome icons', 'textdomain' ),
	'section'     => 'typography_text_section',
	'default'     => '{
	background: '.get_theme_mod( 'color_one', '#ef5022').';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	color: white;
	line-height: 1.6em;
	border-radius: 2em;
}',
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );

/*
*
*	BUTTONS
*	
*/

/*
*
*	DEFAULT BUTTONS
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'custom',
    'settings'    => 'button_default_separator',
    'section'     => 'typography_button_section',
    'label'		  => '',
    'default'     => '<h1>Default Button</h1>',
    'priority'    => 1,
) );
$button_font = $default_font;
$button_font['color']	= get_theme_mod( 'color_one', '#ef5022');
$button_font['text-transform'] = 'uppercase';
$button_font['text-align']	= 'center';
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_default_font',
    'label'       => esc_attr__( 'Default Button Font (.button)', 'kirki' ),
    'section'     => 'typography_button_section',
    'default'     => $button_font,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_default_background',
	'label'       => __( 'Background Color (.button)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => 'none',
	'priority'    => 1,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_default_padding',
	'label'       => __( 'Button Padding (.button)', 'my_textdomain' ),
	'section'     => 'my_section',
	'default'     => array(
		'top'    => '0.5em',
		'bottom' => '0.5em',
		'left'   => '1em',
		'right'  => '1em',
	),
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_default_border_color',
	'label'       => __( 'Border Color (.button)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => get_theme_mod( 'color_one', '#ef5022'),
	'priority'    => 1,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_default_border_width',
	'label'       => __( 'Border Width (.button)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '2px',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_default_border_radius',
	'label'       => __( 'Border Radius (.button)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '6px',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_custom_css',
	'label'       => __( 'Button Custom CSS (.button)', 'my_textdomain' ),
	'description' => __( 'Custom style for standard buttons across the site', 'textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '
	margin: 1em 0;
	text-decoration: none;
	display: inline-block;',
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );



/*
*
*	PRIMARY BUTTONS
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'custom',
    'settings'    => 'button_primary_separator',
    'section'     => 'typography_button_section',
    'label'		  => '',
    'default'     => '<hr><h1>Primary Button</h1>',
    'priority'    => 1,
) );
$button_font['color']	= '#ffffff';
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_primary_font',
    'label'       => esc_attr__( 'Primary Button Font (.button-primary)', 'kirki' ),
    'section'     => 'typography_button_section',
    'default'     => $button_font,
    'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_primary_background',
	'label'       => __( 'Background Color (.button-primary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => get_theme_mod( 'color_one', '#ef5022'),
	'priority'    => 2,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_primary_padding',
	'label'       => __( 'Button Padding (.button-primary)', 'my_textdomain' ),
	'section'     => 'my_section',
	'default'     => array(
		'top'    => '0.5em',
		'bottom' => '0.5em',
		'left'   => '1em',
		'right'  => '1em',
	),
	'priority'    => 2,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_primary_border_color',
	'label'       => __( 'Border Color (.button-primary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => get_theme_mod( 'color_one', '#ef5022'),
	'priority'    => 2,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_primary_border_width',
	'label'       => __( 'Border Width (.button-primary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '2px',
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_primary_border_radius',
	'label'       => __( 'Border Radius (.button-primary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '6px',
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_primary_custom_css',
	'label'       => __( 'Button Custom CSS (.button-primary)', 'my_textdomain' ),
	'description' => __( 'Custom style for standard buttons across the site', 'textdomain' ),
	'section'     => 'typography_button_section',
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
*	SECONDARY BUTTONS
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'custom',
    'settings'    => 'button_secondary_separator',
    'section'     => 'typography_button_section',
    'label'		  => '',
    'default'     => '<hr><h1>Secondary Button</h1>',
    'priority'    => 3,
) );
$button_font['color']	= '#ffffff';
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_secondary_font',
    'label'       => esc_attr__( 'Primary Button Font (.button-secondary)', 'kirki' ),
    'section'     => 'typography_button_section',
    'default'     => $button_font,
    'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_secondary_background',
	'label'       => __( 'Background Color (.button-secondary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => get_theme_mod( 'color_two', '#ef5022'),
	'priority'    => 3,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_secondary_padding',
	'label'       => __( 'Button Padding (.button-secondary)', 'my_textdomain' ),
	'section'     => 'my_section',
	'default'     => array(
		'top'    => '0.5em',
		'bottom' => '0.5em',
		'left'   => '1em',
		'right'  => '1em',
	),
	'priority'    => 3,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_secondary_border_color',
	'label'       => __( 'Border Color (.button-secondary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => get_theme_mod( 'color_two', '#ef5022'),
	'priority'    => 3,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_secondary_border_width',
	'label'       => __( 'Border Width (.button-secondary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '2px',
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_secondary_border_radius',
	'label'       => __( 'Border Radius (.button-secondary)', 'my_textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '6px',
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_secondary_custom_css',
	'label'       => __( 'Button Custom CSS (.button-secondary)', 'my_textdomain' ),
	'description' => __( 'Custom style for standard buttons across the site', 'textdomain' ),
	'section'     => 'typography_button_section',
	'default'     => '',
	'priority'    => 3,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );


/*
*
*	Custom Formats
*	
*/

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_format_1',
	'label'       => __( 'Custom Format 1 (.custom_format_1)', 'my_textdomain' ),
	'description' => __( 'Custom format that can be used in the visual editor', 'textdomain' ),
	'section'     => 'typography_text_section',
	'default'     => '{
}',
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
	'output' => '.custom_format_1',
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_format_2',
	'label'       => __( 'Custom Format 2 (.custom_format_2)', 'my_textdomain' ),
	'description' => __( 'Custom format that can be used in the visual editor', 'textdomain' ),
	'section'     => 'typography_text_section',
	'default'     => '{
}',
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
	'output' => '.custom_format_2',
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_format_3',
	'label'       => __( 'Custom Format 3 (.custom_format_3)', 'my_textdomain' ),
	'description' => __( 'Custom format that can be used in the visual editor', 'textdomain' ),
	'section'     => 'typography_text_section',
	'default'     => '{
}',
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
	'output' => '.custom_format_3',
) );




Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_headings_font',
    'label'       => esc_attr__( 'Footer Headings Font', 'kirki' ),
    'section'     => 'typography_footer_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_text_font',
    'label'       => esc_attr__( 'Footer Text Font', 'kirki' ),
    'section'     => 'typography_footer_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_links_font',
    'label'       => esc_attr__( 'Footer Links Font', 'kirki' ),
    'section'     => 'typography_footer_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

	?>