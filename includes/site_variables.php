<?php
// SETTING
/*
 *	HEADER -> MENUS
 */
$hiilite_options = array();
/*
 *	GENERAL
 */
 
$hiilite_options['default_font']				= get_theme_mod( 'default_font', array(
        'font-family'    => 'Open Sans',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'text-transform' => 'none',
        'color'          => '#333333',
    ) ); 
$hiilite_options['color_one']					= get_theme_mod( 'color_one', 'rgba(48,181,196,1)');
$hiilite_options['color_two']					= get_theme_mod( 'color_two', '#303030');
$hiilite_options['color_three']					= get_theme_mod( 'color_three', '#b4b4b4');
$hiilite_options['color_four']					= get_theme_mod( 'color_four', '#b4b4b4');
$hiilite_options['color_five']					= get_theme_mod( 'color_five', '');
$hiilite_options['default_background_color']	= get_theme_mod( 'default_background_color', '');
$hiilite_options['secondary_background_color']	= get_theme_mod( 'secondary_background_color', '');
/*$hiilite_options['selection_color']				= get_theme_mod( 'selection_color', '');*/

$hiilite_options['grid_width']					= get_theme_mod( 'grid_width', '1100px');
 
$hiilite_options['portfolio_on'] 				= get_theme_mod( 'portfolio_on', true);
$hiilite_options['portfolio_title'] 			= get_theme_mod( 'portfolio_title', 'Portfolio');
$hiilite_options['portfolio_slug'] 				= get_theme_mod( 'portfolio_slug', 'portfolio');
$hiilite_options['portfolio_tax_title'] 		= get_theme_mod( 'portfolio_tax_title', 'Work');
$hiilite_options['portfolio_tax_slug'] 			= get_theme_mod( 'portfolio_tax_slug', 'work');
$hiilite_options['portfolio_template']			= get_theme_mod( 'portfolio_template', 'default');
$hiilite_options['portfolio_background']		= get_theme_mod( 'portfolio_background', 'rgba(255,255,255,0)');
$hiilite_options['portfolio_panel_background']	= get_theme_mod( 'portfolio_panel_background', 'rgba(255,255,255,0)');
$hiilite_options['portfolio_info_colors']		= get_theme_mod( 'portfolio_info_colors', array(
        'title'    => '#333',
        'text'     => '#333',
        'link'     => '#333',
        'hover'    => '#333',
    ) ); 
$hiilite_options['show_more_projects']		= get_theme_mod( 'show_more_projects', false);

$hiilite_options['teams_on'] 					= get_theme_mod('teams_on', false);
$hiilite_options['teams_title'] 				= get_theme_mod('teams_title', 'Team');
$hiilite_options['teams_slug'] 					= get_theme_mod('teams_slug', 'team');
$hiilite_options['team_tax_title'] 				= get_theme_mod('team_tax_title', 'Position');
$hiilite_options['team_tax_slug'] 				= get_theme_mod('team_tax_slug', 'position');

$hiilite_options['menus_on'] 					= get_theme_mod('menus_on', false);
$hiilite_options['menu_title'] 					= get_theme_mod('menu_title', 'Menu');
$hiilite_options['menu_slug'] 					= get_theme_mod('menu_slug', 'menu');
$hiilite_options['menu_tax_title'] 				= get_theme_mod('menu_tax_title', 'Menu Section');
$hiilite_options['menu_tax_slug'] 				= get_theme_mod('menu_tax_slug', 'menu-section');

$hiilite_options['testimonials_on'] 			= get_theme_mod('testimonials_on', false);
$hiilite_options['testimonials_title'] 			= get_theme_mod('testimonials_title', 'Testimonials');
$hiilite_options['testimonials_slug'] 			= get_theme_mod('testimonials_slug', 'testimonials');
$hiilite_options['testimonials_tax_title'] 		= get_theme_mod('testimonials_tax_title', 'Testimonials Categories');
$hiilite_options['testimonials_tax_slug'] 		= get_theme_mod('testimonials_tax_slug', 'testimonials_category');

$hiilite_options['testimonials_body_font'] 			= get_theme_mod('testimonials_body_font', array(
        'font-family'    => 'Lato',
        'variant'        => '300italic',
        'font-size'      => '1.3em',
        'line-height'    => '2',
        'letter-spacing' => '0px',
        'color'          => $hiilite_options['color_four'],
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ));
$hiilite_options['testimonials_author_font'] 		= get_theme_mod('testimonials_author_font', array(
        'font-family'    => 'Lato',
        'variant'        => '700',
        'font-size'      => '1em',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => $hiilite_options['color_four'],
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ));
$hiilite_options['testimonials_author_padding'] 				= get_theme_mod( 'testimonials_author_padding', array(
		'top'    => '0',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	));
$hiilite_options['testimonials_body_padding'] 				= get_theme_mod( 'testimonials_body_padding', array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '0',
		'left'   => '1em',
	));




$hiilite_options['custom_css']					= get_theme_mod( 'custom_css', '');
$hiilite_options['admin_custom_css']			= get_theme_mod( 'admin_custom_css', '');
$hiilite_options['custom_js']					= get_theme_mod( 'custom_js', '');

$hiilite_options['heading_font']				= get_theme_mod( 'heading_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '400',
        'letter-spacing' => '0px',
        'color'          => $hiilite_options['color_two'],
    ) );

/*
 * LOGO
 */
