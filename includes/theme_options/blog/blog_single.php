<?php
$section = 'blog_single_section';
//////////////////////
//
//	BLOG SECTIONS
//
//////////////////////	
Kirki::add_section( 'blog_single_section', array(
    'priority'    => 2,
    'title'       => __( 'Blog Single', 'textdomain' ),
    'description' => __( 'Single post settings', 'textdomain' ),
    'panel'       => 'blog_panel',   
) );

/////////////////////
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'single_full',
    'label'       => __( 'Make Single Posts Full Width', 'my_textdomain' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_show_featured_image',
    'label'       => __( 'Show Feature Image', 'my_textdomain' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_show_featured_image'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_author_bio_show',
    'label'       => __( 'Show Author Bio', 'my_textdomain' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_rel_articles',
    'label'       => __( 'Show Related Articles', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_comments_show',
    'label'       => __( 'Show Comments', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );
?>