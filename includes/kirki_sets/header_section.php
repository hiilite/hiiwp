<?php
Kirki::add_section( 'header_section', array(
    'priority'    => 3,
    'title'       => __( 'Header', 'textdomain' ),
    'description' => __( 'header settings', 'textdomain' ),
) );

// header_type
Kirki::add_field( 'hiiwp', array(
	'type'        => 'select',
    'settings'    => 'header_type',
    'label'       => __( 'Type of header', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => 'regular',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'regular' => esc_attr__( 'Regular', 'my_textdomain' ),
        'centered' => esc_attr__( 'Centered', 'my_textdomain' ),
        'fixed' => esc_attr__( 'Fixed', 'my_textdomain' ),
    ),
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_above_content',
    'label'       => __( 'Content Below Header', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_in_grid',
    'label'       => __( 'Header in Grid', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'header_background',
    'label'       => __( 'Header Background', 'my_textdomain' ),
    'section'     => 'header_section',
    'priority'    => 2,
    'default'     => array(
		'color'    => '#ffffff',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
		'opacity'  => 90,
	),
	'output' => 'header#main_header',
	'active_callback' => array(
    	array(
	    	'setting'  => 'header_above_content',
			'operator' => '==',
			'value'    => true,
    	)
    ),
) );

/*
Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'header_height',
    'label'       => __( 'Header Height', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => '100px',
    'priority'    => 3,
) );
*/

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'header_top_border_width',
    'label'       => __( 'Header Top Border Thickness', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => '0',
    'priority'    => 4,
    'output' => '#header_top',
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'header_top_border_color',
    'label'       => __( 'Header Top Border Color', 'my_textdomain' ),
    'description'       => __( 'Select your color palette under General > Color Palette, the refresh the page', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => '#ef5022',
    'priority'    => 5,
    'required'	  => array(array(
	    'setting'  => 'header_top_border_width',
		'operator' => '!=',
		'value'    => '0px',
    )),
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_top_left',
    'label'       => __( 'Header Top Left', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => false,
    'priority'    => 6,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_top_right',
    'label'       => __( 'Header Top Right', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => false,
    'priority'    => 7,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'header_top_background_color',
	'label'       => __( 'Header Top Background Color', 'my_textdomain' ),
	'section'     => 'header_section',
	'default'     => '#f8f8f8',
	'priority'    => 7,
	'alpha'       => true,
	'required'	  => array(
		array(
		    'setting'  => 'header_top_left',
			'operator' => '==',
			'value'    => true,
	    )),
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_center_left_on',
    'label'       => __( 'Header Center Left', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => false,
    'priority'    => 8,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_center_right_on',
    'label'       => __( 'Header Center Right', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => false,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_bottom_on',
    'label'       => __( 'Header Bottom', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => false,
    'priority'    => 8,
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'header_top_home',
    'label'       => __( 'Header Home Top', 'my_textdomain' ),
    'description'  => __( 'Adds content above the header, but only on the home page', 'my_textdomain' ),
    'section'     => 'header_section',
    'default'     => false,
    'priority'    => 9,
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'header_top_home_content',
	'label'       => __( 'Content Above Home Header', 'my_textdomain' ),
	'description'  => __( 'Adds content above the header, but only on the home page', 'my_textdomain' ),
	'section'     => 'header_section',
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
    'label'       => __( 'Background Above Header', 'my_textdomain' ),
    'description'  => __( 'Fallback image for all pages except home', 'my_textdomain' ),
    'section'     => 'header_section',
    'priority'    => 9,
    'default'     => array(
		'color'    => '#ffffff',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
		'opacity'  => 100,
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
    'label'       => __( 'Above Header Height', 'my_textdomain' ),
    'description'  => __( 'Height of above header image in all pages except home', 'my_textdomain' ),
    'section'     => 'header_section',
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