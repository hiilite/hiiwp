<?php
Kirki::add_section( 'footer_section', array(
    'priority'    => 5,
    'title'       => __( 'Footer', 'textdomain' ),
    'description' => __( 'footer settings', 'textdomain' ),
) );


Kirki::add_field( 'footer_in_grid', array(
    'type'        => 'switch',
    'settings'    => 'footer_in_grid',
    'label'       => __( 'Footer in Grid', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'footer_background', array(
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
	'output' => 'footer#main_footer',
) );



Kirki::add_field( 'footer_top_col1', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col1',
    'label'       => __( 'Footer Column 1', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );
Kirki::add_field( 'footer_top_col2', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col2',
    'label'       => __( 'Footer Column 2', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );
Kirki::add_field( 'footer_top_col3', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col3',
    'label'       => __( 'Footer Column 3', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );
Kirki::add_field( 'footer_top_col4', array(
    'type'        => 'switch',
    'settings'    => 'footer_top_col4',
    'label'       => __( 'Footer Column 4', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 6,
) );



Kirki::add_field( 'footer_bottom_background_color', array(
    'type'        => 'color',
    'settings'    => 'footer_bottom_background_color',
    'label'       => __( 'Footer Bottom Background Color', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => 'color_one',
    'priority'    => 8,
    'default'	 => '#c8c8c8',
   
) );

Kirki::add_field( 'footer_bottom_center', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_center',
    'label'       => __( 'Footer Bottom Center', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => true,
    'priority'    => 8,
) );

Kirki::add_field( 'footer_bottom_left', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_left',
    'label'       => __( 'Footer Bottom Left', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => false,
    'priority'    => 8,
) );

Kirki::add_field( 'footer_bottom_right', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_right',
    'label'       => __( 'Footer Bottom Right', 'my_textdomain' ),
    'description'  => __( 'Add elements through the Widget panel', 'my_textdomain' ),
    'section'     => 'footer_section',
    'default'     => false,
    'priority'    => 8,
) );

	?>