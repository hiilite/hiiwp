<?php
	Kirki::add_section( 'logo_section', array(
    'priority'    => 2,
    'title'       => __( 'Logo', 'textdomain' ),
    'description' => __( 'Global settings', 'textdomain' ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'image',
	'settings'    => 'main_logo',
	'label'       => __( 'Main Logo', 'my_textdomain' ),
	'description' => __( 'This is the control description', 'my_textdomain' ),
	'section'     => 'logo_section',
	'default'     => get_template_directory_uri().'/images/logoNormal@2x.png',
	'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'slider',
	'settings'    => 'logo_size_mod',
	'label'       => esc_attr__( 'A percentage that the logo should be scaled too', 'my_textdomain' ),
	'section'     => 'logo_section',
	'default'     => 100,
	'priority'    => 2,
	'choices'     => array(
		'min'  => '0',
		'max'  => '200',
		'step' => '1',
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'image',
	'settings'    => 'favicon',
	'label'       => __( 'Favicon', 'my_textdomain' ),
	'description' => __( 'Ideally use square images around 64x64', 'my_textdomain' ),
	'section'     => 'logo_section',
	'priority'    => 4,
	'default'     =>  '',
) );
	?>