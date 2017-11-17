<?php
if(class_exists('WooCommerce')):
	Kirki::add_panel( 'woocommerce_panel', array(
	    'priority'    => 8,
	    'title'       => __( 'WooCommerce', 'hiiwp' ),
	    'description' => __( 'Typography settings', 'hiiwp' ),
	    'icon' => 'dashicons-cart'
	) );
	Kirki::add_section( 'woocommerce_product_list_section', array(
	    'priority'    => 1,
	    'title'       => __( 'Product List', 'hiiwp' ),
	    'description' => __( 'Settings for how woocommerce products display', 'hiiwp' ),
	    'panel'		 => 'woocommerce_panel',
	) );	
	Kirki::add_section( 'woocommerce_product_single_section', array(
	    'priority'    => 1,
	    'title'       => __( 'Product Single', 'hiiwp' ),
	    'description' => __( 'Settings for how woocommerce products pages display', 'hiiwp' ),
	    'panel'		 => 'woocommerce_panel',
	) );	
	Kirki::add_section( 'woocommerce_cart_page_section', array(
	    'priority'    => 1,
	    'title'       => __( 'Cart Page', 'hiiwp' ),
	    'description' => __( 'Settings for how woocommerce products display', 'hiiwp' ),
	    'panel'		 => 'woocommerce_panel',
	) );		
	include_once 'woocommerce/product_list.php';
	include_once 'woocommerce/product_single.php';
	include_once 'woocommerce/cart_page.php';
endif;
?>