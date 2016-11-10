<?php
$section = 'header_header_section';

Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Header', 'textdomain' ),
    'description' => __( 'Header settings', 'textdomain' ),
    'panel'		 => 'header_panel',
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_in_grid',
    'label'       => __( 'Header in Grid', 'hiiwp' ),
    'description' => __('Enabling this option will display header content in grid'),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );

// header_type
Kirki::add_field( 'hiiwp', array(
	'type'        => 'select',
    'settings'    => 'header_type',
    'label'       => __( 'Type of header', 'hiiwp' ),
    'description' => __('Choose the header layout & behavior'),
    'section'     => $section,
    'default'     => 'regular',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'regular' => esc_attr__( 'Regular', 'hiiwp' ),
        'centered' => esc_attr__( 'Centered', 'hiiwp' ),
        'fixed' => esc_attr__( 'Fixed', 'hiiwp' ),
    ),
) );
/*
Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'header_height',
    'label'       => __( 'Header Height', 'hiiwp' ),
    'description' => __('Enter header height in pixels'),
    'section'     => $section,
    'default'     => '100px',
    'priority'    => 1,
) );
*/




Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'header_background',
    'label'       => __( 'Header Background Color', 'hiiwp' ),
    'description' => __('Choose a background color for header area'),
    'section'     => $section,
    'priority'    => 2,
    'default'     => '#fff',
    'alpha'		  => true,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => 'header#main_header',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => 'header#main_header',
			'property' => 'background-color',
		),
	),
) );	


// BORDER TOP
Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'header_top_border_width',
    'label'       => __( 'Header Top Border Thickness', 'hiiwp' ),
    'section'     => $section,
    'default'     => '0px',
    'priority'    => 4,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-top-width',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-top-width',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'header_top_border_color',
    'label'       => __( 'Header Top Border Color', 'hiiwp' ),
    'description'       => __( 'Choose a color for the header top border. Note: If color has not been chosen, border bottom will not be displayed', 'hiiwp' ),
    'section'     => $section,
    'default'     => '',
    'priority'    => 4,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-top-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_top',
			'property' => 'border-top-color',
		),
	),
) );



// Border Bottom
Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'header_bottom_border_width',
    'label'       => __( 'Header Bottom Border Thickness', 'hiiwp' ),
    'section'     => $section,
    'default'     => '0px',
    'priority'    => 4,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#header_bottom',
			'property' => 'border-bottom-width',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_bottom',
			'property' => 'border-bottom-width',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'header_bottom_border_color',
    'label'       => __( 'Header Bottom Border Color', 'hiiwp' ),
    'description' => __('Choose a color for the header bottom border. Note: If color has not been chosen, border bottom will not be displayed'),
    'section'     => $section,
    'priority'    => 4,
    'default'     => '',
    'alpha'		  => true,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#header_bottom',
			'property' => 'border-bottom-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_bottom',
			'property' => 'border-bottom-color',
		),
	),
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_center_left_on',
    'label'       => __( 'Header Center Left (beta)', 'hiiwp' ),
    'description'  => __( 'Add elements through the Widget panel', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 8,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_center_right_on',
    'label'       => __( 'Header Center Right (beta)', 'hiiwp' ),
    'description'  => __( 'Add elements through the Widget panel', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_bottom_on',
    'label'       => __( 'Header Bottom (beta)', 'hiiwp' ),
    'description'  => __( 'Add elements through the Widget panel', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'header_bottom_background',
    'label'       => __( 'Header Bottom Background Color', 'hiiwp' ),
    'description' => __('Choose a background color for bottom header area'),
    'section'     => $section,
    'priority'    => 8,
    'default'     => '#fff',
    'alpha'		  => true,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#header_bottom',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#header_bottom',
			'property' => 'background-color',
		),
	),
	'required'	  => array(
		array(
		    'setting'  => 'header_bottom_on',
			'operator' => '==',
			'value'    => true,
	    )),
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_top_home',
    'label'       => __( 'Header Home Top (beta)', 'hiiwp' ),
    'description'  => __( 'Adds content above the header, but only on the home page', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 9,
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'header_top_home_content',
	'label'       => __( 'Content Above Home Header (beta)', 'hiiwp' ),
	'description'  => __( 'Adds content above the header, but only on the home page', 'hiiwp' ),
	'section'     => $section,
	'default'     => false,
	'priority'    => 9,
	'required'	  => array(
		array(
		    'setting'  => 'header_top_home',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'header_top_pages_background',
    'label'       => __( 'Background Above Header (beta)', 'hiiwp' ),
    'description'  => __( 'Fallback image for all pages except home', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 9,
    'default'     => array(
		'color'    => '#ffffff',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
	),
	'required'	  => array(
		array(
		    'setting'  => 'header_top_home',
			'operator' => '==',
			'value'    => true,
	    )),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'header_top_pages_height',
    'label'       => __( 'Above Header Height (beta)', 'hiiwp' ),
    'description'  => __( 'Height of above header image in all pages except home', 'hiiwp' ),
    'section'     => $section,
    'default'     => '100px',
    'priority'    => 9,
	'required'	  => array(
		array(
		    'setting'  => 'header_top_home',
			'operator' => '==',
			'value'    => true,
	    )),
) );
?>