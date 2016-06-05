<?php
Kirki::add_section( 'footer_section', array(
    'priority'    => 5,
    'title'       => __( 'Footer', 'textdomain' ),
    'description' => __( 'footer settings', 'textdomain' ),
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_in_grid',
    'label'       => __( 'Footer in Grid', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'footer_background',
    'label'       => __( 'Footer Background', 'my_textdomain' ),
    'section'     => 'footer_section',
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
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col1',
    'label'       => __( 'Footer Column 1', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col2',
    'label'       => __( 'Footer Column 2', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col3',
    'label'       => __( 'Footer Column 3', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col4',
    'label'       => __( 'Footer Column 4', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'footer_bottom_background_color',
    'label'       => __( 'Footer Bottom Background Color', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => 'color_one',
    'priority'    => 8,
    'default'	 => '#c8c8c8',
   
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_center',
    'label'       => __( 'Footer Bottom Center', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_left',
    'label'       => __( 'Footer Bottom Left', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => false,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_right',
    'label'       => __( 'Footer Bottom Right', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => false,
    'priority'    => 8,
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_page_on',
    'label'       => __( 'Use Footer Page', 'my_textdomain' ),
    'description'  => __( 'Enable to use a pages content as the footer', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => false,
    'priority'    => 9,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'footer_page_content',
	'label'       => __( 'Footer Content Page', 'my_textdomain' ),
	'description'  => __( 'Select the page to use as the footer for the site', 'my_textdomain' ),
	'section'     => 'footer_section',
	'default'     => false,
	'priority'    => 9,
	'required'	  => array(
		array(
		    'setting'  => 'footer_page_on',
			'operator' => '==',
			'value'    => true,
	    )),
) );

	?>