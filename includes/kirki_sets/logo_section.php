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
	'type'        => 'spacing',
	'settings'    => 'logo_padding',
	'label'       => __( 'Logo Padding', 'my_textdomain' ),
	'section'     => 'logo_section',
	'default'     => array(
		'top'    => '0',
		'right'  => '1em',
		'bottom' => '0',
		'left'   => '1em',
	),
	'priority'    => 2,
	'active_callback'    => array(
		array(
			'setting'  => 'main_logo',
			'operator' => '!=',
			'value'    => false,
		),
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

Kirki::add_field( 'hiiwp', array(
	'type'        => 'image',
	'settings'    => 'safari_icon',
	'label'       => __( 'Safari Icon', 'my_textdomain' ),
	'description' => __( 'Must be SVG format and 100% black. The SVG file must be a single layer and the viewBox attribute must be set to "0 0 16 16".', 'my_textdomain' ),
	'section'     => 'logo_section',
	'priority'    => 4,
	'default'     =>  '',
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'safari_icon_color',
	'label'       => __( 'Safari Icon Color', 'my_textdomain' ),
	'description' => __( '', 'my_textdomain' ),
	'section'     => 'logo_section',
	'priority'    => 4,
	'default'     =>  get_theme_mod('color_one'),
	'alpha'       => false,
) );
	?>