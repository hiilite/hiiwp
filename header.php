<?php
/*
*	
*	header.php
*	TODO:
*	
*	
*/
global $hiilite_options;
if(isset($_GET['fromApp'])){
	header("Access-Control-Allow-Origin: *");
	$hiilite_options['fromApp'] = true;
} else {
	$hiilite_options['fromApp'] = false;
}
if(isset($_GET['subpage'])){ 
	$hiilite_options['subpage'] = true;
} else {
	$hiilite_options['subpage'] = false;
}

$post_id = get_the_id();
$post_object = get_post( $post_id );

if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
	$hiilite_options['amp'] = false;
} else {
	$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
}
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';

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

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );
    $replace = array('>','<','\\1');
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
} 
ob_start("sanitize_output");
if(!$hiilite_options['subpage']):
?><!doctype html>
<html <?php if(isset($hiilite_options['amp'])) echo 'amp'; ?> lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="<?=$page_description?>">
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<link rel="shortcut icon" href="<?=get_theme_mod('favicon');?>"> 
<link rel="mask-icon" href="<?=get_theme_mod('safari_icon');?>" color="<?=get_theme_mod('safari_icon_color');?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">



<?php if($hiilite_options['amp']) { ?>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 1s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 1s steps(1,end) 0s 1 normal both;animation:-amp-start 1s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<?php } 
	
wp_head(); 
	

ob_start();
include_once('css/main-css.php');

if(!$hiilite_options['amp']){
	include_once('css/non-amp-css.php');
	$body = $maincss = ob_get_clean();
} else {
	$body = str_replace("!important", "", $maincss);
}
echo minify_css($body);

 ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
		<div class="wrapper_inner">
			<?php if($hiilite_options['subdomain'] != 'iframe'): ?>
			<aside id="header_top">
				<div class="container_inner"><div class="in_grid">
					<?php 
						if($hiilite_options['header_top_left'] || get_theme_mod('header_top_area_yesno') == true){ ?>
					<div id="header_top_left" class="flex-item">
						<?php 
						//if ( is_active_sidebar( 'header_top_left' ) ) :
							if(!dynamic_sidebar( 'header_top_left' )){}
						//endif;
						?>
					</div>
					<?php } 
					if($hiilite_options['header_top_right'] || get_theme_mod('header_top_area_yesno') == true){ ?>
					<div id="header_top_right" class="align-right flex-item">
						<?php 
						if ( is_active_sidebar( 'header_top_right' ) ) :
							if(!dynamic_sidebar( 'header_top_right' )){}
						endif;
						?>
					</div>
					<?php } ?>
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
			<header id="main_header" class="<?=$hiilite_options['header_type'];?>"><div class="container_inner">
				<?php if($hiilite_options['header_in_grid']) { echo '<div class="in_grid">'; }
					if($hiilite_options['header_center_left_on']){ ?>
					<div id="header_center_left" class="align-left flex-item">
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
					} ?>
					<div id="logo_container" class="flex-item <?php if($hiilite_options['header_center_right_on'] && !$hiilite_options['header_center_left_on']){ echo 'align-left';} ?>">
						<a href="<?php bloginfo('url'); ?>">
							<<?=$_amp?>img src="<?=$hiilite_options['main_logo'];?>" width="<?=$hiilite_options['logo_width'];?>" height="<?=$hiilite_options['logo_height'];?>"><?=($_amp!='')?'</amp-img>':'';?>
						</a>
					</div>

					<?php if($hiilite_options['header_center_right_on']){ ?>
					<div id="header_center_right" class="align-right flex-item">
						<?php 
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
			
				<aside id="header_bottom" class="flex-item">
					<div class="container_inner">
						<?php if($hiilite_options['header_in_grid']) { echo '<div class="in_grid">'; } 
						if(get_theme_mod( 'header_bottom_on', false)){ 
							wp_nav_menu(array(
									'menu' =>  'right-menu',
									'container' => 'div',
									'container_class' => 'align-center flex-item',
									'container_id' => 'header_bottom_menu',
									'items_wrap'  => '<ul id="%1s" class="%2$s bottom-menu">%3$s</ul>',
									'theme_location' => 'bottom-menu',
									'fallback_cb'    => false
								));	
						}
						if($hiilite_options['header_in_grid']) { echo '</div>'; } ?>
					</div>
				</aside>
			</header>
			<?php endif; //end iframe check ?>
<?php 
if($hiilite_options['fromApp']){ echo '<div id="content_load">';}
endif; //end subpage check ?>
			