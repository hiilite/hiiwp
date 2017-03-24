<?php
$section = 'footer_section';
$options = get_option('hii_seo_settings');

Kirki::add_section( $section, array(
    'priority'    => 4,
    'title'       => __( 'Footer', 'textdomain' ),
    'description' => __( 'Footer settings', 'textdomain' ),
    'icon' => 'dashicons-download'
) );




Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'footer_background',
    'label'       => __( 'Footer Background', 'my_textdomain' ),
    'description' => __('Choose footer background image and color'),
    'section'     => $section,
    'priority'    => 1,
    'default'     => array(
		'color'    => '#ffffff',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
	),
) );
// Footer  order Top
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'footer_border_color',
    'label'       => __( 'Footer Border Top Color', 'hiiwp' ),
    'description' => __('Define top border color for Footer Top'),
    'section'     => $section,
    'priority'    => 1,
    'default'     => '',
    'alpha'		  => true,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-color',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'footer_border_weight',
    'label'       => __( 'Footer Border Top Thickness', 'hiiwp' ),
    'section'     => $section,
    'default'     => '0px',
    'priority'    => 1,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-width',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#main_footer',
			'property' => 'border-top-width',
		),
	),
) );
/*

	FOOTER TOP

*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'show_footer_top_yesno',
    'label'       => __( 'Show Footer Top', 'my_textdomain' ),
    'description' => __('Enabling this option will show Footer Top area'),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_in_grid',
    'label'       => __( 'Footer in Grid', 'my_textdomain' ),
    'description' => __('Enabling this option will place Footer Top content in grid'),
    'section'     => $section,
    'default'     => true,
    'priority'    => 1,
    'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'multicheck',
    'settings'    => 'footer_top_columns',
    'label'       => __( 'Footer Top Columns', 'my_textdomain' ),
    'description'  => __( 'Choose which columns show for Footer top area', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 6,
    'choices'     => array(
		'footer_column_1' => esc_attr__( 'Column 1', 'my_textdomain' ),
		'footer_column_2' => esc_attr__( 'Column 2', 'my_textdomain' ),
		'footer_column_3' => esc_attr__( 'Column 3', 'my_textdomain' ),
		'footer_column_4' => esc_attr__( 'Column 4', 'my_textdomain' ),
	),
    'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'footer_top_colors',
    'label'       => __( 'Footer Top Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 6,
    'choices'     => array(
        'title'    => esc_attr__( 'Title', 'hiiwp' ),
        'text'   => esc_attr__( 'Text', 'hiiwp' ),
        'link'  => esc_attr__( 'Link', 'hiiwp' ),
        'hover'  => esc_attr__( 'Link Hover', 'hiiwp' ),
    ),
    'default'     => array(
        'title'    => '',
        'text'   => '',
        'link'  => '',
        'hover'  => '',
    ),
	'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'footer_top_background',
    'label'       => __( 'Footer Top Background', 'my_textdomain' ),
    'description' => __('Choose footer top background image and color'),
    'section'     => $section,
    'priority'    => 6,
    'default'     => array(
		'color'    => ' ',
		'image'    => '',
		'repeat'   => 'no-repeat',
		'size'     => 'cover',
		'attach'   => 'fixed',
		'position' => 'left-top',
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );



Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'footer_top_padding',
	'label'       => __( 'Footer Top Padding', 'my_textdomain' ),
	'description' => __('Set padding for footer top section'),
	'section'     => 'header_section',
	'default'     => array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	),
	'priority'    => 6,
	'transport'   => 'postMessage',
    'required'	  => array(
		array(
		    'setting'  => 'show_footer_top_yesno',
			'operator' => '==',
			'value'    => true,
	    )),
    'output' => array(
		array(
			'element'  => '#footer_top',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_top',
			'property' => 'padding',
		),
	),
) );




/*
	
	FOOTER PAGE
	
*/
Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_page_on',
    'label'       => __( 'Use Footer Page (beta)', 'my_textdomain' ),
    'description'  => __( 'Enable to use a pages content as the footer', 'my_textdomain' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 7,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'footer_page_content',
	'label'       => __( 'Footer Content Page (beta)', 'my_textdomain' ),
	'description'  => __( 'Select the page to use as the footer for the site', 'my_textdomain' ),
	'section'     => $section,
	'default'     => false,
	'priority'    => 7,
	'required'	  => array(
		array(
		    'setting'  => 'footer_page_on',
			'operator' => '==',
			'value'    => true,
	    )),
) );





