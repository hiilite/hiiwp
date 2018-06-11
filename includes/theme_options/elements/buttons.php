<?php
$section = 'elements_button_section';

Kirki::add_section( $section, array(
    'priority'    => 6,
    'title'       => __( 'Buttons', 'hiiwp' ),
    'panel'		 => 'elements_panel',
) );
/*
*
*	BUTTONS
*	
*/

/*
*
*	DEFAULT BUTTONS
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'custom',
    'settings'    => 'button_default_separator',
    'section'     => $section,
    'label'		  => '',
    'default'     => '<h1>Default Button</h1>',
    'priority'    => 1,
    
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_default_font',
    'label'       => esc_attr__( 'Default Button Font (.button)', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_button_default_font'], 
    'priority'    => 1,
    'output'	  => array(
	    array(
			'element'	=> '.button',
		) 
    )
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_default_hover_color',
	'label'       => __( 'Hover Color (.button)', 'hiiwp' ),
	'section'     => $section,
    'default'     => $hiilite_options['typography_button_default_hover_color'],
	'priority'    => 1,
	'output'	  => array(
	    array(
			'element'	=> '.button:hover',
			'property'	=> 'color'
		) 
    )
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'typography_button_default_background',
	'label'       => __( 'Background Color (.button)', 'hiiwp' ),
	'section'     => $section,
	'choices'     => array(
        'base'  => esc_attr__( 'Base Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
    'default'     => $hiilite_options['typography_button_default_background'],
	'priority'    => 1
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'typography_button_default_border_color',
	'label'       => __( 'Border Color (.button)', 'hiiwp' ),
	'section'     => $section,
	'choices'     => array(
        'base'  => esc_attr__( 'Base Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
    'alpha' 	  => true,
	'default'     => $hiilite_options['typography_button_default_border_color'],
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_default_padding',
	'label'       => __( 'Button Padding (.button)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_default_padding'],
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_default_border_width',
	'label'       => __( 'Border Width (.button)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_default_border_width'],
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_default_border_radius',
	'label'       => __( 'Border Radius (.button)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_default_border_radius'],
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_custom_css',
	'label'       => __( 'Button Custom CSS (.button)', 'hiiwp' ),
	'description' => __( 'Custom style for standard buttons across the site', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_custom_css'],
	'priority'    => 1,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );



/*
*
*	PRIMARY BUTTONS
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'custom',
    'settings'    => 'button_primary_separator',
    'section'     => $section,
    'label'		  => '',
    'default'     => '<hr><h1>Primary Button</h1>',
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_primary_font',
    'label'       => esc_attr__( 'Primary Button Font (.button-primary)', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_button_primary_font'], 
    'priority'    => 2,
    'output'	  => array(
	    array(
			'element'	=> '.button-primary',
		) 
    )
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_primary_hover_color',
	'label'       => __( 'Hover Color (.button-primary)', 'hiiwp' ),
	'section'     => $section,
    'default'     => $hiilite_options['typography_button_primary_hover_color'],
	'priority'    => 2,
	'output'	  => array(
	    array(
			'element'	=> '.button-primary:hover',
			'property'	=> 'color'
		) 
    )
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'typography_button_primary_background',
	'label'       => __( 'Background Color (.button-primary)', 'hiiwp' ),
	'section'     => $section,
	'choices'     => array(
        'base'  => esc_attr__( 'Base Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
	'default'     => $hiilite_options['typography_button_primary_background'],
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'typography_button_primary_border_color',
	'label'       => __( 'Border Color (.button-primary)', 'hiiwp' ),
	'section'     => $section,
	'choices'     => array(
        'base'  => esc_attr__( 'Base Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
	'default'     => $hiilite_options['typography_button_primary_border_color'],
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_primary_padding',
	'label'       => __( 'Button Padding (.button-primary)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_primary_padding'],
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_primary_border_width',
	'label'       => __( 'Border Width (.button-primary)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_primary_border_width'],
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_primary_border_radius',
	'label'       => __( 'Border Radius (.button-primary)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_primary_border_radius'],
	'priority'    => 2,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_primary_custom_css',
	'label'       => __( 'Button Custom CSS (.button-primary)', 'hiiwp' ),
	'description' => __( 'Custom style for standard buttons across the site', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_primary_custom_css'],
	'priority'    => 2,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );

/*
*
*	SECONDARY BUTTONS
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'custom',
    'settings'    => 'button_secondary_separator',
    'section'     => $section,
    'label'		  => '',
    'default'     => '<hr><h1>Secondary Button</h1>',
    'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'typography_button_secondary_font',
    'label'       => esc_attr__( 'Secondary Button Font (.button-secondary)', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['typography_button_secondary_font'], 
    'priority'    => 3,
    'output'	  => array(
	    array(
			'element'	=> '.button-secondary',
		) 
    )
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'typography_button_secondary_hover_color',
	'label'       => __( 'Hover Color (.button-secondary)', 'hiiwp' ),
	'section'     => $section,
    'default'     => $hiilite_options['typography_button_secondary_hover_color'],
	'priority'    => 3,
	'output'	  => array(
	    array(
			'element'	=> '.button-secondary:hover',
			'property'	=> 'color'
		) 
    )
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'typography_button_secondary_background',
	'label'       => __( 'Background Color (.button-secondary)', 'hiiwp' ),
	'section'     => $section,
	'choices'     => array(
        'base'  => esc_attr__( 'Base Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
	'default'     => $hiilite_options['typography_button_secondary_background'],
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
	'settings'    => 'typography_button_secondary_border_color',
	'label'       => __( 'Border Color (.button-secondary)', 'hiiwp' ),
	'section'     => $section,
	'choices'     => array(
        'base'  => esc_attr__( 'Base Color', 'hiiwp' ),
        'hover'  => esc_attr__( 'Hover Color', 'hiiwp' ),
    ),
	'default'     => $hiilite_options['typography_button_secondary_border_color'],
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'typography_button_secondary_padding',
	'label'       => __( 'Button Padding (.button-secondary)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_secondary_padding'],
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_secondary_border_width',
	'label'       => __( 'Border Width (.button-secondary)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_secondary_border_width'],
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'typography_button_secondary_border_radius',
	'label'       => __( 'Border Radius (.button-secondary)', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_secondary_border_radius'],
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'code',
	'settings'    => 'typography_button_secondary_custom_css',
	'label'       => __( 'Button Custom CSS (.button-secondary)', 'hiiwp' ),
	'description' => __( 'Custom style for standard buttons across the site', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['typography_button_secondary_custom_css'],
	'priority'    => 3,
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => '100',
	),
) );	
?>