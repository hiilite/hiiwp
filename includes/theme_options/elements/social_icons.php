<?php
/**
 * HiiWP: Social-Icon Settings
 *
 * Adds the customizer settings for the Social Icons widget section
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.1
 */
$section = 'typography_social_icons_section';
Kirki::add_section( $section, array(
    'priority'    => 2,
    'title'       => __( 'Social Icons', 'hiiwp' ),
    'panel'		 => 'elements_panel',
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'social_icon_settings',
    'label'       => esc_attr__( 'Icon Color', 'hiiwp' ),
    'description' => __( 'Define color for the social icons widget', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['social_icon_settings'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'social_icon_settings_bg',
	'label'		  => 'Social Icon Background',
	'section'     => $section,
	'priority'    => 1,
	'choices'     => array(
        'background'  => esc_attr__( 'Background Color', 'hiiwp' ),
    ),
    'default'     => $hiilite_options['social_icon_settings_bg'],
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'social_icon_settings_border',
	'label'       => __( 'Border Thickness', 'hiiwp' ),
	'section'     => $section,
	'default'     => '0',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'social_icon_settings_border_r',
	'label'       => __( 'Border Radius', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['social_icon_settings_border_r'],
	'priority'    => 1,
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_social_icon_custom_css',
	'label'       => __( 'Icon Custom CSS', 'hiiwp' ),
	'description' => __( 'Custom style all font-awesome icons', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_social_icon_custom_css'],
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '500',
	),
) );	
