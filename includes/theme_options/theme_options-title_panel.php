<?php
$section = 'title_section';

Kirki::add_section( $section, array(
    'priority'    => 5,
    'title'       => __( 'Title', 'hiiwp' ),
    'description' => __( 'Page Title settings', 'hiiwp' ),
    'icon' => 'dashicons-feedback'
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'show_page_titles',
    'label'       => __( 'Show Page Titles', 'hiiwp' ),
    'description'  => __( 'can be overwritten per page', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['show_page_titles'],
    'priority'    => 1,
) );

function add_show_title_on_control() {
	global $hiilite_options;
	
	$post_types = Hii::get_post_types(array(), 'objects');
	$post_types[] = 'blog';
	
	Kirki::add_field( 'hiiwp', array(
	    'type'        => 'multicheck',
	    'settings'    => 'show_title_on',
	    'label'       => __( 'Show Page Title On', 'hiiwp' ),
	    'description'  => __( 'Which post types should the title show on', 'hiiwp' ),
	    'section'     => 'title_section',
	    'priority'    => 1,
	    'default'     => $post_types,
	    'choices'     => $post_types,
	    'active_callback'	=> array(
			array(
				'setting'  => 'show_page_titles',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );
}
add_action( 'init', 'add_show_title_on_control', 100 );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'title_height',
    'label'       => __( 'Title Height', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['title_height'],
    'priority'    => 5,
    'active_callback'	=> array(
		array(
			'setting'  => 'show_page_titles',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'title_padding',
	'label'       => __( 'Title Padding', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['title_padding'],
	'priority'    => 5,
	'active_callback'	=> array(
		array(
			'setting'  => 'show_page_titles',
			'operator' => '==',
			'value'    => true,
		),
	),
) );




Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'title_background',
    'label'       => __( 'Title Background', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 5,
    'default'     => $hiilite_options['title_background'],
	'active_callback'	=> array(
		array(
			'setting'  => 'show_page_titles',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

?>