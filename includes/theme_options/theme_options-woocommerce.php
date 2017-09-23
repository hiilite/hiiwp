<?php
Kirki::add_panel( 'woocommerce_panel', array(
    'priority'    => 8,
    'title'       => __( 'Fonts', 'textdomain' ),
    'description' => __( 'Typography settings', 'textdomain' ),
    'icon' => 'dashicons-cart'
) );
Kirki::add_section( 'woocommerce_product_list_section', array(
    'priority'    => 1,
    'title'       => __( 'Product List', 'textdomain' ),
    'description' => __( 'Settings for how woocommerce products display', 'textdomain' ),
    'panel'		 => 'woocommerce_panel',
) );	
Kirki::add_section( 'woocommerce_product_single_section', array(
    'priority'    => 1,
    'title'       => __( 'Product Single', 'textdomain' ),
    'description' => __( 'Settings for how woocommerce products pages display', 'textdomain' ),
    'panel'		 => 'woocommerce_panel',
) );	
Kirki::add_section( 'woocommerce_cart_page_section', array(
    'priority'    => 1,
    'title'       => __( 'Cart Page', 'textdomain' ),
    'description' => __( 'Settings for how woocommerce products display', 'textdomain' ),
    'panel'		 => 'woocommerce_panel',
) );		
include_once 'woocommerce/product_list.php';
include_once 'woocommerce/product_single.php';
include_once 'woocommerce/cart_page.php';
?>