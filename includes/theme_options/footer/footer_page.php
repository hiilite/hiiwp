<?php
$section = 'footer_page_section';

/*
	
	FOOTER PAGE
	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_page_on',
    'label'       => __( 'Use Footer Page (beta)', 'hiiwp' ),
    'description'  => __( 'Enable to use a pages content as the footer', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 7,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'footer_page_content',
	'label'       => __( 'Footer Content Page (beta)', 'hiiwp' ),
	'description'  => __( 'Select the page to use as the footer for the site', 'hiiwp' ),
	'section'     => $section,
	'default'     => false,
	'priority'    => 7,
	'required'	  => array(
		array(
		    'setting'  => 'footer_page_on',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'footer_page_padding',
	'label'       => __( 'Footer Page Padding', 'hiiwp' ),
	'description' => __('Set padding for footer page section', 'hiiwp'),
	'section'     => $section,
	'default'     => array(
		'top'    => '1em',
		'bottom' => '1em',
	),
	'priority'    => 8,
	'required'	  => array(
		array(
			'setting'  => 'footer_page_on',
			'operator' => '==',
			'value'    => true,
	)),
	'transport'   => 'postMessage',
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
    'output' => array(
		array(
			'element'  => '#footer_page',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_page',
			'property' => 'padding',
		),
	),
) );