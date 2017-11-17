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
    'settings'    => 'blog_comments_show',
    'label'       => __( 'Show Comments', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_comments_show'],
    'priority'    => 1,
) );
?>