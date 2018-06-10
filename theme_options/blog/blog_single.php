<?php
$section = 'blog_single_section';
//////////////////////
//
//	BLOG SECTIONS
//
//////////////////////	
Kirki::add_section( 'blog_single_section', array(
    'priority'    => 2,
    'title'       => __( 'Blog Single', 'hiiwp' ),
    'description' => __( 'Single post settings', 'hiiwp' ),
    'panel'       => 'blog_panel',   
) );

/////////////////////
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'single_full',
    'label'       => __( 'Make Single Posts Full Width', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_show_featured_image',
    'label'       => __( 'Show Feature Image', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_show_featured_image'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_author_bio_show',
    'label'       => __( 'Show Author Bio', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_rel_articles',
    'label'       => __( 'Show Related Articles', 'hiiwp' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_show_sidebar',
    'label'       => __( 'Show Sidebar', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_show_sidebar'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_comments_show',
    'label'       => __( 'Show Comments', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_comments_show'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'single_blog_post_padding_top',
	'label'       => esc_attr__( 'Single Blog Post Padding Top', 'hiiwp' ),
	'description' => esc_attr__( 'Controls the amount of padding between the blog content and the header', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['single_blog_post_padding_top'],
	'output'	  => array(
		array(
			'element'	=> '.single-blog-post',
			'property'	=> 'padding-top',
		)  
    ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'single_blog_post_padding_bottom',
	'label'       => esc_attr__( 'Single Blog Post Padding Bottom', 'hiiwp' ),
	'description' => esc_attr__( 'Controls the amount of padding between blog content and the footer', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['single_blog_post_padding_bottom'],
	'output'	  => array(
		array(
			'element'	=> '.single-blog-post',
			'property'	=> 'padding-bottom',
		)  
    ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'featured_img_padding_bottom',
	'label'       => esc_attr__( 'Featured Image Padding Bottom', 'hiiwp' ),
	'description' => esc_attr__( 'Controls Bottom Padding The Featured Images', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['featured_img_padding_bottom'],
	'output'	  => array(
		array(
			'element'	=> '.single-blog-post .post-thumbnail',
			'property'	=> 'margin-bottom',
		)  
    ),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'show_next_prev_posts',
    'label'       => __( 'Show or Hide Next/Previous posts', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['show_next_prev_posts'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'blog_format_icon',
	'label'       => __( 'Blog Format Icon Color', 'hiiwp' ),
	'description' => esc_attr__( 'Blog Format Icon Color', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['blog_format_icon'],
	'choices'     => array(
		'alpha' => true,
	),
	'output'	  => array(
		array(
			'element'	=> '.blog-default-icon',
			'property'	=> 'color',
		)  
    ),
) );
?>