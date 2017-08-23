<?php
$section = 'typography_text_section';
/*
*
*	TEXT Defaults
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'text_font',
    'label'       => esc_attr__( 'Paragraph Font', 'kirki' ),
    'description' => __( 'Define styles for paragraph text' ),
    'section'     => $section,
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
    'type'        => 'dimension',
    'settings'    => 'text_margin',
    'label'       => esc_attr__( 'Paragraph Bottom Margin', 'kirki' ),
    'description' => __( 'Define the paragraph tags margin-bottom' ),
    'section'     => $section,
    'default'     => '1em',
    'priority'    => 1,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => 'p',
			'property' => 'margin-bottom',
		),
	),
	'js_vars' => array(
		array(
			'element'  => 'p',
			'property' => 'margin-bottom',
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'link_color',
	'label'       => __( 'Link Colors', 'my_textdomain' ),
	'description' => __('Define styles for link text'),
	'section'     => $section,
	'priority'    => 1,
	'choices'     => array(
        'link'  => esc_attr__( 'Text Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
    'default'     => $hiilite_options['link_color'],
) );



Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_link_custom_css',
	'label'       => __( 'Link Custom CSS (a)', 'my_textdomain' ),
	'section'     => $section,
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
	'section'     => $section,
	'default'     => '',
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
	'section'     => $section,
	'default'     => '',
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
	'section'     => $section,
	'default'     => '',
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
	'output' => '.custom_format_3',
) );
?>