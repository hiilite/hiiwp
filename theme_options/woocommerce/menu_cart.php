<?php
$section = 'woocommerce_menu_cart_section';

Kirki::add_field( 'hiiwp', array(
	'type'        => 'checkbox',
	'settings'    => 'show_cart_menu',
	'label'       => esc_attr__( 'Show Cart in Menu', 'hiiwp' ),
	'description' => esc_attr__( 'Show the cart icon in the main menu.', 'hiiwp' ),
	'section'     => 'section_id',
	'default'     => $hiilite_options['show_cart_menu'],
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'cart_menu_layout',
    'label'       => __( 'Cart Menu Item Layout', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['blog_layouts'],
    'description' => __('Select how you want the Cart icon to display', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
        'icon-only' => get_template_directory_uri() . '/images/icons/cary-only.png',
        'icon-plus-items' => get_template_directory_uri() . '/images/icons/icon-plus-items.png',
    ),
) );

?>