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
	'settings'    => 'mobile_logo',
	'label'       => __( 'Mobile Logo', 'hiiwp' ),
	'description' => __( 'Choose a different logo to display on mobile devices', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['mobile_logo'],
	'priority'    => 3,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'slider',
	'settings'    => 'mobile_logo_size_mod',
	'label'       => esc_attr__( 'A percentage that the mobile logo should be scaled too', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['mobile_logo_size_mod'],
	'priority'    => 3,
	'choices'     => array(
		'min'  => '0',
		'max'  => '200',
		'step' => '1',
	),
	'active_callback'    => array(
		array(
			'setting'  => 'mobile_logo',
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
	'description' => __( 'Use a square image', 'hiiwp' ),
	'section'     => $section,
	'priority'    => 4,
	'default'     => $hiilite_options['favicon'],
) );

/* Removed Safari Icon Customizer Option - Related files: HiiWP.php lines 260-263, site_variables.php lines 166-169, theme_options.php lines 126-146
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
) );
*/
	?>