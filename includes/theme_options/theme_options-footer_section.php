<?php
$section = 'footer_section';
$options = get_option('hii_seo_settings');

Kirki::add_section( $section, array(
    'priority'    => 4,
    'title'       => __( 'Footer', 'hiiwp' ),
    'description' => __( 'Footer settings', 'hiiwp' ),
    'icon' => 'dashicons-download'
) );




Kirki::add_field( 'hiiwp', array(
	'type'        => 'background',
    'settings'    => 'footer_background',
    'label'       => __( 'Footer Background', 'hiiwp' ),
    'description' => __('Choose a background image and color for the entire footer.', 'hiiwp'),
    'section'     => $section,
    'priority'    => 1,
    'default'     => $hiilite_options['footer_background'],
) );
// Footer  order Top
Kirki::add_field( 'hiiwp', array(
	'type'        => 'color',
    'settings'    => 'footer_border_color',
    'label'       => __( 'Footer Border Top Color', 'hiiwp' ),
    'description' => __('Define top border color for Footer Top', 'hiiwp'),
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
    'label'       => __( 'Show Footer Top', 'hiiwp' ),
    'description' => __('Enabling this option will show Footer Top area', 'hiiwp'),
    'section'     => $section,
    'default'     => $hiilite_options['show_footer_top_yesno'],
    'priority'    => 1,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_in_grid',
    'label'       => __( 'Footer in Grid', 'hiiwp' ),
    'description' => __('Enabling this option will place Footer Top content in grid', 'hiiwp'),
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
    'label'       => __( 'Footer Top Columns', 'hiiwp' ),
    'description'  => __( 'Choose which columns show for Footer top area', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options[ 'footer_top_columns' ],
    'priority'    => 6,
    'choices'     => array(
		'footer_column_1' => esc_attr__( 'Column 1', 'hiiwp' ),
		'footer_column_2' => esc_attr__( 'Column 2', 'hiiwp' ),
		'footer_column_3' => esc_attr__( 'Column 3', 'hiiwp' ),
		'footer_column_4' => esc_attr__( 'Column 4', 'hiiwp' ),
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
    'label'       => __( 'Footer Top Background', 'hiiwp' ),
    'description' => __('Choose footer top background image and color', 'hiiwp'),
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
	'label'       => __( 'Footer Top Padding', 'hiiwp' ),
	'description' => __('Set padding for footer top section', 'hiiwp'),
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
    'label'       => __( 'Use Footer Page (beta)', 'hiiwp' ),
    'description'  => __( 'Enable to use a pages content as the footer', 'hiiwp' ),
    'section'     => $section,
    'default'     => false,
    'priority'    => 7,
) );

Kirki::add_field( 'hiiwp', array(
	'type'        => 'dropdown-pages',
	'settings'    => 'footer_page_content',
	'label'       => __( 'Footer Content Page (beta)', 'hiiwp' ),
	'description'  => __( 'Select the page to use as the footer for the site', 'hiiwp' ),
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
    'label'       => __( 'Show Footer Bottom', 'hiiwp' ),
    'description'  => __( 'Enabling this option will show Footer Bottom area', 'hiiwp' ),
    'section'     => $section,
    'default'     => true,
    'priority'    => 8,
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'footer_bottom_in_grid',
    'label'       => __( 'Footer Bottom in Grid', 'hiiwp' ),
    'description' => __('Enabling this option will place Footer bottom content in grid', 'hiiwp'),
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
    'label'       => __( 'Footer Bottom Columns', 'hiiwp' ),
    'description'  => __( 'Choose which columns show for Footer Bottom area', 'hiiwp' ),
    'section'     => $section,
    'priority'    => 8,
    'choices'     => array(
		'footer_bottom_left' => esc_attr__( 'Left', 'hiiwp' ),
		'footer_bottom_center' => esc_attr__( 'Center', 'hiiwp' ),
		'footer_bottom_right' => esc_attr__( 'Right', 'hiiwp' ),
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
    'label'       => __( 'Footer Bottom Background Color', 'hiiwp' ),
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
    'description' => __('Define top border color for Footer Bottom', 'hiiwp'),
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
	'label'       => __( 'Footer Bottom Padding', 'hiiwp' ),
	'description' => __('Set padding for footer bottom section', 'hiiwp'),
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
	'description' => __('Change the copy right text in the footer bottom', 'hiiwp'),
	'section'     => $section,
	'default'     => '<small>Copyright © '.date('Y').' All rights reserved. <a href="https://hiilite.com/services/website-design/" target="_blank" title="Web Design by Hiilite">Web Design</a> and <a href="https://hiilite.com/services/seo/" target="_blank" title="SEO by Hiilite">SEO</a> by <a href="https://hiilite.com/" target="_blank" title="Web Design and SEO by Hiilite">Hiilite</a></small>',
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