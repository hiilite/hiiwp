<?php
Kirki::add_panel( 'header_panel', array(
    'priority'    => 3,
    'title'       => __( 'Header', 'hiiwp' ),
    'description' => __( 'Header settings', 'hiiwp' ),
    'icon' => 'dashicons-upload'
) );

include_once 'header/header.php';
include_once 'header/header_top.php';
include_once 'header/menus.php';
include_once 'header/menu_fonts.php';

if(class_exists('WooCommerce')):
	include_once 'header/woo_menu_cart.php';
endif;
?>