<?php
Kirki::add_section( 'title_section', array(
    'priority'    => 5,
    'title'       => __( 'Page Titles', 'textdomain' ),
    'description' => __( 'Title settings', 'textdomain' ),
) );

Kirki::add_field( 'show_page_titles', array(
    'type'        => 'switch',
    'settings'    => 'show_page_titles',
    'label'       => __( 'Show page titles', 'my_textdomain' ),
    'description'  => __( 'can be overwritten per page', 'my_textdomain' ),
    'section'     => 'title_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'title_height', array(
    'type'        => 'dimension',
    'settings'    => 'title_height',
    'label'       => __( 'Title Height', 'my_textdomain' ),
    'section'     => 'title_section',
    'default'     => '200px',
    'priority'    => 5,
    'output' => '.page-title',
    'required' => array(
    array(
    	'setting' => 'show_page_titles',
    	'operator' => '==',
    	'value'		=> true,
    	
    )),
) );

	?>