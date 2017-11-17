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
    'label'       => esc_attr__( 'Testimonial Body Font', 'hiiwp' ),
    'description'    => __( 'This will style just the body text of the testimonial widget', 'hiiwp' ),
    'section'     => 'testimonials_section',
    'default'     => $hiilite_options['testimonials_body_font'],
    'priority'    => 1,
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'testimonials_author_font',
    'label'       => esc_attr__( 'Testimonial Author Font', 'hiiwp' ),
    'description'    => __( 'This will style just the author text of the testimonial widget', 'hiiwp' ),
    'section'     => 'testimonials_section',
    'default'     => $hiilite_options['testimonials_author_font'],
    'priority'    => 1,
) );


?>