$hiilite_options['main_logo']					= get_theme_mod('main_logo', get_template_directory_uri().'/images/Hiilite_Hii_Logo.png');
$image_id = attachment_url_to_postid( $hiilite_options['main_logo'] );
if( isset( $image_id ) ) {
  $image_url  = wp_get_attachment_metadata($image_id); 
}

$hiilite_options['logo_size_mod'] 				= get_theme_mod( 'logo_size_mod', 100);
$hiilite_options['logo_padding'] 				= get_theme_mod( 'logo_padding', array(
		'top'    => '0',
		'right'  => '1em',
		'bottom' => '0',
		'left'   => '1em',
	));

$hiilite_options['favicon']						= get_theme_mod('favicon', get_template_directory_uri().'/images/favicon.png');
$hiilite_options['safari_icon']					= get_theme_mod('safari_icon', get_template_directory_uri().'/images/website_icon.svg');
$hiilite_options['safari_icon_color']			= get_theme_mod('safari_icon_color', $hiilite_options['color_one']);


$hiilite_options['logo_width']					= isset($image_url['width'])?($image_url['width'] * ($hiilite_options['logo_size_mod'] / 100)):(150 * ($hiilite_options['logo_size_mod'] / 100));
$hiilite_options['logo_height']					= isset($image_url['height'])?($image_url['height'] * ($hiilite_options['logo_size_mod'] / 100)):'auto';

// ?
$hiilite_options['color_palette'] 				= array(
	'color_one' 	=> $hiilite_options['color_one'], 
	'color_two' 	=> $hiilite_options['color_two'], 
	'color_three' 	=> $hiilite_options['color_three'], 
	'color_four' 	=> $hiilite_options['color_four'], 
	'color_five' 	=> $hiilite_options['color_five']);
/*
 * HEADER
 *
 * HEADER -> HEADER
 */
$hiilite_options['header_in_grid']				= get_theme_mod( 'header_in_grid', true );
$hiilite_options['header_type'] 				= get_theme_mod( 'header_type', 'regular'); // regular | centered | fixed
$hiilite_options['header_content_under']		= get_theme_mod( 'header_content_under', false);

$hiilite_options['header_padding'] 				= get_theme_mod( 'header_padding', array(
		'top'    => '1em',
		'right'  => '0',
		'bottom' => '1em',
		'left'   => '0',
	));

$hiilite_options['header_background'] = get_theme_mod( 'header_background', array(
	'background-color'    => '#fff',
	'background-image'    => '',
	'background-repeat'   => 'no-repeat',
	'background-size'     => 'cover',
	'background-attachment'   => 'scroll',
	'background-position' => 'left-top',
));

$hiilite_options['header_above_content'] = get_theme_mod('header_above_content', $hiilite_options['header_content_under']);


$hiilite_options['header_top_area_yesno']		= get_theme_mod( 'header_top_area_yesno', false );

$hiilite_options['header_top_background_color']	= get_theme_mod( 'header_top_background_color', 'rgba(248,248,248,1)' );
$hiilite_options['header_top_border_width']		= get_theme_mod( 'header_top_border_width', '0px' );
$hiilite_options['header_top_border_color']		= get_theme_mod( 'header_top_border_color', '' );

$hiilite_options['header_bottom_border_width']	= get_theme_mod( 'header_bottom_border_width', '0px' );
$hiilite_options['header_bottom_border_color']	= get_theme_mod( 'header_bottom_border_color', '' );

$hiilite_options['header_center_left_on']		= get_theme_mod( 'header_center_left_on', false );
$hiilite_options['header_center_right_on']		= get_theme_mod( 'header_center_right_on', false );

$hiilite_options['header_bottom_on']			= get_theme_mod( 'header_bottom_on', false );
$hiilite_options['header_bottom_background']	= get_theme_mod( 'header_bottom_background', '#fff' );

$hiilite_options['header_top_home']				= get_theme_mod( 'header_top_home', false );
$hiilite_options['header_top_home_content']		= get_theme_mod( 'header_top_home_content', false );

$hiilite_options['header_top_pages_background_color']	= get_theme_mod( 'header_top_pages_background_color', '#fff' );
$hiilite_options['header_top_pages_background_image']	= get_theme_mod( 'header_top_pages_background_image', '' );

$hiilite_options['header_top_bottom_border_width']	= get_theme_mod( 'header_top_bottom_border_width', '0px' );
$hiilite_options['header_top_bottom_border_color']	= get_theme_mod( 'header_top_bottom_border_color', '' );

$hiilite_options['header_top_pages_height']		= get_theme_mod( 'header_top_pages_height', '100px' );

/*
 * HEADER -> WOOCOMMERCE MENU CART	
 */
$hiilite_options['show_cart_menu']		= get_theme_mod( 'show_cart_menu', true );
$hiilite_options['cart_menu_layout']		= get_theme_mod( 'cart_menu_layout', 'icon-only' );
$hiilite_options['cart_menu_icon']		= get_theme_mod( 'cart_menu_icon', 'shopping-cart' );



/*
 * HEADER -> HEADER TOP	
 */
$hiilite_options['header_top_font']				= get_theme_mod( 'header_top_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '400',
        'font-size'      => ' ',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );



$hiilite_options['header_top_left']				= get_theme_mod( 'header_top_left', false );
$hiilite_options['header_top_center']			= get_theme_mod( 'header_top_center', false );
$hiilite_options['header_top_right']			= get_theme_mod( 'header_top_right', false );






