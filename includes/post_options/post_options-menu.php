<?php
// Add VC Controls
if(isset($hiilite_options['menu_sections'])){
	vc_map( array(
		"name" => $title,
		"base" => "menu",
		"category" => 'by Hiilite',
		"description" => "Show sections of your restaurants menu",
		"icon" => "icon-wpb-layerslider",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Section",
				"param_name" => "section",
				"value" => $hiilite_options['menu_sections']
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading tag",
				"param_name" => "heading_tag",
				"description" => "Includes class=menu-section-title for additional styling",
				"value" => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'strong' => 'strong',
				)
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
			
		)
	) );
}

$cmb = new_cmb2_box( array(
    'id'            => 'menu_options',
    'title'         => 'Menu Item Details',
    'object_types'  => array( 'menu' ), // post type
    'context'       => 'advanced', // 'normal', 'advanced' or 'side'
    'priority'      => 'high', // 'high', 'core', 'default' or 'low'
    'show_names'    => true, // show field names on the left
    'cmb_styles'    => true, // false to disable the CMB stylesheet
    'closed'        => false, // keep the metabox closed by default
) );
$cmb->add_field( array(
    'name' => 'Ingredients',
    'id' => 'ingredients',
    'type' => 'textarea_small'
) );
$cmb->add_field( array(
    'name'    => 'Price',
    'desc'    => '(ex: $9.99/per, $ 9.99 each, 9.99)',
    'id'      => 'price',
    'type'    => 'text_small'
) );
$cmb->add_field( array(
    'name'    => 'Notes',
    'desc'    => '(ex: *Below served with your choice of daily soup, salad, or fries)',
    'id'      => 'notes',
    'type'    => 'text'
) );



$group_field_id = $cmb->add_field( array(
    'id'          => 'addons',
    'type'        => 'group',
    // 'repeatable'  => false, // use false if you want non-repeatable group
    'options'     => array(
        'group_title'   => __( 'Addon {#}', 'hiilite' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => __( 'Add Another', 'hiilite' ),
        'remove_button' => __( 'Remove', 'hiilite' ),
        'sortable'      => true, // beta
        // 'closed'     => true, // true to have the groups closed by default
    ),
) );
// Id's for group's fields only need to be unique for the group. Prefix is not needed.
$cmb->add_group_field( $group_field_id, array(
    'name' => 'Text',
    'id'   => 'addons_text',
    'type' => 'text_medium',
    //'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
) );
$cmb->add_group_field( $group_field_id, array(
    'name' => '$',
    'id'   => 'addons_price',
    'type' => 'text_small',
) );

$cmb->add_field( array(
    'name' => 'Show Add Ons Prefix',
    'id' => 'show_addons_prefix',
	'desc' => 'Show the word "Add on" before the addons',
    'type' => 'checkbox',
    'default' => true
) );
?>