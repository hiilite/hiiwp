<?php
$section = 'typography_social_icons_section';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'icon_settings',
    'label'       => esc_attr__( 'Social Icon Color', 'kirki' ),
    'description' => __( 'Define color for social icons' ),
    'section'     => $section,
    'default'     => $hiilite_options['icon_settings'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'icon_settings_bg',
	'label'		  => 'Social Icon Background',
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
	'settings'    => 'typography_icon_custom_css',
	'label'       => __( 'Icon Custom CSS', 'my_textdomain' ),
	'description' => __( 'Custom style all font-awesome icons', 'textdomain' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_icon_custom_css'],
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '500',
	),
) );	
