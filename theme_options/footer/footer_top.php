<?php
$section = 'footer_top_section';
/*

	FOOTER TOP

*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'show_footer_top_yesno',
    'label'       => __( 'Show Footer Top', 'hiiwp' ),
    'description' => __('Enabling this option will show Footer Top area', 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['show_footer_top_yesno'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_in_grid',
    'label'       => __( 'Footer in Grid', 'hiiwp' ),
    'description' => __('Enabling this option will place Footer Top content in grid', 'hiiwp'),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'multicheck',
    'settings'    => 'footer_top_columns',
    'label'       => __( 'Footer Top Columns', 'hiiwp' ),
    'description'  => __( 'Choose which columns show for Footer top area', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options[ 'footer_top_columns' ],
    'priority'    => 6,
    'choices'     => array(
		'footer_column_1' => esc_attr__( 'Column 1', 'hiiwp' ),
		'footer_column_2' => esc_attr__( 'Column 2', 'hiiwp' ),
		'footer_column_3' => esc_attr__( 'Column 3', 'hiiwp' ),
		'footer_column_4' => esc_attr__( 'Column 4', 'hiiwp' ),
	),
    'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'footer_top_colors',
    'label'       => __( 'Footer Top Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 6,
    'choices'     => array(
        'title'    => esc_attr__( 'Title', 'hiiwp' ),
        'text'   => esc_attr__( 'Text', 'hiiwp' ),
        'link'  => esc_attr__( 'Link', 'hiiwp' ),
        'hover'  => esc_attr__( 'Link Hover', 'hiiwp' ),
    ),
    'default'     => array(
        'title'    => '',
        'text'   => '',
        'link'  => '',
        'hover'  => '',
    ),
	'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'footer_top_background',
    'label'       => __( 'Footer Top Background', 'hiiwp' ),
    'description' => __('Choose footer top background image and color', 'hiiwp'),
    'section'     => $section,
    'priority'    => 6,
    'default'     => array(
		'color'    => ' ',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );



Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'footer_top_padding',
	'label'       => __( 'Footer Top Padding', 'hiiwp' ),
	'description' => __('Set padding for footer top section', 'hiiwp'),
	'section'     => $section,
	'default'     => $hiilite_options['footer_padding'],
	'priority'    => 6,
	'transport'   => 'postMessage',
    'required'	  => array(
		array(
		    'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
    'output' => array(
		array(
			'element'  => '#footer_top',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_top',
			'property' => 'padding',
		),
	),
) );