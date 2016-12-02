<?php
//////////////////////
//
//	BLOG PANEL
//
//////////////////////

Kirki::add_panel( 'blog_panel', array(
    'priority'    => 7,
    'title'       => __( 'Blog (beta)', 'textdomain' ),
    'description' => __( 'Blog settings', 'textdomain' ),
    'icon' => 'dashicons-welcome-write-blog',
) );


include_once 'blog/blog_list.php';
include_once 'blog/blog_single.php';
include_once 'blog/pagination.php';
	?>