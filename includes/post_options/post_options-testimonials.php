<?php
$cmb = new_cmb2_box( array(
    'id'            => 'testimonial_options',
    'title'         => __('Testimonial Details', 'hiiwp' ),
    'object_types'  => array( 'testimonials' ), // post type
    'context'       => 'advanced', // 'normal', 'advanced' or 'side'
    'priority'      => 'high', // 'high', 'core', 'default' or 'low'
    'show_names'    => true, // show field names on the left
    'cmb_styles'    => true, // false to disable the CMB stylesheet
    'closed'        => false, // keep the metabox closed by default
) );
$cmb->add_field( array(
    'name' => __('Author', 'hiiwp'),
    'id' => 'testimonial_author',
    'type' => 'text'
) );
$cmb->add_field( array(
    'name' => __('Author Company', 'hiiwp'),
    'id' => 'testimonial_company',
    'type' => 'text'
) );
$cmb->add_field( array(
    'name'    => __('Author Website', 'hiiwp' ),
    'id'      => 'testimonial_website',
    'type'    => 'text_url'
) );
$cmb->add_field( array(
    'name'    => __('Rating', 'hiiwp' ),
    'id'      => 'testimonial_rating',
    'type'    => 'radio_inline',
    'options' => array(
	    '5' => __( '5', 'hiiwp' ),
	    '4' => __( '4', 'hiiwp' ),
	    '3' => __( '3', 'hiiwp' ),
		'2' => __( '2', 'hiiwp' ),
        '1' => __( '1', 'hiiwp' ),   
    ),
) );

?>