/*
	
	FOOTER BOTTOM
	
*/

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_text_yesno',
    'label'       => __( 'Show Footer Bottom', 'my_textdomain' ),
    'description'  => __( 'Enabling this option will show Footer Bottom area', 'my_textdomain' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_in_grid',
    'label'       => __( 'Footer Bottom in Grid', 'my_textdomain' ),
    'description' => __('Enabling this option will place Footer bottom content in grid'),
    'section'     => $section,
    'default'     => false,
    'priority'    => 8,
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'multicheck',
    'settings'    => 'footer_bottom_columns',
    'label'       => __( 'Footer Bottom Columns', 'my_textdomain' ),
    'description'  => __( 'Choose which columns show for Footer Bottom area', 'my_textdomain' ),
    'section'     => $section,
    'priority'    => 8,
    'choices'     => array(
		'footer_bottom_left' => esc_attr__( 'Left', 'my_textdomain' ),
		'footer_bottom_center' => esc_attr__( 'Center', 'my_textdomain' ),
		'footer_bottom_right' => esc_attr__( 'Right', 'my_textdomain' ),
	),
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );


Kirki::add_field( 'hiiwp', array(
	'type'        => 'multicolor',
    'settings'    => 'footer_bottom_colors',
    'label'       => __( 'Footer Bottom Colors', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 8,
    'choices'     => array(
        'text'   => esc_attr__( 'Text', 'hiiwp' ),
        'link'  => esc_attr__( 'Link', 'hiiwp' ),
        'hover'  => esc_attr__( 'Link Hover', 'hiiwp' ),
    ),
    'default'     => array(
        'text'   => '',
        'link'  => '',
        'hover'  => '',
    ),
	'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'color',
    'settings'    => 'footer_bottom_background_color',
    'label'       => __( 'Footer Bottom Background Color', 'my_textdomain' ),
    'section'     => $section,
    'default'     => 'color_one',
    'priority'    => 8,
    'default'	 => ' ',
    'alpha'		  => true,
   'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'background-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'background-color',
		),
	),
) );

// Footer border Top
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'footer_bottom_border_color',
    'label'       => __( 'Footer Bottom Border Color', 'hiiwp' ),
    'description' => __('Define top border color for Footer Top'),
    'section'     => $section,
    'priority'    => 8,
    'default'     => '',
    'alpha'		  => true,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-color',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-color',
		),
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'dimension',
    'settings'    => 'footer_bottom_border_weight',
    'label'       => __( 'Footer Bottom Border Thickness', 'hiiwp' ),
    'section'     => $section,
    'default'     => '0px',
    'priority'    => 8,
    'transport'   => 'postMessage',
    'output' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-width',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'border-top-width',
		),
	),
	'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'spacing',
	'settings'    => 'footer_bottom_padding',
	'label'       => __( 'Footer Bottom Padding', 'my_textdomain' ),
	'description' => __('Set padding for footer bottom section'),
	'section'     => $section,
	'default'     => array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	),
	'priority'    => 8,
	'transport'   => 'postMessage',
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
    'output' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'padding',
		),
	),
	'js_vars' => array(
		array(
			'element'  => '#footer_bottom',
			'property' => 'padding',
		),
	),
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'textarea',
	'settings'    => 'footer_bottom_copyright_text',
	'label'       => __( 'Copyright Text', 'hiiwp' ),
	'description' => __('Change the copy right text in the footer bottom'),
	'section'     => $section,
	'default'     => '<small>Copyright © '.date('Y').' '.$options['business_name'].' All rights reserved. <a href="https://hiilite.com/" target="_blank" title="Hiilite Creative Group | Web + Marketing">Web Design by Hiilite Creative Group Kelowna</a></small>',
	'priority'    => 8,
    'active_callback'	=> array(
		array(
			'setting'  => 'footer_text_yesno',
			'operator' => '==',
			'value'    => true,
		),
	),
) );



	?>