// FOOTER 
$hiilite_options['footer_font_color']			= '#8c8880';


// FOOTER
$hiilite_options['footer_background'] = get_theme_mod( 'footer_background', array(
	'background-color'    => '#fff',
	'background-image'    => '',
	'background-repeat'   => 'no-repeat',
	'background-size'     => 'cover',
	'background-attachment'   => 'scroll',
	'background-position' => 'left-top',
));
    

$hiilite_options['footer_top_border_color']	= get_theme_mod( 'footer_top_border_color', '#eee' );
$hiilite_options['footer_top_border_width']	= get_theme_mod( 'footer_top_border_width', '1px' );
$hiilite_options['footer_top_background']	= get_theme_mod( 'footer_top_background', '#fff' );

$hiilite_options['footer_in_grid']			= get_theme_mod( 'footer_in_grid', true );

$hiilite_options['footer_padding']			= get_theme_mod( 'footer_padding', array(
	'top' 		=> '1em',
	'right' 	=> '1em',
	'bottom' 		=> '1em',
	'left' 	=> '1em',
	) );
	
$hiilite_options['footer_top_col1']			= get_theme_mod( 'footer_top_col1', true );
$hiilite_options['footer_top_col2']			= get_theme_mod( 'footer_top_col2', true );
$hiilite_options['footer_top_col3']			= get_theme_mod( 'footer_top_col3', true );
$hiilite_options['footer_top_col4']			= get_theme_mod( 'footer_top_col4', true );

$hiilite_options[ 'footer_top_columns' ]    = get_theme_mod( 'footer_top_columns',  array(
		'footer_column_1',
		'footer_column_2',
		'footer_column_3',
		'footer_column_4')
);
$hiilite_options['show_footer_top_yesno']	= get_theme_mod( 'show_footer_top_yesno', true );
$hiilite_options['footer_bottom_background_color']		= get_theme_mod( 'footer_bottom_background_color', '#c8c8c8' );
$hiilite_options['footer_bottom_center']	= get_theme_mod( 'footer_bottom_center', true );
$hiilite_options['footer_bottom_left']		= get_theme_mod( 'footer_bottom_left', false );
$hiilite_options['footer_bottom_right']		= get_theme_mod( 'footer_bottom_right', false );

$hiilite_options['footer_bottom_copyright_text'] = get_theme_mod('footer_bottom_copyright_text', '<small>Copyright © '.date('Y').' All rights reserved. <a href="https://hiilite.com/services/website-design/" target="_blank" rel="noopener" title="Web Design by Hiilite">Web Design</a>, <a href="https://photography.hiilite.com" target="_blank" rel="noopener" title="Photography Services by Hiilite">Photography</a>, <a href="https://hiilite.com/services/seo/" target="_blank" rel="noopener" title="SEO by Hiilite">SEO</a> by <a href="https://hiilite.com/" target="_blank" rel="noopener" title="Web Design, Photography and SEO by Hiilite">Hiilite</a></small>');


// MENU
$hiilite_options['menu_margin']				= get_theme_mod( 'menu_margin', array(
													'top' => 'auto',
													'right' => '0',
													'bottom' => 'auto',
													'left' => '0') 
												);
$hiilite_options['main_menu_font']			= get_theme_mod( 'main_menu_font', array(
												    'font-family'    => $hiilite_options['default_font']['font-family'],
												    'variant'        => '400',
												    'font-size'      => '16px',
												    'line-height'    => '1.5',
												    'text-transform' => 'None',
												    'letter-spacing' => '0',
												    'color'          => '#333333',
												) );


$hiilite_options['main_menu_align']			= get_theme_mod('main_menu_align', array( 'text-align' => 'right'));
$hiilite_options['left_menu_align']			= get_theme_mod('left_menu_align', array( 'text-align' => 'right'));
$hiilite_options['right_menu_align']		= get_theme_mod('right_menu_align', array( 'text-align' => 'left'));
$hiilite_options['bottom_menu_align']		= get_theme_mod('bottom_menu_align', array( 'text-align' => 'center'));

$hiilite_options['main_menu_padding']		= get_theme_mod('main_menu_padding', array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	));

												
$hiilite_options['main_menu_links_css']		= get_theme_mod( 'main_menu_links_css', '' );

$hiilite_options['main_menu_colors']		= get_theme_mod('main_menu_colors', array(
        'hover'   => '',
        'active'  => '',
        'hover_background'  => '',
    ));
  
$hiilite_options['moblie_menu_background_color'] = get_theme_mod( 'moblie_menu_background_color', '#ffffff' );
  
$hiilite_options['second_level_menu_font']	= get_theme_mod( 'second_level_menu_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => 'None',
        'color'			 => ' ',
    ) );
$hiilite_options['second_level_menu_colors']= get_theme_mod('second_level_menu_colors', array(
        'hover'   => '',
        'active'  => '',
        'hover_background'  => '',
    ));
    
    


$hiilite_options['third_level_menu_font']	= get_theme_mod( 'third_level_menu_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'text-transform' => 'None',
        'color'			 => ' ',
    ) );
 $hiilite_options['third_level_menu_colors']= get_theme_mod('third_level_menu_colors', array(
        'hover'   => '',
        'active'  => '',
        'hover_background'  => '',
    ));

