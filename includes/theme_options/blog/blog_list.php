<?php
$section = 'blog_section';
//////////////////////
//
//	BLOG SECTIONS
//
//////////////////////
Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Blog List', 'hiiwp' ),
    'description' => __( 'Blog list settings', 'hiiwp' ),
    'panel'       => 'blog_panel',
) );

//////////////////////

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_layouts',
    'label'       => __( 'Blog Layout', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_layouts'],
    'description' => __('Select the layout type for your blog', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'full-width' => get_template_directory_uri() . '/images/icons/layout-full.png',
        'boxed' => get_template_directory_uri() . '/images/icons/layout-boxed.png',
        'masonry' => get_template_directory_uri() . '/images/icons/layout-masonry.png',
    ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'blog_col',
	'label'       => esc_attr__( 'Columns', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['blog_col'],
	'priority'    => 1,
	'choices'     => array(
		'2'   => '2 Columns',
		'3'   => '3 Columns',
		'4'	=> '4 Columns',
	),
	'required'	=> array(
		array(
			'setting'  => 'blog_layouts',
			'operator' => '!=',
			'value'    => 'full-width',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_full_width',
    'label'       => __( 'Make Blog Roll Full Width', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_full_width'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_hide_password_protected_posts',
    'label'       => __( 'Hide Password Protected Posts', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_hide_password_protected_posts'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_img_pos',
    'label'       => __( 'Image Position', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_img_pos'],
    'description' => __('Select position of the image', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'image-left' => get_template_directory_uri() . '/images/icons/image-left.png',
        'image-above' => get_template_directory_uri() . '/images/icons/image-above.png',
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_title_show',
    'label'       => __( 'Show Title', 'hiiwp' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_title_position',
    'label'       => __( 'Title Position', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_title_position'],
    'description' => __('Select position of the title', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'title-below' => get_template_directory_uri() . '/images/icons/title-below.png',
        'title-above' => get_template_directory_uri() . '/images/icons/title-above.png',
    ),
    'required'	=> array(
		array(
			'setting'  => 'blog_title_show',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'blog_heading_tag',
	'label'       => esc_attr__( 'Title Size', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['blog_heading_tag'],
	'priority'    => 1,
	'choices'     => array(
		'h1'    => 'h1',
		'h2'    => 'h2',
		'h3'	=> 'h3',
		'h4'	=> 'h4',
		'h5'	=> 'h5',
		'h6'	=> 'h6',
	),
	'required'	=> array(
		array(
			'setting'  => 'blog_title_show',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_date_pos',
    'label'       => __( 'Dateline Position', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_date_pos'],
    'description' => __('Select position of the title', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
	    'date-above' => get_template_directory_uri() . '/images/icons/date-above.png',
        'date-below' => get_template_directory_uri() . '/images/icons/date-below.png',
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_cats_show',
    'label'       => __( 'Show Category', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_cats_show'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_meta_show',
    'label'       => __( 'Show Meta Information', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_meta_show'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_excerpt_show',
    'label'       => __( 'Show Excerpt', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_excerpt_show'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'number',
    'settings'    => 'blog_excerpt_len',
    'label'       => __( 'Excerpt Word Length', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_excerpt_len'],
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'blog_excerpt_show',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_more_show',
    'label'       => __( 'Show More Button', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_more_show'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'select',
    'settings'    => 'blog_more_type',
    'label'       => __( 'Show More Button Type', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_more_type'],
    'priority'    => 1,
    'choices'     => array(
	    'button' => __('Default Button', 'hiiwp'),
        'button-primary' => __('Primary Button', 'hiiwp'),
        'button-secondary' => __('Secondary Button', 'hiiwp'),
        'link' => 'Text Link',
    ),
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'blog_more_show',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'blog_more_text',
    'label'       => __( 'Show More Button Text', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_more_text'],
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'blog_more_show',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_sidebar_show',
    'label'       => __( 'Show Blog Sidebar', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_sidebar_show'],
    'priority'    => 1,
) );	
?>