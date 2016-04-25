<?php
add_action( 'widgets_init', 'hiiwp_widgets_init' );
function hiiwp_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Header Top Left', 'hiiwp' ),
        'id' => 'header_top_left',
        'description' => __( 'Widgets in this area will be shown in the top header above the logo', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Header Top Right', 'hiiwp' ),
        'id' => 'header_top_right',
        'description' => __( 'Widgets in this area will be shown in the top header above the logo', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item align-right %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Header Center Left', 'hiiwp' ),
        'id' => 'header_center_left',
        'description' => __( 'Widgets in this area will be shown in the header on the left of the logo', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item align-left %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Header Center Right', 'hiiwp' ),
        'id' => 'header_center_right',
        'description' => __( 'Widgets in this area will be shown in the header on the right of the logo', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item align-left %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Header Bottom', 'hiiwp' ),
        'id' => 'header_bottom',
        'description' => __( 'Widgets in this area will be shown in the header under the menu', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item align-center %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    
    register_sidebar( array(
        'name' => __( 'Footer Column 1', 'hiiwp' ),
        'id' => 'footer_column_1',
        'description' => __( 'Footer Column 1', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer Column 2', 'hiiwp' ),
        'id' => 'footer_column_2',
        'description' => __( 'Footer Column 2', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer Column 3', 'hiiwp' ),
        'id' => 'footer_column_3',
        'description' => __( 'Footer Column 3', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer Column 4', 'hiiwp' ),
        'id' => 'footer_column_4',
        'description' => __( 'Footer Column 4', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
     register_sidebar( array(
        'name' => __( 'Footer Bottom Center', 'hiiwp' ),
        'id' => 'footer_bottom_center',
        'description' => __( 'Footer Bottom Center', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer Bottom Left', 'hiiwp' ),
        'id' => 'footer_bottom_left',
        'description' => __( 'Footer Bottom Left', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer Bottom Right', 'hiiwp' ),
        'id' => 'footer_bottom_right',
        'description' => __( 'Footer Bottom Right', 'theme-slug' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    
    register_sidebar( array(
        'name' => __( 'Post Sidebar', 'hiiwp' ),
        'id' => 'post_sidebar',
        'description' => __( 'Shows in the right sidebar of a post', 'hiilite' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Post Bottom', 'hiiwp' ),
        'id' => 'post_bottom',
        'description' => __( 'Shows at the bottom of a post', 'hiilite' ),
        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
    
   
}
	
?>