$hiilite_options['dropdown_background_color'] = get_theme_mod( 'dropdown_background_color', 'rgba(255,255,255,1)' );
$hiilite_options['main_menu_background_color']	= get_theme_mod( 'main_menu_background_color', '' );
$hiilite_options['moblie_menu_background_color']	= get_theme_mod( 'moblie_menu_background_color', '#ffffff' );
$hiilite_options['mobile_menu_switch']		= get_theme_mod( 'mobile_menu_switch', '768px' );

$hiilite_options['mobile_menu_icon_color']	= get_theme_mod( 'mobile_menu_icon_color', '#9d9d9d' );
$hiilite_options['enable_search_bar_yesno'] = get_theme_mod( 'enable_search_bar_yesno', true );


// TITLE
$hiilite_options['show_page_titles']		= get_theme_mod( 'show_page_titles', true );
$hiilite_options['title_height']			= get_theme_mod( 'title_height', '100px' );
$hiilite_options['title_padding']			= get_theme_mod( 'title_padding', array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
	));
$hiilite_options['title_font']				= get_theme_mod( 'title_font', array(
	'font-family'    => 'Open Sans',
    'variant'        => '600',
    'font-size'      => '4rem',
    'line-height'    => '1',
    'letter-spacing' => '0',
    'text-transform' => 'uppercase',
    'color'          => '#222',
    'text-align'	 => 'center',
) );

$default_show_title_on = get_post_types(array(), 'names');
$hiilite_options['show_title_on'] 	= get_theme_mod( 'show_title_on', $default_show_title_on );
$hiilite_options['title_background'] = get_theme_mod( 'title_background', array(
	'color' => '#ffffff',
	'image' => '',
	'repeat' => 'no-repeat',
	'position' => 'left-top',
	'size' => 'cover',
	'attach' => 'fixed',
));



// FONTS
$hiilite_options['text_font']				= get_theme_mod( 'text_font', $hiilite_options['default_font']);
$hiilite_options['text_margin']				= get_theme_mod( 'text_margin', '1em');
$hiilite_options['typography_p_margin']				= get_theme_mod( 'typography_p_margin', array(
	'top'	=> '0',
	'bottom'=> $hiilite_options['text_margin'],
));

$hiilite_options['typography_h1_font']				= get_theme_mod( 'typography_h1_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '300',
        'font-size'      => '2.5rem',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'color'          => '#333',
        'text-align'	 => '',
    ) );
$hiilite_options['typography_h1_margin']			= get_theme_mod( 'typography_h1_margin', array(
	'top' 		=> '0',
	'bottom' 	=> '0.83em',
	) );

$hiilite_options['typography_h2_font']				= get_theme_mod( 'typography_h2_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '300',
        'font-size'      => '2rem',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'color'          => '#666',
        'text-align'	 => '',
    ) );
$hiilite_options['typography_h2_margin']			= get_theme_mod( 'typography_h2_margin', array(
	'top' 		=> '0',
	'bottom' 	=> '0.83em',
	) );
    
$hiilite_options['typography_h3_font']				= get_theme_mod( 'typography_h3_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '400',
        'font-size'      => '1.57rem',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'color'          => '#333',
        'text-align'	 => '',
    ) );
$hiilite_options['typography_h3_margin']			= get_theme_mod( 'typography_h3_margin', array(
	'top' 		=> '0',
	'bottom' 	=> '0.83em',
	) );    
	
$hiilite_options['typography_h4_font']				= get_theme_mod( 'typography_h4_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '600',
        'font-size'      => '1.33rem',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'color'          => '#333',
        'text-align'	 => '',
    ) );
$hiilite_options['typography_h4_margin']			= get_theme_mod( 'typography_h4_margin', array(
	'top' 		=> '0',
	'bottom' 	=> '0.83em',
	) );
    
$hiilite_options['typography_h5_font']				= get_theme_mod( 'typography_h5_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '600',
        'font-size'      => '0.84rem',
        'line-height'    => '1.5',
        'letter-spacing' => '0.15em',
        'text-transform' => 'uppercase',
        'color'          => '#767676',
        'text-align'	 => '',
    ) );
$hiilite_options['typography_h5_margin']			= get_theme_mod( 'typography_h5_margin', array(
	'top' 		=> '0',
	'bottom' 	=> '0.83em',
	) );
    
$hiilite_options['typography_h6_font']				= get_theme_mod( 'typography_h6_font', array(
        'font-family'    => $hiilite_options['default_font']['font-family'],
        'variant'        => '600',
        'font-size'      => '0.6375rem',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'color'          => '#333',
        'text-align'	 => '',
    ) );
$hiilite_options['typography_h6_margin']			= get_theme_mod( 'typography_h6_margin', array(
	'top' 		=> '0',
	'bottom' 	=> '0.83em',
	) );    
    
