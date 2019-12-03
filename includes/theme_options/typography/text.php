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
    'label'       => esc_attr__( 'Paragraph Font', 'hiiwp' ),
    'description' => __( 'Define styles for paragraph text', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['text_font'],
    'priority'    => 1,
) );

/*
// Replaced with typography_p_margin
Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'text_margin',
    'label'       => esc_attr__( 'Paragraph Bottom Margin', 'hiiwp' ),
    'description' => __( 'Define the paragraph tags margin-bottom', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['text_margin'],
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
*/

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_p_margin',
	'label'       => __( 'Paragraph Margin', 'hiiwp' ),
	'description' => __( 'Define the paragraph tags margin-bottom', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_p_margin'],
	'priority'    => 1,
	'output'	  => array(
		array(
			'element'	=> 'p',
			'property'	=> 'margin',
		)  
    ),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'link_color',
	'label'       => __( 'Link Colors', 'hiiwp' ),
	'description' => __('Define styles for link text', 'hiiwp'),
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
	'label'       => __( 'Link Custom CSS (a)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_link_custom_css'],
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );

/*
*
*	Blockquotes
*	
*/


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'blockquote_font',
    'label'       => esc_attr__( 'Blockquote Font', 'hiiwp' ),
    'description' => __( 'Define styles for blockquote text', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['text_font'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'blockquote_background_color',
    'label'       => esc_attr__( 'Blockquote Background Color', 'hiiwp' ),
    'description'       => __( 'Blockquote background color', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blockquote_background_color'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'blockquote_color',
    'label'       => esc_attr__( 'Blockquote Highlight Color', 'hiiwp' ),
    'description'       => __( 'Blockquote left border and quote color', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blockquote_color'],
    'priority'    => 1,
) );


/*
*
*	Custom Formats
*	
*/

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_format_1',
	'label'       => __( 'Custom Format 1 (.custom_format_1)', 'hiiwp' ),
	'description' => __( 'Custom format that can be used in the visual editor', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['custom_format_1'],
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	)
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_format_2',
	'label'       => __( 'Custom Format 2 (.custom_format_2)', 'hiiwp' ),
	'description' => __( 'Custom format that can be used in the visual editor', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['custom_format_2'],
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	)
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'custom_format_3',
	'label'       => __( 'Custom Format 3 (.custom_format_3)', 'hiiwp' ),
	'description' => __( 'Custom format that can be used in the visual editor', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['custom_format_3'],
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	)
) );
?>