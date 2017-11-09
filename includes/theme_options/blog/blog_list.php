<?php
$section = 'blog_section';
//////////////////////
//
//	BLOG SECTIONS
//
//////////////////////
Kirki::add_section( $section, array(
    'priority'    => 1,
    'title'       => __( 'Blog List', 'textdomain' ),
    'description' => __( 'Blog list settings', 'textdomain' ),
    'panel'       => 'blog_panel',
) );

//////////////////////

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_layouts',
    'label'       => __( 'Blog Layout', 'my_textdomain' ),
    'section'     => $section,
    'default'     => 'full-width',
    'description' => 'Select the layout type for your blog',
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
	'label'       => esc_attr__( 'Columns', 'my_textdomain' ),
	'section'     => $section,
	'default'     => '2',
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
    'label'       => __( 'Make Blog Roll Full Width', 'my_textdomain' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_img_pos',
    'label'       => __( 'Image Position', 'my_textdomain' ),
    'section'     => $section,
    'default'     => 'image-left',
    'description' => 'Select position of the image',
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
    'label'       => __( 'Show Title', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_title_position',
    'label'       => __( 'Title Position', 'my_textdomain' ),
    'section'     => $section,
    'default'     => 'title-below',
    'description' => 'Select position of the title',
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
	'label'       => esc_attr__( 'Title Size', 'my_textdomain' ),
	'section'     => $section,
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
    'label'       => __( 'Dateline Position', 'my_textdomain' ),
    'section'     => $section,
    'default'     => 'date-above',
    'description' => 'Select position of the title',
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
    'label'       => __( 'Show Category', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_meta_show',
    'label'       => __( 'Show Meta Information', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_excerpt_show',
    'label'       => __( 'Show Excerpt', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'number',
    'settings'    => 'blog_excerpt_len',
    'label'       => __( 'Excerpt Word Length', 'my_textdomain' ),
    'section'     => $section,
    'default'     => '55',
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
    'label'       => __( 'Show More Button', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'select',
    'settings'    => 'blog_more_type',
    'label'       => __( 'Show More Button Type', 'my_textdomain' ),
    'section'     => $section,
    'default'     => 'button',
    'priority'    => 1,
    'choices'     => array(
	    'button' => 'Default Button',
        'button-primary' => 'Primary Button',
        'button-secondary' => 'Secondary Button',
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
    'label'       => __( 'Show More Button Text', 'my_textdomain' ),
    'section'     => $section,
    'default'     => esc_attr__( 'Read More'),
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
    'label'       => __( 'Show Blog Sidebar', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );	
?>