$hiilite_options['typography_footer_headings_font']				= get_theme_mod( 'typography_footer_headings_font', array(
        'font-family'    => 'Lato',
        'variant'        => '700',
        'font-size'      => '16px',
        'line-height'    => ' ',
        'letter-spacing' => '0',
        'text-transform' => 'uppercase',
        'color'          => ' ',
        'text-align'	 => '',
    ) );
    $hiilite_options['typography_footer_text_font']				= get_theme_mod( 'typography_footer_text_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
        'text-align'	 => '',
    ) );
    $hiilite_options['typography_footer_links_font']				= get_theme_mod( 'typography_footer_links_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );

$hiilite_options['typography_link_custom_css']	= get_theme_mod( 'typography_link_custom_css', 'a {
	text-decoration:none;
}' );
$hiilite_options['link_color']				=get_theme_mod( 'link_color', array(
        'link'    => $hiilite_options['color_one'],
        'hover'   => $hiilite_options['color_two'],
    ));
$hiilite_options['typography_link_color']	= get_theme_mod( 'typography_link_color', $hiilite_options['color_one'] );
$hiilite_options['typography_icon_custom_css']	= get_theme_mod( 'typography_icon_custom_css', '{
	background: '.$hiilite_options['color_one'].';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	color: white;
	line-height: 1.6em;
	border-radius: 2em;
}' );

/*
*	Default Button
*/
$hiilite_options['typography_button_default_font']	= get_theme_mod( 'typography_button_default_font', array(
        'font-family'    => 'Lato',
        'variant'        => '400',
        'font-size'      => '0.82em',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'text-align'	 => 'center',
        'text-transform' => 'uppercase',
        'color'          => $hiilite_options['color_two'],
        
        
    ) );
$hiilite_options['typography_button_default_background'] =  get_theme_mod( 'typography_button_default_background', array(
		'base' 	=> 'rgba(0,0,0,0)',
		'hover' => $hiilite_options['color_one'],
));
$hiilite_options['typography_button_default_hover_color'] =  get_theme_mod( 'typography_button_default_hover_color', '#ffffff');

$hiilite_options['typography_button_default_padding'] =  get_theme_mod('typography_button_default_padding', array(
		'top'    => '0.8em',
		'right'  => '2em',
		'bottom' => '0.8em',
		'left'   => '2em',
	));
$hiilite_options['typography_button_default_border_color'] =  get_theme_mod( 'typography_button_default_border_color', array(
		'base' 	=> $hiilite_options['color_two'],
		'hover' => $hiilite_options['color_one']
));
$hiilite_options['typography_button_default_border_width'] =  get_theme_mod( 'typography_button_default_border_width', '2px');
$hiilite_options['typography_button_default_border_radius'] =  get_theme_mod( 'typography_button_default_border_radius', '2px');
$hiilite_options['typography_button_custom_css']	= get_theme_mod( 'typography_button_custom_css', '.button {
	margin: 1em;
	text-decoration: none;
	display: inline-block;
}' );

/*
*	Primary Button
*/
$hiilite_options['typography_button_primary_font']	= get_theme_mod( 'typography_button_primary_font', array(
        'font-family'    => 'Lato',
        'variant'        => '400',
        'font-size'      => '0.82em',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'text-align'	 => 'center',
        'text-transform' => 'uppercase',
        'color'          => '#ffffff',
    ) );
$hiilite_options['typography_button_primary_background'] =  get_theme_mod( 'typography_button_primary_background', array(
	'base'	=> $hiilite_options['color_one'],
	'hover'	=> $hiilite_options['color_two']
));
$hiilite_options['typography_button_primary_hover_color'] =  get_theme_mod( 'typography_button_primary_hover_color', '#ffffff');

$hiilite_options['typography_button_primary_padding'] =  get_theme_mod('typography_button_primary_padding', array(
		'top'    => '0.8em',
		'right'  => '2em',
		'bottom' => '0.8em',
		'left'   => '2em',
	));
$hiilite_options['typography_button_primary_border_color'] =  get_theme_mod( 'typography_button_primary_border_color', array(
	'base'	=> $hiilite_options['color_one'],
	'hover'	=> $hiilite_options['color_two']
));
$hiilite_options['typography_button_primary_border_width'] =  get_theme_mod( 'typography_button_primary_border_width', '2px');
$hiilite_options['typography_button_primary_border_radius'] =  get_theme_mod( 'typography_button_primary_border_radius', '2px');
$hiilite_options['typography_button_primary_custom_css']	= get_theme_mod( 'typography_button_primary_custom_css', '.button-primary {}' );

/*
*	Secondary Button
*/
$hiilite_options['typography_button_secondary_font']	= get_theme_mod( 'typography_button_secondary_font', array(
        'font-family'    => 'Lato',
        'variant'        => '400',
        'font-size'      => '0.82em',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'text-align'	 => 'center',
        'text-transform' => 'uppercase',
        'color'          => '#ffffff',
    ) );
$hiilite_options['typography_button_secondary_background'] =  get_theme_mod( 'typography_button_secondary_background', array(
	'base'	=> 'rgba(255,255,255,0)',
	'hover'	=> $hiilite_options['color_three']
));
$hiilite_options['typography_button_secondary_hover_color'] =  get_theme_mod( 'typography_button_secondary_hover_color', '#303030');

$hiilite_options['typography_button_secondary_padding'] =  get_theme_mod('typography_button_secondary_padding', array(
		'top'    => '0.8em',
		'right'  => '2em',
		'bottom' => '0.8em',
		'left'   => '2em',
	));
$hiilite_options['typography_button_secondary_border_color'] =  get_theme_mod( 'typography_button_secondary_border_color', array(
	'base'	=> '#ffffff',
	'hover'	=>$hiilite_options['color_three']
));
$hiilite_options['typography_button_secondary_border_width'] =  get_theme_mod( 'typography_button_secondary_border_width', '2px');
$hiilite_options['typography_button_secondary_border_radius'] =  get_theme_mod( 'typography_button_secondary_border_radius', '2px');
$hiilite_options['typography_button_secondary_custom_css']	= get_theme_mod( 'typography_button_secondary_custom_css', '.button-secondary {}' );

/*
*	Custom Formats
*/
$hiilite_options['custom_format_1']			= get_theme_mod( 'custom_format_1', '.custom_format_1 {}' );
$hiilite_options['custom_format_2']			= get_theme_mod( 'custom_format_2', '.custom_format_2 {}' );
$hiilite_options['custom_format_3']			= get_theme_mod( 'custom_format_3', '.custom_format_3 {}' );

$hiilite_options['h1_color']					= '#635d5d';
$hiilite_options['h2_color']					= '#58b8a6';
$hiilite_options['h3_color']					= '#58b8a6';
$hiilite_options['h4_color']					= '#58b8a6';
$hiilite_options['h5_color']					= '#635d5d';
$hiilite_options['h6_color']					= '#635d5d';

$hiilite_options['icon_settings']				= get_theme_mod( 'icon_settings', array(
        'font-size'      => '',
        'line-height'    => '',
        'color'          => $hiilite_options['color_one'],
    ) );
// Social
$hiilite_options['typography_icon_custom_css']		= get_theme_mod('typography_icon_custom_css', '.fa-style-round {
	background: '.get_theme_mod( 'color_one', '#ef5022').';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	color: white;
	font-size: 1em;
	line-height: 1.6em;
	border-radius: 2em;
}
.fa-style-square {
	background: '.get_theme_mod( 'color_one', '#ef5022').';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	color: white;
	font-size: 1em;
	line-height: 1.6em;
	border-radius: 0.2em;
}
.fa-style-circle {
	color: '.get_theme_mod( 'color_one', '#ef5022').';
	display: inline-block;
	width: 1.6em;
	text-align: center;
	line-height: 1.6em;
	font-size: 1em;
	background: none;
	border-radius: 2em;
	border:1px solid '.get_theme_mod( 'color_one', '#ef5022').';
}
.fa-style-no-bg {
	color: '.get_theme_mod( 'color_one', '#ef5022').';
	font-size:1.6em;
	display: inline-block;
	width: 1.6em;
	text-align: center;
	line-height: 1.6em;
	border: none;
	background: none;
}');

// BLOG
$hiilite_options['blog_layouts']			= get_theme_mod( 'blog_layouts', 'full-width' );
$hiilite_options['blog_full_width']			= get_theme_mod( 'blog_full_width', false );
$hiilite_options['blog_hide_password_protected_posts']= get_theme_mod( 'blog_hide_password_protected_posts', true );
$hiilite_options['blog_col']				= get_theme_mod( 'blog_col', '' );
$hiilite_options['blog_img_pos']			= get_theme_mod( 'blog_img_pos', 'image-left' );
$hiilite_options['blog_title_position']		= get_theme_mod( 'blog_title_position', 'title-below' );
$hiilite_options['blog_title_show']			= get_theme_mod( 'blog_title_show', true );
$hiilite_options['blog_heading_tag']		= get_theme_mod( 'blog_heading_tag', 'h2' );
$hiilite_options['blog_date_pos']			= get_theme_mod( 'blog_date_pos', 'date-above' );
$hiilite_options['blog_cats_show']			= get_theme_mod( 'blog_cats_show', true );
$hiilite_options['blog_meta_show']			= get_theme_mod( 'blog_meta_show', true );
$hiilite_options['blog_excerpt_show']		= get_theme_mod( 'blog_excerpt_show', true );
$hiilite_options['blog_excerpt_len']		= get_theme_mod( 'blog_excerpt_len', '55' );
$hiilite_options['blog_more_show']			= get_theme_mod( 'blog_more_show', false );

$hiilite_options['blog_more_type']			= get_theme_mod( 'blog_more_type', 'button' );
$hiilite_options['blog_more_text']			= get_theme_mod( 'blog_more_text', esc_attr__( 'Read More', 'hiiwp') );


$hiilite_options['blog_more_ex']			= get_theme_mod( 'blog_more_ex', __('Read More', 'hiiwp') );
$hiilite_options['blog_pag_show']			= get_theme_mod( 'blog_pag_show', true );
$hiilite_options['blog_pag_style']			= get_theme_mod( 'blog_pag_style', 'option-1' );
$hiilite_options['blog_sidebar_show']		= get_theme_mod( 'blog_sidebar_show', true );
$hiilite_options['blog_author_bio_show']	= get_theme_mod( 'blog_author_bio_show', false );
$hiilite_options['blog_comments_show']		= get_theme_mod( 'blog_comments_show', true );
$hiilite_options['blog_rel_articles']		= get_theme_mod( 'blog_rel_articles', true );
$hiilite_options['single_full']				= get_theme_mod( 'single_full', false );
$hiilite_options['blog_show_featured_image']= get_theme_mod('blog_show_featured_image', true);
$hiilite_options['blog_show_sidebar']		= get_theme_mod('blog_show_sidebar', true);

$hiilite_options['blog_post_border_width']		       = get_theme_mod('blog_post_border_width', '0px');
$hiilite_options['blog_post_border_color']             = get_theme_mod('blog_post_border_color', 'rgba(193, 193, 193, 1)');
$hiilite_options['blog_roll_margin_top']               = get_theme_mod('blog_roll_margin_top', '0px');
$hiilite_options['blog_roll_margin_bottom']            = get_theme_mod('blog_roll_margin_bottom', '0px');
$hiilite_options['single_blog_post_padding_top']       = get_theme_mod('single_blog_post_padding_top', '0px');
$hiilite_options['single_blog_post_padding_bottom']    = get_theme_mod('single_blog_post_padding_bottom', '0px');
$hiilite_options['featured_img_padding_bottom']        = get_theme_mod('featured_img_padding_bottom', '1em');
$hiilite_options['blog_format_icon']                   = get_theme_mod('blog_format_icon', '#eeeeee');

$hiilite_options['blogs_image_style'] 	               = get_theme_mod( 'blogs_image_style', 'default' );
$hiilite_options['show_next_prev_posts']               = get_theme_mod('show_next_prev_posts', true);

$hiilite_options['blog_title_font']   = get_theme_mod('blog_title_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#333333'),
        'text-align'	=> 'left',
        'text-transform'	=> 'none',
    ) );

