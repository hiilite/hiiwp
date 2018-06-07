<?php $section = 'footer_section';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_headings_font',
    'label'       => esc_attr__( 'Footer Headings Font', 'hiiwp' ),
    'description' => __('Define styles for footer widget title', 'hiiwp'),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_text_font',
    'label'       => esc_attr__( 'Footer Text Font', 'hiiwp' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_links_font',
    'label'       => esc_attr__( 'Footer Links Font', 'hiiwp' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ),
    'priority'    => 1,
) );	

	
Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'footer_background',
    'label'       => __( 'Footer Background', 'hiiwp' ),
    'description' => __('Choose a background image and color for the entire footer.', 'hiiwp'),    
    'section'     => $section,
    'priority'    => 1,
    'default'     => array(
		'background-color'    => ' ',
		'background-image'    => '',
		'background-repeat'   => 'no-repeat',
		'background-size'     => 'cover',
		'background-attachment'   => 'scroll',
		'background-position' => 'left-top',
	),
) );
// Footer  order Top
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'footer_border_color',
    'label'       => __( 'Footer Border Top Color', 'hiiwp' ),
    'description' => __('Define top border color for Footer Top', 'hiiwp'),
    'section'     => $section,
    'priority'    => 1,
    'default'     => $hiilite_options['footer_top_border_color'],
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-color',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'footer_border_weight',
    'label'       => __( 'Footer Border Top Thickness', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['footer_top_border_width'],
    'priority'    => 1,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-width',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-width',
		),
	),
) );