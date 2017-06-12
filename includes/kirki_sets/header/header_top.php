<?php
$section = 'header_header_top_section';

Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Header Top', 'textdomain' ),
    'description' => __( 'Header Top settings', 'textdomain' ),
    'panel'		 => 'header_panel',
) );




/*

*/

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_top_area_yesno',
    'label'       => __( 'Show Header Top Area', 'hiiwp' ),
    'description'  => __( 'Enabling this option will show Header Top area (this setting applies to Header Left and Header Right widgets)', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['header_top_area_yesno'],
    'priority'    => 6,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'hide_top_bar_on_mobile_yesno',
    'label'       => __( 'Hide Top Bar on Mobile Header', 'hiiwp' ),
    'description'  => __( 'Enabling this option you will hide top header area when mobile header is active', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 6,
    'required'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'header_top_background_color',
	'label'       => __( 'Header Top Background Color', 'hiiwp' ),
	'description' => __('Choose a background color for Header Top area'),
	'section'     => $section,
	'default'     => '#f8f8f8',
	'priority'    => 7,
	'alpha'       => true,
	'required'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
	'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#header_top',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_top',
			'property' => 'background-color',
		),
	),
) );

// Header Top Border Bottom
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'top_header_border_color',
    'label'       => __( 'Header Top Bottom Border Color', 'hiiwp' ),
    'description' => __('Define bottom border color for Header Top'),
    'section'     => $section,
    'priority'    => 7,
    'default'     => '',
    'alpha'		  => true,
    'required'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-bottom-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-bottom-color',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'top_header_border_weight',
    'label'       => __( 'Header Top Bottom Border Thickness', 'hiiwp' ),
    'section'     => $section,
    'default'     => '0px',
    'priority'    => 7,
    'transport'   => 'postMessage',
    'required'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
    'output' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-bottom-width',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-bottom-width',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'top_header_area_padding',
	'label'       => __( 'Header Top Padding', 'my_textdomain' ),
	'section'     => $section,
	'default'     => array(
		'top'    => '0.5em',
		'right'  => '1em',
		'bottom' => '0.5em',
		'left'   => '1em',
	),
	'priority'    => 7,
	'transport'   => 'postMessage',
    'required'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
    'output' => array(
		array(
			'element'  => '#header_top',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_top',
			'property' => 'padding',
		),
	),
) );