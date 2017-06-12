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
    'description' => __( 'Define styles for paragraph text' ),
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
	'label'       => __( 'Link', 'my_textdomain' ),
	'description' => __('Define styles for link text'),
	'section'     => $section,
	'priority'    => 1,
	'choices'     => array(
        'link'  => esc_attr__( 'Text Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
    'default'     => array(
        'link'    => '',
        'hover'   => $hiilite_options['color_one'],
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'icon_settings',
    'label'       => esc_attr__( 'Social Icon Settings', 'kirki' ),
    'description' => __( 'Define styles for social icons' ),
    'section'     => $section,
    'default'     => array(
        'font-size'      => ' ',
        'line-height'    => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'icon_settings_bg',
	'section'     => $section,
	'priority'    => 1,
	'choices'     => array(
        'background'  => esc_attr__( 'Background Color', 'hiiwp' ),
    ),
    'default'     => array(
        'background'    => '',
    ),
) );
Kirki::add_field( 'my_config', array(
	'type'        => 'dimension',
	'settings'    => 'icon_settings_border',
	'label'       => __( 'Border Thickness', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '0',
	'priority'    => 1,
) );
Kirki::add_field( 'my_config', array(
	'type'        => 'dimension',
	'settings'    => 'icon_settings_border_r',
	'label'       => __( 'Border Radius', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '0',
	'priority'    => 1,
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

Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_icon_custom_css',
	'label'       => __( 'Icon Custom CSS', 'my_textdomain' ),
	'description' => __( 'Custom style all font-awesome icons', 'textdomain' ),
	'section'     => $section,
	'default'     => '.fa-style-round {
	background: '.get_theme_mod( 'color_one', '#ef5022').';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	color: white;
	font-size: 1em;
	line-height: 1.6em;
	border-radius: 2em;
}
.fa-style-square {
	background: '.get_theme_mod( 'color_one', '#ef5022').';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	color: white;
	font-size: 1em;
	line-height: 1.6em;
	border-radius: 0.2em;
}
.fa-style-circle {
	color: '.get_theme_mod( 'color_one', '#ef5022').';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	line-height: 1.6em;
	font-size: 1em;
	background: none;
	border-radius: 2em;
	border:1px solid '.get_theme_mod( 'color_one', '#ef5022').';
}
.fa-style-no-bg {
	color: '.get_theme_mod( 'color_one', '#ef5022').';
	font-size:1.6em;
	display: inline-block;
	width: 1.6em;
	text-align: center;
	line-height: 1.6em;
	border: none;
	background: none;
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
	'section'     => $section,
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
	'section'     => $section,
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
?>