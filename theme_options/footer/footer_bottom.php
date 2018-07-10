<?php
$section = 'footer_bottom_section';
/*
	
	FOOTER BOTTOM
	
*/

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_text_yesno',
    'label'       => __( 'Show Footer Bottom', 'hiiwp' ),
    'description'  => __( 'Enabling this option will show Footer Bottom area', 'hiiwp' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_footer_bottom_text_font',
    'label'       => esc_attr__( 'Footer Bottom Text Font', 'hiiwp' ),
    'section'     => $section,
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'			=> ' ',
    ),
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_in_grid',
    'label'       => __( 'Footer Bottom in Grid', 'hiiwp' ),
    'description' => __('Enabling this option will place Footer bottom content in grid', 'hiiwp'),
    'section'     => $section,
    'default'     => false,
    'priority'    => 8,
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'multicheck',
    'settings'    => 'footer_bottom_columns',
    'label'       => __( 'Footer Bottom Columns', 'hiiwp' ),
    'description'  => __( 'Choose which columns show for Footer Bottom area', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 8,
    'choices'     => array(
		'footer_bottom_left' => esc_attr__( 'Left', 'hiiwp' ),
		'footer_bottom_center' => esc_attr__( 'Center', 'hiiwp' ),
		'footer_bottom_right' => esc_attr__( 'Right', 'hiiwp' ),
	),
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'footer_bottom_colors',
    'label'       => __( 'Footer Bottom Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 8,
    'choices'     => array(
        'text'   => esc_attr__( 'Text', 'hiiwp' ),
        'link'  => esc_attr__( 'Link', 'hiiwp' ),
        'hover'  => esc_attr__( 'Link Hover', 'hiiwp' ),
    ),
    'default'     => array(
        'text'   => '',
        'link'  => '',
        'hover'  => '',
    ),
	'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'footer_bottom_background_color',
    'label'       => __( 'Footer Bottom Background Color', 'hiiwp' ),
    'section'     => $section,
    'default'     => 'color_one',
    'priority'    => 8,
    'default'	 => ' ',
   'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'background-color',
		),
	),
) );

// Footer border Top
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'footer_bottom_border_color',
    'label'       => __( 'Footer Bottom Border Color', 'hiiwp' ),
    'description' => __('Define top border color for Footer Bottom', 'hiiwp'),
    'section'     => $section,
    'priority'    => 8,
    'default'     => '',
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-color',
		),
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'footer_bottom_border_weight',
    'label'       => __( 'Footer Bottom Border Thickness', 'hiiwp' ),
    'section'     => $section,
    'default'     => '0px',
    'priority'    => 8,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-width',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-width',
		),
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'footer_bottom_padding',
	'label'       => __( 'Footer Bottom Padding', 'hiiwp' ),
	'description' => __('Set padding for footer bottom section', 'hiiwp'),
	'section'     => $section,
	'default'     => array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	),
	'priority'    => 8,
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
			'element'  => '#footer_bottom',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'padding',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'textarea',
	'settings'    => 'footer_bottom_copyright_text',
	'label'       => __( 'Copyright Text', 'hiiwp' ),
	'description' => __('Change the copy right text in the footer bottom', 'hiiwp'),
	'section'     => $section,
	'default'     => $hiilite_options['footer_bottom_copyright_text'],
	'priority'    => 8,
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

