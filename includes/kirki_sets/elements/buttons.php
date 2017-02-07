<?php
$section = 'elements_button_section';

Kirki::add_section( $section, array(
    'priority'    => 6,
    'title'       => __( 'Buttons', 'textdomain' ),
    'panel'		 => 'elements_panel',
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
    'section'     => $section,
    'label'		  => '',
    'default'     => '<h1>Default Button</h1>',
    'priority'    => 1,
) );
$button_font = $default_font;
$button_font['color']	= get_theme_mod( 'color_one', '#303030');
$button_font['text-transform'] = 'uppercase';
$button_font['text-align']	= 'center';


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_default_font',
    'label'       => esc_attr__( 'Default Button Font (.button)', 'kirki' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Lato',
        'font-size'      => '1em',
        'line-height'    => '1.5em',
        'letter-spacing' => '0px',
        'text-align'	 => $button_font['text-align'],
        'text-transform' => $button_font['text-transform'],
        'color'          => $button_font['color'],
    ), 
    'priority'    => 1,
) );



/*Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_default_font',
    'label'       => esc_attr__( 'Default Button Font (.button)', 'kirki' ),
    'section'     => $section,
    'default'     => $button_font,
    'priority'    => 1,
) );*/
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_default_background',
	'label'       => __( 'Background Color (.button)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => 'none',
	'priority'    => 1,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_default_padding',
	'label'       => __( 'Button Padding (.button)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => array(
		'top'    => '0.5em',
		'right'  => '1em',
		'bottom' => '0.5em',
		'left'   => '1em',
	),
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_default_border_color',
	'label'       => __( 'Border Color (.button)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => get_theme_mod( 'color_one', '#303030'),
	'priority'    => 1,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_default_border_width',
	'label'       => __( 'Border Width (.button)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '2px',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_default_border_radius',
	'label'       => __( 'Border Radius (.button)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '6px',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_custom_css',
	'label'       => __( 'Button Custom CSS (.button)', 'my_textdomain' ),
	'description' => __( 'Custom style for standard buttons across the site', 'textdomain' ),
	'section'     => $section,
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
    'section'     => $section,
    'label'		  => '',
    'default'     => '<hr><h1>Primary Button</h1>',
    'priority'    => 1,
) );
$button_font['color']	= '#ffffff';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_primary_font',
    'label'       => esc_attr__( 'Primary Button Font (.button-primary)', 'kirki' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Lato',
        'font-size'      => '1em',
        'line-height'    => '1.5em',
        'letter-spacing' => '0px',
        'text-align'	 => $button_font['text-align'],
        'text-transform' => $button_font['text-transform'],
        'color'          => $button_font['color'],
    ), 
    'priority'    => 2,
) );

/*Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_primary_font',
    'label'       => esc_attr__( 'Primary Button Font (.button-primary)', 'kirki' ),
    'section'     => $section,
    'default'     => $button_font,
    'priority'    => 2,
) );*/
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_primary_background',
	'label'       => __( 'Background Color (.button-primary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => get_theme_mod( 'color_one', '#303030'),
	'priority'    => 2,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_primary_padding',
	'label'       => __( 'Button Padding (.button-primary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => array(
		'top'    => '0.5em',
		'right'  => '1em',
		'bottom' => '0.5em',
		'left'   => '1em',
	),
	'priority'    => 2,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_primary_border_color',
	'label'       => __( 'Border Color (.button-primary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => get_theme_mod( 'color_one', '#303030'),
	'priority'    => 2,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_primary_border_width',
	'label'       => __( 'Border Width (.button-primary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '2px',
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_primary_border_radius',
	'label'       => __( 'Border Radius (.button-primary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '6px',
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_primary_custom_css',
	'label'       => __( 'Button Custom CSS (.button-primary)', 'my_textdomain' ),
	'description' => __( 'Custom style for standard buttons across the site', 'textdomain' ),
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
*	SECONDARY BUTTONS
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'custom',
    'settings'    => 'button_secondary_separator',
    'section'     => $section,
    'label'		  => '',
    'default'     => '<hr><h1>Secondary Button</h1>',
    'priority'    => 3,
) );
$button_font['color']	= '#ffffff';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_secondary_font',
    'label'       => esc_attr__( 'Secondary Button Font (.button-secondary)', 'kirki' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => 'Lato',
        'font-size'      => '1em',
        'line-height'    => '1.5em',
        'letter-spacing' => '0px',
        'text-align'	 => $button_font['text-align'],
        'text-transform' => $button_font['text-transform'],
        'color'          => $button_font['color'],
    ), 
    'priority'    => 3,
) );

/*Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_secondary_font',
    'label'       => esc_attr__( 'Secondary Button Font (.button-secondary)', 'kirki' ),
    'section'     => $section,
    'default'     => $button_font,
    'priority'    => 3,
) );*/
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_secondary_background',
	'label'       => __( 'Background Color (.button-secondary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => get_theme_mod( 'color_two', '#303030'),
	'priority'    => 3,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_secondary_padding',
	'label'       => __( 'Button Padding (.button-secondary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => array(
		'top'    => '0.5em',
		'right'  => '1em',
		'bottom' => '0.5em',
		'left'   => '1em',
	),
	'priority'    => 3,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_secondary_border_color',
	'label'       => __( 'Border Color (.button-secondary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => get_theme_mod( 'color_two', '#303030'),
	'priority'    => 3,
	'alpha'       => true,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_secondary_border_width',
	'label'       => __( 'Border Width (.button-secondary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '2px',
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_secondary_border_radius',
	'label'       => __( 'Border Radius (.button-secondary)', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '6px',
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_secondary_custom_css',
	'label'       => __( 'Button Custom CSS (.button-secondary)', 'my_textdomain' ),
	'description' => __( 'Custom style for standard buttons across the site', 'textdomain' ),
	'section'     => $section,
	'default'     => '',
	'priority'    => 3,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );	
?>