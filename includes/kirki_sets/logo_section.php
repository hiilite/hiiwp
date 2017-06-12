<?php
$section = 'logo_section';
Kirki::add_section( $section, array(
    'priority'    => 2,
    'title'       => __( 'Logo', 'hiiwp' ),
    'description' => __( 'Global settings', 'hiiwp' ),
    'icon' => 'dashicons-admin-site'
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'image',
	'settings'    => 'main_logo',
	'label'       => __( 'Main Logo', 'hiiwp' ),
	'description' => __( 'Choose a default logo image to display', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['main_logo'],
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'switch',
	'settings'    => 'hide_logo',
	'label'       => __( 'Hide Logo in Header', 'hiiwp' ),
	'description' => __( 'Hide the logo in the header.', 'hiiwp' ),
	'section'     => $section,
	'default'     => false,
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'slider',
	'settings'    => 'logo_size_mod',
	'label'       => esc_attr__( 'A percentage that the logo should be scaled too', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['logo_size_mod'],
	'priority'    => 2,
	'choices'     => array(
		'min'  => '0',
		'max'  => '200',
		'step' => '1',
	),
	'active_callback'    => array(
		array(
			'setting'  => 'main_logo',
			'operator' => '!=',
			'value'    => false,
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'hide_logo',
			'operator' => '!=',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'logo_padding',
	'label'       => __( 'Logo Padding', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['logo_padding'],
	'priority'    => 2,
	'active_callback'    => array(
		array(
			'setting'  => 'main_logo',
			'operator' => '!=',
			'value'    => false,
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'hide_logo',
			'operator' => '!=',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'image',
	'settings'    => 'favicon',
	'label'       => __( 'Favicon', 'hiiwp' ),
	'description' => __( 'Ideally use square images around 64x64', 'hiiwp' ),
	'section'     => $section,
	'priority'    => 4,
	'default'     => $hiilite_options['favicon'],
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'image',
	'settings'    => 'safari_icon',
	'label'       => __( 'Safari Icon', 'hiiwp' ),
	'description' => __( 'Must be SVG format and 100% black. The SVG file must be a single layer and the viewBox attribute must be set to "0 0 16 16".', 'hiiwp' ),
	'section'     => $section,
	'priority'    => 4,
	'default'     => $hiilite_options['safari_icon'],
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'safari_icon_color',
	'label'       => __( 'Safari Icon Color', 'hiiwp' ),
	'description' => __( '', 'hiiwp' ),
	'section'     => $section,
	'priority'    => 4,
	'default'     => $hiilite_options['safari_icon_color'],
	'alpha'       => false,
) );
	?>