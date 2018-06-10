<?php
$section = 'typography_page_title_section';


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'title_font',
    'label'       => esc_attr__( 'Title Style', 'hiiwp' ),
    'description' => __( 'Define styles for page title', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['title_font'],
    'transport'       => 'refresh',
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'show_page_titles',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.page-title',
		),
	),
) );
?>