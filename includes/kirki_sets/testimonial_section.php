<?php
Kirki::add_section( 'testimonials_section', array(
    'priority'    => 6,
    'title'       => __( 'Testimonials', 'hiiwp' ),
    'description' => __( 'Testimonials settings', 'hiiwp' ),
    'icon' => 'dashicons-testimonial'
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'testimonials_body_font',
    'label'       => esc_attr__( 'Testimonial Body Font', 'kirki' ),
    'description'    => __( 'This will style just the body text of the testimonial widget' ),
    'section'     => 'testimonials_section',
    'default'     => $hiilite_options['testimonials_body_font'],
    'priority'    => 1,
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'testimonials_author_font',
    'label'       => esc_attr__( 'Testimonial Author Font', 'kirki' ),
    'description'    => __( 'This will style just the author text of the testimonial widget' ),
    'section'     => 'testimonials_section',
    'default'     => $hiilite_options['testimonials_author_font'],
    'priority'    => 1,
) );


?>