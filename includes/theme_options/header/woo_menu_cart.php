<?php
$section = 'woocommerce_menu_cart_section';

Kirki::add_section( 'woocommerce_menu_cart_section', array(
	    'priority'    => 1,
	    'title'       => __( 'WooCommerce Menu Cart', 'hiiwp' ),
	    'description' => __( 'Settings for how WooCommerce cart displays in the menu', 'hiiwp' ),
	    'panel'		 => 'header_panel',
	) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'checkbox',
	'settings'    => 'show_cart_menu',
	'label'       => esc_attr__( 'Show Cart in Menu', 'textdomain' ),
	'description' => esc_attr__( 'Show the cart icon in the main menu.', 'textdomain' ),
	'section'     => $section,
	'default'     => true,
	'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'cart_menu_layout',
    'label'       => __( 'Cart Menu Item Layout', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['cart_menu_layout'],
    'description' => __('Select how you want the Cart icon to display', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'icon-only' => get_template_directory_uri() . '/images/icons/cart-only.png',
        'icon-plus-items' => get_template_directory_uri() . '/images/icons/icon-plus-items.png',
    ),
) );
Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'cart_menu_icon',
    'label'       => __( 'Cart Menu Icon', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['cart_menu_icon'],
    'description' => __('Choose the Cart icon', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'shopping-cart' => get_template_directory_uri() . '/images/icons/cart-only.png',
        'shopping-bag' => get_template_directory_uri() . '/images/icons/shopping-bag.png',
    ),
) );

?>