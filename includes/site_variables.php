<?php
// SETTING
$urlParts = explode('.', $_SERVER['HTTP_HOST']);
$hiilite_options['subdomain'] = $urlParts[0];
// GENERAL
$hiilite_options['default_font']				= get_theme_mod( 'default_font', array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '14px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
    ) );
$hiilite_options['heading_font']				= get_theme_mod( 'heading_font', array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'letter-spacing' => '0',
        'color'          => '#333333',
    ) );
$hiilite_options['amp'] = get_theme_mod( 'amp', '0');
$hiilite_options['portfolio_on'] 				= get_theme_mod( 'portfolio_on', '0');
$hiilite_options['teams_on'] 					= get_theme_mod( 'teams_on', '0');
$hiilite_options['menus_on']					= get_theme_mod( 'menus_on', '0');

$hiilite_options['default_background_color']	= get_theme_mod( 'default_background_color', 'rgba(255,255,255,0.85)');
$hiilite_options['secondary_background_color']	= get_theme_mod( 'secondary_background_color', '#ebeef1');

$hiilite_options['grid_width']					= get_theme_mod( 'grid_width', '1100px');
$hiilite_options['custom_css']					= get_theme_mod( 'custom_css', '' );


$hiilite_options['analytics_id']				= get_theme_mod( 'analytics_id', '');
$hiilite_options['brand_seo_title']				= get_theme_mod( 'brand_seo_title', get_bloginfo('title'));
$hiilite_options['site_seo_title']				= get_theme_mod( 'site_seo_title', '');
$hiilite_options['site_seo_description']		= get_theme_mod( 'site_seo_description', get_bloginfo('description'));

// LOGO
$hiilite_options['main_logo']					= get_theme_mod('main_logo', get_template_directory_uri().'/images/logoNormal@2x.png');
$image_id = attachment_url_to_postid( $hiilite_options['main_logo'] );
if( isset( $image_id ) ) {
  $image_url  = wp_get_attachment_metadata($image_id); 
}

$hiilite_options['favicon']						= get_theme_mod('favicon', '');

$hiilite_options['logo_size_mod'] 				= (get_theme_mod( 'logo_size_mod', 100) / 100);

$hiilite_options['logo_width']					= isset($image_url['width'])?($image_url['width'] * $hiilite_options['logo_size_mod']):'183px';
$hiilite_options['logo_height']					= isset($image_url['height'])?($image_url['height'] * $hiilite_options['logo_size_mod']):'79px';

$hiilite_options['color_one']					= get_theme_mod( 'color_one', '#ef5022');
$hiilite_options['color_two']					= get_theme_mod( 'color_two', '#71be44');
$hiilite_options['color_three']					= get_theme_mod( 'color_three', '#2eb6c4');
$hiilite_options['color_four']					= get_theme_mod( 'color_four', '#555555');
$hiilite_options['color_five']					= get_theme_mod( 'color_five', '#8f52a0');
$hiilite_options['color_palette'] 				= array('color_one' => $hiilite_options['color_one'], 'color_two' => $hiilite_options['color_two'], 'color_three' 	=> $hiilite_options['color_three'], 'color_four' => $hiilite_options['color_four'], 'color_five' => $hiilite_options['color_five']);

// HEADER
$hiilite_options['header_type'] 				= get_theme_mod( 'header_type', 'regular'); // regular | centered | fixed
$hiilite_options['header_above_content'] 		= get_theme_mod( 'header_above_content', true);
$hiilite_options['header_background_image']		= get_theme_mod( 'header_background_image', '');
$hiilite_options['header_background_repeat']	= get_theme_mod( 'header_background_repeat', 'no-repeat');
$hiilite_options['header_background_size']	    = get_theme_mod( 'header_background_size', 'cover');
$hiilite_options['header_background_attach']	= get_theme_mod( 'header_background_attach', 'fixed');
$hiilite_options['header_background_position']	= get_theme_mod( 'header_background_position', 'left-top');
$hiilite_options['header_background_color']		= get_theme_mod( 'header_background_color', '#ffffff' );
    
$hiilite_options['header_line_height']			= get_theme_mod( 'header_line_height', '30px');


