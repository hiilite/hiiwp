<?php
/**
 * HiiWP: portfolio-list
 *
 * Portfolio theme options
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
$section = 'portfolio_section';

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_filter',
    'label'       => __( 'Show Category Filters', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_show_filter'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_in_grid',
    'label'       => __( 'Show in grid', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_in_grid'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'portfolio_layout',
    'label'       => __( 'Portfolio Layout', 'hiiwp' ),
    'section'     => 'portfolio_section',
    'default'     => $hiilite_options['portfolio_layout'],
    'description' => __('Select the layout type for your blog (more to come in future updates)', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
	    'boxed' => get_template_directory_uri() . '/images/icons/layout-boxed.png',
	    'masonry' => get_template_directory_uri() . '/images/icons/layout-masonry.png',
        //'masonry-h' => get_template_directory_uri() . '/images/icons/layout-masonry-h.png',  
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'portfolio_add_padding',
    'label'       => __( 'Add Padding Between', 'hiiwp' ),
    'section'     => $section,
    'default'     => '20px',
    'priority'    => 1,
    'output'	  => array(
    	array(
		    'element'	=> '.portfolio-piece',
		    'property'	=> 'padding'
	    ),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'select',
	'settings'    => 'portfolio_image_style', 
	'label'       => esc_attr__( 'Image Style', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_image_style'],
	'choices'     => array(
		'default'   => esc_attr__( 'Do Not Crop', 'hiiwp' ),
		'square' 	=> esc_attr__( 'Square', 'hiiwp' ),
	),
	'priority'	  => 1,
	'description'    => __( 'Choose how you would like your portfolio photos to display', 'hiiwp' ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_info',
    'label'       => __( 'Show Info Box', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_show_info'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-image',
    'settings'    => 'portfolio_image_pos',
    'label'       => __( 'Info Position', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_image_pos'],
    'description' => __('Select position of the image', 'hiiwp'),
    'priority'    => 1,
    'multiple'    => 1,
    'choices'     => array(
	    'image-behind' => get_template_directory_uri() . '/images/icons/image-hover.png',
        'image-left' => get_template_directory_uri() . '/images/icons/image-left.png',
        'image-above' => get_template_directory_uri() . '/images/icons/image-above.png',
    ),
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_info',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_columns',
	'label'       => esc_attr__( 'Columns', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_columns'],
	'priority'    => 1,
	'choices'     => array(
		'1'   => '1 Column',
		'2'   => '2 Columns',
		'3'   => '3 Columns',
		'4'	  => '4 Columns',
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'portfolio_info_overlay_color',
    'label'       => __( 'Info Overlay Color', 'hiiwp' ),
    'section'     => $section,
    'default'     => 'rgba(0,0,0,0.6)',
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_info',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element'	=> '.portfolio-piece-content',
			'property'	=> 'background-color',			
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_post_title',
    'label'       => __( 'Show Title', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_show_post_title'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_info',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_heading_size',
	'label'       => esc_attr__( 'Title Size', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_heading_size'],
	'priority'    => 1,
	'choices'     => array(
		'h2'    => 'h2',
		'h3'	=> 'h3',
		'h4'	=> 'h4',
		'h5'	=> 'h5',
		'h6'	=> 'h6',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_post_title',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'portfolio_show_info',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'portfolio_heading_font',
    'label'       => esc_attr__( 'Title Font', 'hiiwp' ),
    'description' => __( 'Define font for the portfolio item titles', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_heading_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_post_title',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'portfolio_show_info',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.portfolio-item-title, .portfolio-item-title a',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_show_post_meta',
    'label'       => __( 'Show Meta', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_info_display',
			'operator' => '!==',
			'value'    => 'none',
		),
	),
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'portfolio_meta_font',
    'label'       => esc_attr__( 'Meta Font', 'hiiwp' ),
    'description' => __( 'Define font for the portfolio items meta data', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_meta_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_show_post_meta',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.portfolio-item-meta',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_excerpt_on',
    'label'       => __( 'Show Excerpt', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'number',
    'settings'    => 'portfolio_excerpt_length',
    'label'       => __( 'Excerpt Word Length', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_excerpt_length'],
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'portfolio_excerpt_on',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'typography',
    'settings'    => 'portfolio_excerpt_font',
    'label'       => esc_attr__( 'Excerpt Font', 'hiiwp' ),
    'description' => __( 'Define font for the portfolio item excerpt', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_excerpt_font'],
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_excerpt_on',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'      => array(
		array(
			'element' => '.portfolio-item-excerpt',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'portfolio_more_on',
    'label'       => __( 'Show More Button', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_more_on'],
    'priority'    => 1,
) );
Kirki::add_field( 'hiiwp', array(
    'type'        => 'text',
    'settings'    => 'portfolio_more_text',
    'label'       => __( 'Show More Button Text', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['portfolio_more_text'],
    'priority'    => 1,
    'active_callback'	=> array(
	    array(
		    'setting'	=> 'portfolio_more_on',
		    'operator'	=> '==',
		    'value'	=> true,
	    ),
    ),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_button_style',
	'label'       => esc_attr__( 'Button Style', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_button_style'],
	'choices'     => array(
		'default'   		=> esc_attr__( 'Default', 'hiiwp' ),
		'button-primary' 	=> esc_attr__( 'Primary', 'hiiwp' ),
		'button-secondary'  => esc_attr__( 'Secondary', 'hiiwp' ),
	),
	'priority'	  => 1,
	'description'    => __( 'Choose from your theme button styles', 'hiiwp' ),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_more_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_button_align',
	'label'       => esc_attr__( 'Button Align', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_button_align'],
	'choices'     => array(
		'left' 			=> esc_attr__( 'Left', 'hiiwp' ),
		'center' 		=> esc_attr__( 'Center', 'hiiwp' ),
		'right'  		=> esc_attr__( 'Right', 'hiiwp' ),
	),
	'priority'	  => 1,
	'description'    => __( 'Choose from your theme button styles', 'hiiwp' ),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_more_on',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dimension',
	'settings'    => 'portfolio_border_width',
	'label'       => esc_attr__( 'Border Width', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_border_width'],
	'priority'	  => 1,
	'description'    => __( 'Add a border around the portfolio items', 'hiiwp' ),
	'output'      => array(
		array(
			'element' => '.portfolio-piece-content',
			'property'	=> 'border-width',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
	'settings'    => 'portfolio_border_color',
	'label'       => esc_attr__( 'Border Color', 'hiiwp' ),
	'section'     => $section,
	'default'     => $hiilite_options['portfolio_border_color'],
	'priority'	  => 1,
	'description'    => __( 'Set the border color around the portfolio items', 'hiiwp' ),
	'output'      => array(
		array(
			'element' => '.portfolio-piece-content',
			'property'	=> 'border-color',
		),
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'portfolio_border_width',
			'operator' => '!==',
			'value'    => '0px',
		),
	),
) );
