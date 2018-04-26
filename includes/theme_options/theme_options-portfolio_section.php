<?php
//////////////////////
//
//	PORTFOLIO PANEL
//
//////////////////////
Kirki::add_panel( 'portfolio_panel', array(
    'priority'    => 7,
    'title'       => __( 'Portfolio', 'hiiwp' ),
    'description' => __( 'Portfolio settings', 'hiiwp' ),
    'icon' => 'dashicons-grid-view',
) );
//////////////////////
//
//	PORTFOLIO SECTIONS
//
//////////////////////
Kirki::add_section( 'portfolio_section', array(
    'priority'    => 1,
    'title'       => __( 'Portfolio Page', 'hiiwp' ),
    'description' => __( 'Portfolio settings', 'hiiwp' ),
    'panel'       => 'portfolio_panel', 
) );


Kirki::add_section( 'portfolio_piece_section', array(
    'priority'    => 2,
    'title'       => __( 'Portfolio Piece', 'hiiwp' ),
    'description' => __( 'Portfolio piece settings', 'hiiwp' ),
    'panel'       => 'portfolio_panel',   
) );
//////////////////////
//////////////////////


Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'portfolio_layout',
    'label'       => __( 'Portfolio Layout', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => 'masonry-h',
    'description' => __('Select the layout type for your blog (more to come in future updates)', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'masonry-h' => get_template_directory_uri() . '/images/icons/layout-masonry-h.png',
        'masonry' => get_template_directory_uri() . '/images/icons/layout-masonry.png',
        'boxed' => get_template_directory_uri() . '/images/icons/layout-boxed.png',
    ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'portfolio_image_pos',
    'label'       => __( 'Image Position', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => 'image-left',
    'description' => __('Select position of the image', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'image-left' => get_template_directory_uri() . '/images/icons/image-left.png',
        'image-above' => get_template_directory_uri() . '/images/icons/image-above.png',
    ),
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_layout',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_columns',
	'label'       => esc_attr__( 'Columns', 'hiiwp' ),
	'section'     => 'portfolio_section',
	'default'     => '1',
	'priority'    => 1,
	'choices'     => array(
		'1'   => '1 Column',
		'2'   => '2 Columns',
		'3'   => '3 Columns',
		'4'	=> '4 Columns',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_layout',
			'operator' => '!=',
			'value'    => 'masonry-h',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_filter',
    'label'       => __( 'Show Category Filters', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_in_grid',
    'label'       => __( 'Show in grid', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_post_title',
    'label'       => __( 'Show Title', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_heading_size',
	'label'       => esc_attr__( 'Title Size', 'hiiwp' ),
	'section'     => 'portfolio_section',
	'default'     => 'h2',
	'priority'    => 1,
	'choices'     => array(
		'h1'    => 'h1',
		'h2'    => 'h2',
		'h3'	=> 'h3',
		'h4'	=> 'h4',
		'h5'	=> 'h5',
		'h6'	=> 'h6',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_post_title',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'portfolio_title_pos',
    'label'       => __( 'Title Position', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => 'title-below',
    'description' => __('Select position of the title', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'title-below' => get_template_directory_uri() . '/images/icons/title-below.png',
        'title-above' => get_template_directory_uri() . '/images/icons/title-above.png',
    ),
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_post_title',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_post_meta',
    'label'       => __( 'Show Meta', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_add_padding',
    'label'       => __( 'Add Padding Between', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => '0px',
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_excerpt_on',
    'label'       => __( 'Show Excerpt', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'number',
    'settings'    => 'portfolio_excerpt_length',
    'label'       => __( 'Excerpt Word Length', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => '55',
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'portfolio_excerpt_on',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_more_on',
    'label'       => __( 'Show More Button', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => false,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_more_text',
    'label'       => __( 'Show More Button Text', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => __('Read More', 'hiiwp'),
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'portfolio_more_on',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );
//////////////////////
//
//	PORTFOLIO PIECE
//
//////////////////////
Kirki::add_field( 'hiiwp', array(
    'type'        => 'radio-image',
    'settings'    => 'portfolio_template',
    'label'       => __( 'Portfolio Template', 'hiiwp' ),
    'section'     => 'portfolio_piece_section',
    'default'     => $hiilite_options['portfolio_template'],
    'description' => 'Select the layout type for your blog',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'default' => get_template_directory_uri() . '/images/icons/portfolio-default.png',
        'split' => get_template_directory_uri() . '/images/icons/portfolio-split.png',
    ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'portfolio_background',
	'label'       => __( 'Portfolio Background', 'hiiwp' ),
	'section'     => 'portfolio_piece_section',
	'default'     => $hiilite_options['portfolio_background'],
	'priority'    => 1,
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_template',
			'operator' => '==',
			'value'    => 'split',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'portfolio_panel_background',
	'label'       => __( 'Info Panel Background', 'hiiwp' ),
	'section'     => 'portfolio_piece_section',
	'default'     => $hiilite_options['portfolio_panel_background'],
	'priority'    => 1,
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_template',
			'operator' => '==',
			'value'    => 'split',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'portfolio_info_colors',
    'label'       => __( 'Info Panel Text Colors', 'hiiwp' ),
    'section'     => 'portfolio_piece_section',
    'priority'    => 1,
    'choices'     => array(
        'title'    => esc_attr__( 'Title', 'hiiwp' ),
        'text'   => esc_attr__( 'Text', 'hiiwp' ),
        'link'  => esc_attr__( 'Link', 'hiiwp' ),
        'hover'  => esc_attr__( 'Link Hover', 'hiiwp' ),
    ),
    'default' => array(
        'title' => $hiilite_options['portfolio_info_colors']['title'],
        'text'	=> $hiilite_options['portfolio_info_colors']['text'],
        'link'  => $hiilite_options['portfolio_info_colors']['link'],
        'hover' => $hiilite_options['portfolio_info_colors']['hover'],
    ),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_template',
			'operator' => '==',
			'value'    => 'split',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'show_more_projects',
    'label'       => __( 'Show More Projects', 'hiiwp' ),
    'section'     => 'portfolio_piece_section',
    'default'     => $hiilite_options['show_more_projects'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_comments',
    'label'       => __( 'Show Comments', 'hiiwp' ),
    'section'     => 'portfolio_piece_section',
    'default'     => false,
    'priority'    => 1,
) );
	?>