<?php
Kirki::add_section( 'testimonials_section', array(
    'priority'    => 6,
    'title'       => __( 'Testimonials (beta)', 'hiiwp' ),
    'description' => __( 'Testimonials settings', 'hiiwp' ),
    'icon' => 'dashicons-testimonial'
) );



Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'testimonials_body_font',
    'label'       => esc_attr__( 'Testimonial Body Font', 'kirki' ),
    'description'    => __( 'This will style just the body text of the testimonial widget' ),
    'section'     => 'testimonials_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text_transform'    => ' ',
        'color'          => get_theme_mod('color_four','#333333'),
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ),
    'priority'    => 1,
) );


Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'testimonials_author_font',
    'label'       => esc_attr__( 'Testimonial Author Font', 'kirki' ),
    'description'    => __( 'This will style just the author text of the testimonial widget' ),
    'section'     => 'testimonials_section',
    'default'     => array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text_transform'    => ' ',
        'color'          => get_theme_mod('color_four','#333333'),
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ),
    'priority'    => 1,
) );


?>