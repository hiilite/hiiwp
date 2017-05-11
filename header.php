<?php
/**
 * HiiWP: Header
 *
 * WordPress header file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2016, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1.0
 */
global $hiilite_options;


$post_id = get_the_id();
$post_object = get_post( $post_id );


// Page Title
$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
if(get_post_meta(get_the_id(), 'page_seo_title', true) != ''){
	$page_title = get_post_meta(get_the_id(), 'page_seo_title', true);
} elseif(get_theme_mod('site_seo_title') != '' && is_front_page()) {
	$page_title = get_theme_mod('site_seo_title');
} else {
	$page_title = wp_title('|',false,'right').$brand_title;
}

// Page Description
if(get_post_meta(get_the_id(), 'page_seo_description', true) != ''){
	$page_description = get_post_meta(get_the_id(), 'page_seo_description', true);
} elseif(get_theme_mod('site_seo_description') != '' && is_front_page()) {
	$page_description = get_theme_mod('site_seo_description');
} elseif (!is_tax() && is_singular()) {
	$the_content = $post_object->post_content;
	$the_content = substr(preg_replace('/\[.*.\]|\n+/', '', $the_content), 0, 165);
	$page_description = strip_tags($the_content);
}


?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="<?=$page_description?>">
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<link rel="shortcut icon" href="<?=get_theme_mod('favicon');?>"> 
<link rel="mask-icon" href="<?=get_theme_mod('safari_icon');?>" color="<?=get_theme_mod('safari_icon_color');?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"><?php 
	
wp_head(); 
?></head>
<body <?php body_class(); ?>>
<?php 
do_action( 'hii_before_header' );
if ( is_customize_preview() ) : ?>
<div class="customizer_quick_links">
	<button class="customizer-edit font-edit" data-control='{ "name":"typography_h1_font" }'><?php esc_html_e( 'Heading Fonts', 'hiiwp' ); ?></button>
	<button class="customizer-edit font-edit" data-control='{ "name":"text_font" }'><?php esc_html_e( 'Text Fonts', 'hiiwp' ); ?></button>
    <button class="customizer-edit" data-control='{ "name":"custom_css" }'><?php esc_html_e( 'CSS', 'hiiwp' ); ?></button>
</div>
<?php endif; ?>
    
	<div class="wrapper">
		<div class="wrapper_inner">
			<aside id="header_top">
				<div class="container_inner"><div class="in_grid">
					<?php 
					do_action( 'hii_header_top_left' );
					
					do_action( 'hii_header_top_right' );	
					?>
				</div></div>
			</aside>
			
			<?php 
				if(get_theme_mod( 'header_top_home') == true && get_theme_mod('header_top_home_content') != false && is_front_page()){
					$hometop_id = get_theme_mod('header_top_home_content');
					$hometop = new WP_Query(array('page_id' => $hometop_id));
					if($hometop->have_posts()){
						echo '<aside id="header_home_top">';
						while($hometop->have_posts()){
							$hometop->the_post();
							
							the_content();
						}
						echo '</aside>';
					}
				} elseif (get_theme_mod( 'header_top_home') == true && !is_front_page()){					
					echo '<aside id="header_top_pages"></aside>';
				
				}
				
			?>
			<!-- HEADER -->
			<header id="main_header" class="<?=$hiilite_options['header_type'];?>">
<?php if(is_customize_preview()) echo '<div class="customizer_quick_links"><button class="customizer-edit" data-control=\'{ "name":"header_in_grid" }\'>Edit Header</button><button class="customizer-edit font-edit" data-control=\'{ "name":"main_menu_font" }\'>Header & Menu Fonts</button></div>'; ?>
				<div class="container_inner">
					<hgroup style="display: none;">
						<h1><?=$page_title?></h1>
					</hgroup>
					<?php 
				if($hiilite_options['header_in_grid']) { echo '<div class="in_grid">'; }
				
					if($hiilite_options['header_center_left_on']){ ?>
						<div id="header_center_left" class="flex-item">
							<?php 
							if ( is_active_sidebar( 'header_center_left' ) ) :
								if(!dynamic_sidebar( 'header_center_left' )){}
							endif;
							wp_nav_menu(array(
									'menu' =>  'left-menu',
									'container' => 'nav',
									'items_wrap'  => '<ul id="%1s" class="%2$s left-menu">%3$s</ul>',
									'theme_location' => 'left-menu',
									'fallback_cb'    => false
								));		
						?></div><?php
					} 
					
					
					if(get_theme_mod('hide_logo') != true):
						?><div id="logo_container" class="<?php if($hiilite_options['header_center_right_on'] && !$hiilite_options['header_center_left_on']){ echo 'align-left';} ?>">
<?php if(is_customize_preview()) echo '<div class="customizer_quick_links"><button class="customizer-edit" data-control=\'{"name":"main_logo"}\'>Edit Logo</button></div>';?>
		
							
							<a href="<?php bloginfo('url'); ?>">
								<img src="<?=$hiilite_options['main_logo'];?>" width="<?=$hiilite_options['logo_width'];?>" alt="<?=$page_title?>" height="<?=$hiilite_options['logo_height'];?>">
							</a>
						</div><?php 
					endif;
					
					if($hiilite_options['header_center_right_on'] && $hiilite_options['header_type'] != 'regular'){ ?>
						<div id="header_center_right" class="flex-item"><?php 
						if ( is_active_sidebar( 'header_center_right' ) ) :
							if(!dynamic_sidebar( 'header_center_right' )){}
						endif;

						wp_nav_menu(array(
								'menu' =>  'right-menu',
								'container' => 'nav',
								'items_wrap'  => '<ul id="%1s" class="%2$s right-menu">%3$s</ul>',
								'theme_location' => 'right-menu',
								'fallback_cb'    => false
							));	
						?></div><?php
					} 
					wp_nav_menu(array(
						'menu' =>  'header-menu',
						'container' => 'nav',
						'container_class' => 'flex-item',
						'container_id' => 'main-nav',
						'items_wrap'  => '<ul id="%1s" class="%2$s main-menu">%3$s</ul>',
						'theme_location' => 'header-menu',
						'fallback_cb'    => false
					)); 
					
					if($hiilite_options['header_center_right_on'] && $hiilite_options['header_type'] == 'regular'){ 
						if ( is_active_sidebar( 'header_center_right' ) ) :
							if(!dynamic_sidebar( 'header_center_right' )){}
						endif;
						
						wp_nav_menu(array(
								'menu' =>  'right-menu',
								'container' => 'div',
								'container_class' => 'align-right flex-item',
								'container_id' => 'header_center_right',
								'items_wrap'  => '<ul id="%1s" class="%2$s right-menu">%3$s</ul>',
								'theme_location' => 'right-menu',
								'fallback_cb'    => false
							));	
					} ?>
				<?php if($hiilite_options['header_in_grid']) { echo '</div>'; } ?>
				</div>
				<?php if($hiilite_options['header_bottom_on']): ?>
				<aside id="header_bottom" class="flex-item">
					<div class="container_inner">
						<div id="header_bottom_left">
							<?php
							if ( is_active_sidebar( 'header_bottom_left' ) ) :
								dynamic_sidebar( 'header_bottom_left' );
							endif;
							?>
						</div>
						<div id="header_bottom_right">
							<?php
							if ( is_active_sidebar( 'header_bottom_right' ) ) :
								dynamic_sidebar( 'header_bottom_right' );
							endif;
							?>
						</div>
					</div>
				</aside>
				</aside>
				<?php endif; ?>
			</header><?php
do_action( 'hii_before_content' );
?>