// SIDEBAR
$hiilite_options['sidebar_background']		= get_theme_mod( 'sidebar_background', '#f4f4f4');
$hiilite_options['sidebar_padding'] 				= get_theme_mod( 'sidebar_padding', array(
		'top'    => '1em',
		'right'  => '1em',
		'bottom' => '1em',
		'left'   => '1em',
	));
$hiilite_options['sidebar_border_width']		= get_theme_mod( 'sidebar_border_width', '0px');
$hiilite_options['sidebar_border_color']		= get_theme_mod( 'sidebar_border_color', '');

$hiilite_options['sidebar_widget_margin'] 				= get_theme_mod( 'sidebar_widget_margin', array(
		'top'    => '1em',
		'right'  => '0em',
		'bottom' => '1em',
		'left'   => '0em',
	));
$hiilite_options['sidebar_widget_padding'] 				= get_theme_mod( 'sidebar_widget_padding', array(
		'top'    => '0em',
		'right'  => '0em',
		'bottom' => '0em',
		'left'   => '0em',
	));
$hiilite_options['sidebar_widget_border_width']		= get_theme_mod( 'sidebar_widget_border_width', '0px');
$hiilite_options['sidebar_widget_border_color']		= get_theme_mod( 'sidebar_widget_border_color', '');