$hiilite_options['header_top_border_color']		= get_theme_mod( 'header_top_border_color', '#ef5022' );
$hiilite_options['header_top_border_width']		= get_theme_mod( 'header_top_border_width', '3px' );

$hiilite_options['header_in_grid']				= get_theme_mod( 'header_in_grid', true );

$hiilite_options['header_top_left']				= get_theme_mod( 'header_top_left', false );
$hiilite_options['header_top_right']			= get_theme_mod( 'header_top_right', false );

$hiilite_options['header_top_background_color']		= get_theme_mod( 'header_top_background_color', '#f8f8f8' );

$hiilite_options['header_center_left_on'] 		= get_theme_mod( 'header_center_left_on', false );
$hiilite_options['header_center_right_on'] 		= get_theme_mod( 'header_center_right_on', false );

$hiilite_options['header_bottom_on']			= get_theme_mod( 'header_bottom_on', false );


// FOOTER 
$hiilite_options['footer_font_color']			= '#8c8880';


// FOOTER
$hiilite_options['footer_background_image']		= get_theme_mod( 'footer_background_image', '');
$hiilite_options['footer_background_repeat']	= get_theme_mod( 'footer_background_repeat', 'no-repeat');
$hiilite_options['footer_background_size']	    = get_theme_mod( 'footer_background_size', 'cover');
$hiilite_options['footer_background_attach']	= get_theme_mod( 'footer_background_attach', 'fixed');
$hiilite_options['footer_background_position']	= get_theme_mod( 'footer_background_position', 'left-top');
$hiilite_options['footer_background_color']		= get_theme_mod( 'footer_background_color', '#ffffff' );
    

//$hiilite_options['footer_top_border_color']	= get_theme_mod( 'footer_top_border_color', '' );
//$hiilite_options['footer_top_border_width']	= get_theme_mod( 'footer_top_border_width', '' );

$hiilite_options['footer_in_grid']			= get_theme_mod( 'footer_in_grid', true );

$hiilite_options['footer_top_col1']			= get_theme_mod( 'footer_top_col1', true );
$hiilite_options['footer_top_col2']			= get_theme_mod( 'footer_top_col2', true );
$hiilite_options['footer_top_col3']			= get_theme_mod( 'footer_top_col3', true );
$hiilite_options['footer_top_col4']			= get_theme_mod( 'footer_top_col4', true );


$hiilite_options['footer_bottom_background_color']		= get_theme_mod( 'footer_bottom_background_color', '#c8c8c8' );
$hiilite_options['footer_bottom_center']	= get_theme_mod( 'footer_bottom_center', true );
$hiilite_options['footer_bottom_left']		= get_theme_mod( 'footer_bottom_left', false );
$hiilite_options['footer_bottom_right']		= get_theme_mod( 'footer_bottom_right', false );



// MENU
$hiilite_options['main_menu_font']			= get_theme_mod( 'main_menu_font', array(
												    'font-family'    => 'Roboto',
												    'variant'        => '400',
												    'font-size'      => '14px',
												    'line-height'    => '1.5',
												    'letter-spacing' => '0',
												    'color'          => '#333333',
												) );
												
$hiilite_options['main_menu_links_css']		= get_theme_mod( 'main_menu_links_css', '' );
$hiilite_options['main_menu_background_color']	= get_theme_mod( 'main_menu_background_color', '' );
$hiilite_options['mobile_menu_switch']		= get_theme_mod( 'mobile_menu_switch', '768px' );


// TITLE
$hiilite_options['show_page_titles']		= get_theme_mod( 'show_page_titles', true );
$hiilite_options['title_height']			= get_theme_mod( 'title_height', '200px' );
$hiilite_options['title_font']				= get_theme_mod( 'title_font', $hiilite_options['heading_font'] );
$hiilite_options['title_background_image']		= get_theme_mod( 'title_background_image', '');
$hiilite_options['title_background_repeat']	= get_theme_mod( 'title_background_repeat', 'no-repeat');
$hiilite_options['title_background_size']	    = get_theme_mod( 'title_background_size', 'cover');
$hiilite_options['title_background_attach']	= get_theme_mod( 'title_background_attach', 'fixed');
$hiilite_options['title_background_position']	= get_theme_mod( 'title_background_position', 'left-top');
$hiilite_options['title_background_color']		= get_theme_mod( 'title_background_color', '#ffffff' );



