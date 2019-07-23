<?php
/**
 * HiiWP: Back To Top button Settings
 *
 * Adds the customizer settings for the Back To Top button
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.2
 */
 
$section = 'back_to_top_section';
Kirki::add_section( $section, array(
    'priority'    => 3,
    'title'       => __( 'Back To Top', 'hiiwp' ),
    'panel'		 => 'elements_panel',
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'btt_yesno',
    'label'       => __( 'Show Back To Top Button', 'hiiwp' ),
    'description'  => __( 'Enabling this option will show a back to top button at the bottom of all pages', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['btt_yesno'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'fontawesome',
	'settings'    => 'btt_icon_style',
	'label'       => __( 'Icon Style', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_icon_style'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'btt_icon_size',
	'label'       => __( 'Icon Size', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_icon_size'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'btt_icon_padding',
	'label'       => __( 'Icon Padding', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_icon_padding'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'btt_icon_color',
	'label'		  => __( 'Icon Color', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_icon_color'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'btt_background_color',
	'label'		  => __( 'Background Color', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_background_color'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );




Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'btt_border_color',
	'label'		  => __( 'Border Color', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_border_color'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'btt_border_size',
	'label'       => __( 'Border Thickness', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_border_size'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'btt_border_radius',
	'label'       => __( 'Border Radius', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['btt_border_radius'],
	'priority'    => 1,
	'required'	  => array(
		array(
		    'setting'  => 'btt_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );