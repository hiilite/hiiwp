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

