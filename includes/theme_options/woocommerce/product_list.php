<?php
$section = 'woocommerce_product_list_section';
/*
*
*	TEXT Defaults
*	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'image',
    'settings'    => 'product_default_image',
    'label'       => esc_attr__( 'Default Product Image', 'hiiwp' ),
    'description' => __( 'Define styles for paragraph text', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 1,
    
) );

?>