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
    'settings'    => 'blog_author_bio',
    'label'       => __( 'Show Author Bio', 'my_textdomain' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_related_articles',
    'label'       => __( 'Show Related Articles', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'blog_comments',
    'label'       => __( 'Show Comments', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );
?>