// FONTS

$hiilite_options['typography_h1_font']				= get_theme_mod( 'typography_h1_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    
$hiilite_options['typography_h2_font']				= get_theme_mod( 'typography_h2_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    
$hiilite_options['typography_h3_font']				= get_theme_mod( 'typography_h3_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    
$hiilite_options['typography_h4_font']				= get_theme_mod( 'typography_h4_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    
$hiilite_options['typography_h5_font']				= get_theme_mod( 'typography_h5_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    
$hiilite_options['typography_h6_font']				= get_theme_mod( 'typography_h6_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    
    
$hiilite_options['typography_footer_headings_font']				= get_theme_mod( 'typography_footer_headings_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    $hiilite_options['typography_footer_text_font']				= get_theme_mod( 'typography_footer_text_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );
    $hiilite_options['typography_footer_links_font']				= get_theme_mod( 'typography_footer_links_font', array(
        'font-family'    => ' ',
        'variant'        => ' ',
        'font-size'      => ' ',
        'line-height'    => ' ',
        'letter-spacing' => ' ',
        'text-transform' => ' ',
        'color'          => ' ',
    ) );

$hiilite_options['typography_link_custom_css']	= get_theme_mod( 'typography_link_custom_css', '{text-decoration:none;}' );
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
$hiilite_options['typography_button_custom_css']	= get_theme_mod( 'typography_button_custom_css', '{
	border:2px solid '.$hiilite_options['color_one'].';
	background: none;
	text-transform: uppercase;
	color: '.$hiilite_options['color_one'].';
	padding: 0.5em 1em;
	margin: 1em 0;
	text-decoration: none;
	border-radius: 6px;
	display: inline-block;
}' );



$hiilite_options['custom_format_1']			= get_theme_mod( 'custom_format_1', '' );
$hiilite_options['custom_format_2']			= get_theme_mod( 'custom_format_2', '' );
$hiilite_options['custom_format_3']			= get_theme_mod( 'custom_format_3', '' );

$hiilite_options['h1_color']					= '#635d5d';
$hiilite_options['h2_color']					= '#58b8a6';
$hiilite_options['h3_color']					= '#58b8a6';
$hiilite_options['h4_color']					= '#58b8a6';
$hiilite_options['h5_color']					= '#635d5d';
$hiilite_options['h6_color']					= '#635d5d';



// BLOG
$hiilite_options['blog_layout']			= get_theme_mod( 'blog_layout', 'full-width' );
$hiilite_options['blog_columns']		= get_theme_mod( 'blog_columns', '' );
$hiilite_options['blog_image_pos']		= get_theme_mod( 'blog_image_pos', 'image-left' );
$hiilite_options['blog_title_pos']		= get_theme_mod( 'blog_title_pos', 'title-below' );
$hiilite_options['blog_title_on']		= get_theme_mod( 'blog_title_on', true );
$hiilite_options['blog_heading_size']	= get_theme_mod( 'blog_heading_size', 'h2' );
$hiilite_options['blog_cats_on']		= get_theme_mod( 'blog_cats_on', true );
$hiilite_options['blog_meta_on']		= get_theme_mod( 'blog_meta_on', true );
$hiilite_options['blog_excerpt_on']		= get_theme_mod( 'blog_excerpt_on', true );
$hiilite_options['blog_more_on']		= get_theme_mod( 'blog_more_on', true );


// PORTFOLIO
$hiilite_options['portfolio_slug']		= get_theme_mod( 'portfolio_slug', 'portfolio' );
$hiilite_options['portfolio_layout']		= get_theme_mod( 'portfolio_layout', 'masonry-h' );
$hiilite_options['portfolio_show_filter']	= get_theme_mod( 'portfolio_show_filter', true );

$hiilite_options['portfolio_in_grid']	= get_theme_mod( 'portfolio_in_grid', false );
$hiilite_options['portfolio_show_post_title']	= get_theme_mod( 'portfolio_show_post_title', false );
$hiilite_options['portfolio_show_post_meta']	= get_theme_mod( 'portfolio_show_post_meta', false );
$hiilite_options['portfolio_add_padding']	= get_theme_mod( 'portfolio_add_padding', '0px' );














	
?>