<?php
$cmb = new_cmb2_box( array(
    'id'            => 'testimonial_options',
    'title'         => 'Testimonial Details',
    'object_types'  => array( 'testimonials' ), // post type
    'context'       => 'advanced', // 'normal', 'advanced' or 'side'
    'priority'      => 'high', // 'high', 'core', 'default' or 'low'
    'show_names'    => true, // show field names on the left
    'cmb_styles'    => true, // false to disable the CMB stylesheet
    'closed'        => false, // keep the metabox closed by default
) );
$cmb->add_field( array(
    'name' => 'Author',
    'id' => 'testimonial_author',
    'type' => 'text'
) );
$cmb->add_field( array(
    'name'    => 'Author Website',
    'id'      => 'testimonial_website',
    'type'    => 'text_url'
) );
$cmb->add_field( array(
    'name'    => 'Rating',
    'id'      => 'testimonial_rating',
    'type'    => 'radio_inline',
    'options' => array(
	    '5' => __( '5', 'cmb2' ),
	    '4' => __( '4', 'cmb2' ),
	    '3' => __( '3', 'cmb2' ),
		'2' => __( '2', 'cmb2' ),
        '1' => __( '1', 'cmb2' ),   
    ),
) );

?>