// PORTFOLIO
$hiilite_options['portfolio_layout']		= get_theme_mod( 'portfolio_layout', 'boxed' );

$hiilite_options['portfolio_image_style']	= get_theme_mod( 'portfolio_image_style', 'default' );
$hiilite_options['portfolio_show_info']		= get_theme_mod( 'portfolio_show_info', true );
$hiilite_options['portfolio_image_pos']		= get_theme_mod( 'portfolio_image_pos', 'image-behind' );
$hiilite_options['portfolio_columns']		= get_theme_mod( 'portfolio_columns', 'col-4' );
$hiilite_options['portfolio_show_filter']	= get_theme_mod( 'portfolio_show_filter', true );
$hiilite_options['portfolio_in_grid']		= get_theme_mod( 'portfolio_in_grid', true );
$hiilite_options['portfolio_show_post_title']= get_theme_mod( 'portfolio_show_post_title', false );
$hiilite_options['portfolio_heading_size']	= get_theme_mod( 'portfolio_heading_size', 'h5' );

$hiilite_options['portfolio_heading_font']	= get_theme_mod( 'portfolio_heading_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => '#ffffff',
        'text-align'	=> 'center',
        'text-transform'	=> 'uppercase',
    ) );
    


$hiilite_options['portfolio_show_post_meta']= get_theme_mod( 'portfolio_show_post_meta', false );
$hiilite_options['portfolio_meta_font']	= get_theme_mod( 'portfolio_meta_font', array(
        'font-family'    => ' ',
        'variant'        => '300',
        'font-size'      => '13px',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => '#ffffff',
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ) );
    
$hiilite_options['portfolio_add_padding']	= get_theme_mod( 'portfolio_add_padding', '20px' );

$hiilite_options['portfolio_excerpt_on']	= get_theme_mod( 'portfolio_excerpt_on', true );
$hiilite_options['portfolio_excerpt_length']= get_theme_mod( 'portfolio_excerpt_length', '20' );

$hiilite_options['portfolio_excerpt_font']	= get_theme_mod( 'portfolio_excerpt_font', array(
        'font-family'    => ' ',
        'variant'        => '300',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0px',
        'color'          => '#ffffff',
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ) );
$hiilite_options['portfolio_more_on']		= get_theme_mod( 'portfolio_more_on', true );

$hiilite_options['portfolio_more_text']		= get_theme_mod( 'portfolio_more_text', __('View', 'hiiwp') );
$hiilite_options['portfolio_button_style']	= get_theme_mod( 'portfolio_button_style', 'default' );
$hiilite_options['portfolio_button_align']	= get_theme_mod( 'portfolio_button_align', 'center' );
$hiilite_options['portfolio_border_width']	= get_theme_mod( 'portfolio_border_width', '0px' );
$hiilite_options['portfolio_border_color']	= get_theme_mod( 'portfolio_border_color', '#000000' );




$hiilite_options['portfolio_comments']		= get_theme_mod( 'portfolio_comments', false );
$hiilite_options['show_more_projects']		= get_theme_mod( 'show_more_projects', false );

$hiilite_options['portfolio_custom_css'] 	= get_theme_mod( 'portfolio_custom_css', '' );

// PAGINATION
$hiilite_options['pagination_active_page_color']	= get_theme_mod( 'pagination_active_page_color', '#818181' );
$hiilite_options['pagination_non_active_page_color']	= get_theme_mod( 'pagination_non_active_page_color', '#e1e1e1' );
$hiilite_options['pagination_text_color']	= get_theme_mod( 'pagination_text_color', '#ffffff' );

// EVENT
$hiilite_options['blog_date_style'] = get_theme_mod( 'blog_date_style', '' );


// TESTIMONIALS
$hiilite_options['testimonials_body_font']	= get_theme_mod( 'testimonials_body_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px', 
        'color'          => get_theme_mod('color_four','#333333'),
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ) );
    
$hiilite_options['testimonials_author_font']	= get_theme_mod( 'testimonials_author_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#333333'),
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ) );

// TEAMS
$hiilite_options['teams_cols'] 			= get_theme_mod( 'teams_cols', 'col-4' );
$hiilite_options['teams_title_show']	= get_theme_mod( 'teams_title_show', true );
$hiilite_options['teams_heading_tag']	= get_theme_mod( 'teams_heading_tag', 'h3' );
$hiilite_options['teams_heading_font']	= get_theme_mod( 'teams_heading_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#474646'),
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ) );
    
$hiilite_options['teams_show_image'] 	= get_theme_mod( 'teams_show_image', true );
$hiilite_options['teams_image_style'] 	= get_theme_mod( 'teams_image_style', 'default' );
$hiilite_options['teams_image_position']= get_theme_mod( 'teams_image_position', 'image-above' );
$hiilite_options['teams_show_position'] = get_theme_mod( 'teams_show_position', true );
$hiilite_options['teams_position_font']	= get_theme_mod( 'teams_position_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#474646'),
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ) );
$hiilite_options['teams_show_excerpt'] 	= get_theme_mod( 'teams_show_excerpt', false );
$hiilite_options['teams_excerpt_font']	= get_theme_mod( 'teams_excerpt_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#474646'),
        'text-align'	=> 'center',
        'text-transform'	=> 'none',
    ) );
$hiilite_options['teams_show_button'] 	= get_theme_mod( 'teams_show_button', false );
$hiilite_options['teams_button_text'] 	= get_theme_mod( 'teams_button_text', 'Contact' );
$hiilite_options['teams_button_style'] 	= get_theme_mod( 'teams_button_style', 'button-primary' );
$hiilite_options['teams_border_width'] 	= get_theme_mod( 'teams_border_width', '0px' );
$hiilite_options['teams_border_color'] 	= get_theme_mod( 'teams_border_color', '#f2f2f2' );

$hiilite_options['team_member_content_padding'] 	= get_theme_mod( 'team_member_content_padding', array(
	'top'    => '50px',
	'bottom' => '50px',
) );
$hiilite_options['team_member_show_image']		= get_theme_mod( 'team_member_show_image', true );
$hiilite_options['team_member_image_style']		= get_theme_mod( 'team_member_image_style', 'default' );
$hiilite_options['team_member_content_layout']	= get_theme_mod( 'team_member_content_layout', 'col-4' );
$hiilite_options['team_member_title_show']		= get_theme_mod( 'team_member_title_show', true );
$hiilite_options['team_member_heading_tag']		= get_theme_mod( 'team_member_heading_tag', 'h3' );
$hiilite_options['team_member_heading_font']	= get_theme_mod( 'team_member_heading_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#474646'),
        'text-align'	=> 'left',
        'text-transform'	=> 'none',
    ) );
$hiilite_options['team_member_show_position']	= get_theme_mod( 'team_member_show_position', true );
$hiilite_options['team_member_position_font']	= get_theme_mod( 'team_member_position_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => '0px',
        'color'          => get_theme_mod('color_four','#474646'),
        'text-align'	=> 'left',
        'text-transform'	=> 'none',
    ) );


$hiilite_options['product_default_image'] 		= get_theme_mod('product_default_image', '/wp-content/plugins/woocommerce/assets/images/placeholder.png');

if(class_exists( 'WooCommerce' )){
	$hiilite_options['is_woocommerce'] 			= (is_woocommerce())?true:false;
	$hiilite_options['shop_sidebar_show']		= get_theme_mod( 'shop_sidebar_show', false);
} else {
	$hiilite_options['is_woocommerce'] = false;
}

/**
 * hii_seo_setting_defaults
 * 
 * @var mixed
 * @access public
 *
 * Set the default variables for the CMB2 based theme options. The default options are then merged with the active 'hii_seo_settings' options, which will over write the defaults if set. This is then merged with the global $hiilite_options variable.
 *
 *	All default 'hii_seo_settings' values must be set to blank or a falsy value
 *
 */
$hii_seo_setting_defaults =  array(
	'defer_all_javascript'			=> false,
	'load_viewport_units_buggyfill'	=> false,
	'async_all_css'					=> false,
	'hiilite_developer'				=> false,
);

$hii_seo_setting = array_merge( $hii_seo_setting_defaults, get_option( 'hii_seo_settings', $hii_seo_setting_defaults ) );

$hiilite_options = array_merge($hiilite_options, $hii_seo_setting);
?>