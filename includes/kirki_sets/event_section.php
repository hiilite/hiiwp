<?php
//////////////////////
//
//	EVENT PANEL
//
//////////////////////

Kirki::add_panel( 'event_panel', array(
    'priority'    => 6,
    'title'       => __( 'Event (beta)', 'textdomain' ),
    'description' => __( 'Event settings', 'textdomain' ),
    'icon' => 'dashicons-welcome-write-blog',
) );
//////////////////////
//
//	EVENT SECTIONS
//
//////////////////////
Kirki::add_section( 'event_section', array(
    'priority'    => 1,
    'title'       => __( 'Event Role', 'textdomain' ),
    'description' => __( 'Event role settings', 'textdomain' ),
    'panel'       => 'event_panel',
) );


Kirki::add_section( 'event_single_section', array(
    'priority'    => 2,
    'title'       => __( 'Single Event Page', 'textdomain' ),
    'description' => __( 'Single event page settings', 'textdomain' ),
    'panel'       => 'event_panel',   
) );
//////////////////////
//////////////////////

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_layout',
    'label'       => __( 'Event Layout', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => 'full-width',
    'description' => 'Select the layout type for your events',
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
	'settings'    => 'blog_columns',
	'label'       => esc_attr__( 'Columns', 'my_textdomain' ),
	'section'     => 'event_section',
	'default'     => '2',
	'priority'    => 1,
	'choices'     => array(
		'2'   => '2 Columns',
		'3'   => '3 Columns',
		'4'	=> '4 Columns',
	),
	'required'	=> array(
		array(
			'setting'  => 'blog_layout',
			'operator' => '!=',
			'value'    => 'full-width',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_image_pos',
    'label'       => __( 'Image Position', 'my_textdomain' ),
    'section'     => 'event_section',
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
	'type'        => 'radio-image',
    'settings'    => 'blog_title_pos',
    'label'       => __( 'Title Position', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => 'title-below',
    'description' => 'Select position of the title',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'title-below' => get_template_directory_uri() . '/images/icons/title-below.png',
        'title-above' => get_template_directory_uri() . '/images/icons/title-above.png',
    ),
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_title_on',
    'label'       => __( 'Show Title', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'blog_heading_size',
	'label'       => esc_attr__( 'Title Size', 'my_textdomain' ),
	'section'     => 'event_section',
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
			'setting'  => 'blog_title_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'blog_dateline_pos',
    'label'       => __( 'Event Date Position', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => 'date-above',
    'description' => 'Select position of the event date',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
	    'date-above' => get_template_directory_uri() . '/images/icons/date-above.png',
        'date-below' => get_template_directory_uri() . '/images/icons/date-below.png',
    ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio',
    'settings'    => 'blog_date_style',
    'label'       => __( 'Event Date Format', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => 'date-full',
    'description' => 'Select date format',
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
	    'date-full' => esc_attr__( 'Full Date (January 01, 2016)', my_textdomain),
	    'date-abr' => esc_attr__( 'Abbreviated Date (Jan 01, 2016)', my_textdomain),
	    'date-myd' => esc_attr__( 'Month/Day/Year (01/20/2016)', my_textdomain),
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_cats_on',
    'label'       => __( 'Show Category', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_meta_on',
    'label'       => __( 'Show Meta Information', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_excerpt_on',
    'label'       => __( 'Show Excerpt', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'number',
    'settings'    => 'blog_excerpt_length',
    'label'       => __( 'Excerpt Word Length', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => '55',
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'blog_excerpt_on',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_more_on',
    'label'       => __( 'Show More Button', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'blog_more_text',
    'label'       => __( 'Show More Button Text', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => esc_attr__( 'Read More'),
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'blog_more_on',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_pag_on',
    'label'       => __( 'Show Pagination', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'select',
    'settings'    => 'blog_pag_type',
    'label'       => __( 'Show Pagination', 'my_textdomain' ),
    'section'     => 'event_section',
    'default'     => 'option-1',
    'choices'	  => array(
	    'option-1' => esc_attr__( 'Prev/Next', my_textdomain),
	    'option-2' => esc_attr__( 'Numbered', my_textdomain),
    ),
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'blog_pag_on',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_comments',
    'label'       => __( 'Show Comments', 'my_textdomain' ),
    'section'     => 'event_single_section',
    'default'     => true,
    'priority'    => 1,
) );

	?>