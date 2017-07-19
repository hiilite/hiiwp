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
	
?>