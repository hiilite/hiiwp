<?php
$section = 'header_header_top_section';

Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Header Top', 'hiiwp' ),
    'description' => __( 'Header Top settings', 'hiiwp' ),
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
    'active_callback'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

/*
Header Top	 
*/
Kirki::add_field( 'hiiwp', array(
	'type'        => 'typography',
	'settings'    => 'header_top_font',
	'label'       => __( 'Header Top Font', 'hiiwp' ),
	'description' => __('Define styles for Header Top area', 'hiiwp'),
	'section'     => $section,
	'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'text-transform' => 'none',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => ' ',
    ),
	'priority'    => 6,
	'required'	  => array(
		array(
		    'setting'  => 'header_top_area_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'header_top_colors',
    'label'       => __( 'Link Colors', 'hiiwp' ),
    'description' => __('Header Top link colors', 'hiiwp'),
    'section'     => $section,
    'priority'    => 7,
    'choices'     => array(
	    'link'   => esc_attr__( 'Link Color', 'hiiwp' ),
        'hover'   => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
    'default'     => $hiilite_options['header_top_colors'],
    'active_callback'	  => array(
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
	'description' => __('Choose a background color for Header Top area', 'hiiwp'),
	'section'     => $section,
	'default'     => $hiilite_options['header_top_background_color'],
	'choices' 	  => array('alpha'),
	'priority'    => 7,
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
    'description' => __('Define bottom border color for Header Top', 'hiiwp'),
    'section'     => $section,
    'priority'    => 7,
    'default'     => '',
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
	'label'       => __( 'Header Top Padding', 'hiiwp' ),
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
			'element'  => '#header_top .in_grid',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_top .in_grid',
			'property' => 'padding',
		),
	),
) );