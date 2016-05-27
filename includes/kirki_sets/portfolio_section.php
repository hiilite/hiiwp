<?php
Kirki::add_section( 'portfolio_section', array(
    'priority'    => 6,
    'title'       => __( 'Portfolio', 'textdomain' ),
    'description' => __( 'Portfolio settings', 'textdomain' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_slug',
    'label'       => __( 'Portfolio Slug', 'my_textdomain' ),
    'section'     => 'portfolio_section',
    'default'     => 'portfolio',
    'priority'    => 1,
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'portfolio_layout',
    'label'       => __( 'Portfolio Layout', 'my_textdomain' ),
    'section'     => 'portfolio_section',
    'default'     => 'masonry-h',
    'description' => 'Select the layout type for your blog (more to come in future updates)',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'masonry-h' => get_template_directory_uri() . '/images/icons/layout-masonry-h.png',
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_filter',
    'label'       => __( 'Show Category Filters', 'my_textdomain' ),
    'section'     => 'portfolio_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_in_grid',
    'label'       => __( 'Show in grid', 'my_textdomain' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_post_title',
    'label'       => __( 'Show Title', 'my_textdomain' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_post_meta',
    'label'       => __( 'Show Meta', 'my_textdomain' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_add_padding',
    'label'       => __( 'Add Padding Between', 'my_textdomain' ),
    'section'     => 'portfolio_section',
    'default'     => '0px',
    'priority'    => 1,
) );
	?>