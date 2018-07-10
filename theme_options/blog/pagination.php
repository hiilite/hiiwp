<?php
$section = 'pagination_section';
//////////////////////
//
//	BLOG SECTIONS
//
//////////////////////	
Kirki::add_section( $section, array(
    'priority'    => 3,
    'title'       => __( 'Pagination', 'hiiwp' ),
    'description' => __( 'Pagination styles', 'hiiwp' ),
    'panel'       => 'blog_panel',
) );

//////////////////////
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_pag_show',
    'label'       => __( 'Pagination', 'hiiwp' ),
    'description' => __('Enabling this option will display pagination on bottom of Blog List','hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['blog_pag_show'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'select',
    'settings'    => 'blog_pag_style',
    'label'       => __( 'Pagination Type', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_pag_style'],
    'choices'	  => array(
	    'option-1' => esc_attr__( 'Prev/Next', 'hiiwp'),
	    'option-2' => esc_attr__( 'Numbered', 'hiiwp'),
    ),
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'blog_pag_show',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'pagination_active_page_color',
	'label'       => __( 'Pagination Active Number and Hover Color', 'hiiwp' ),
	'description' => esc_attr__( 'This controls the active pagination page number and pagination hover color.', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['pagination_active_page_color'],
	'choices'     => array(
		'alpha' => true,
	),
	'output'	  => array(
		array(
			'element'	=> '.num-pagination li a:hover, .num-pagination li.active a',
			'property'	=> 'background-color',
		)  
    ),
    'active_callback'	=> array(
		array(
			'setting'  => 'blog_pag_style',
			'operator' => '==',
			'value'    => 'option-2',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'pagination_non_active_page_color',
	'label'       => __( 'Pagination Non-Active Number and Hover Color', 'hiiwp' ),
	'description' => esc_attr__( 'This controls the non-active pagination page numbers', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['pagination_non_active_page_color'],
	'choices'     => array(
		'alpha' => true,
	),
	'output'	  => array(
		array(
			'element'	=> '.num-pagination li a, .num-pagination li a:hover, .num-pagination li.active a, .num-pagination li.disabled',
			'property'	=> 'background-color',
		)  
    ),
    'active_callback'	=> array(
		array(
			'setting'  => 'blog_pag_style',
			'operator' => '==',
			'value'    => 'option-2',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'pagination_text_color',
	'label'       => __( 'Pagination Text Color', 'hiiwp' ),
	'description' => esc_attr__( 'This controls the pagination text color', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['pagination_text_color'],
	'choices'     => array(
		'alpha' => true,
	),
	'output'	  => array(
		array(
			'element'	=> '.num-pagination li a, .num-pagination li a:hover, .num-pagination li.active a, .num-pagination li.disabled ',
			'property'	=> 'color',
		)  
    ),
    'active_callback'	=> array(
		array(
			'setting'  => 'blog_pag_style',
			'operator' => '==',
			'value'    => 'option-2',
		),
	),
) );
?>