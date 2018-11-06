<?php
/**
 * HiiWP: Header
 *
 * WordPress header file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2016, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

$hiilite_options = Hii::get_options();
$bg_color = '';


echo do_action('hii_doctype');
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

<?php 
wp_head(); 
?></head>
<body <?php body_class(); ?>>
<?php 
do_action( 'hii_body_start' );
do_action( 'hii_before_header' );
?>
	<div class="wrapper">
		<div class="wrapper_inner">
			<?php
			if($hiilite_options['enable_search_bar_yesno'] == true)	:
			?>
			<aside id="main_search">
				<?php apply_filters( 'hii_search_form', get_search_form() ); ?>
			</aside>
			<?php
			endif; // end enable_search_bar_yesno
			
			if($hiilite_options['header_top_area_yesno'] == true): 
			do_action( 'hii_before_header_top' );
			?>
			<aside id="header_top">
				<div class="container_inner"><div class="in_grid">
					<?php 
					do_action( 'hii_header_top_left' );
					do_action( 'hii_header_top_center' );
					do_action( 'hii_header_top_right' );	
					?>
				</div></div>
			</aside>
			<?php 
			do_action( 'hii_after_header_top' );
			endif;
			
			if(get_theme_mod( 'header_top_home') == true && get_theme_mod('header_top_home_content') != false && is_front_page()){
				do_action( 'hii_before_header_top_home' );
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
				do_action( 'hii_after_header_top_home' );
			} elseif (get_theme_mod( 'header_top_home') == true && !is_front_page()){					
				echo '<aside id="header_top_pages"></aside>';
			
			}
			
			if(isset($post->ID)):
				
				$header_bg = (get_post_meta ( $post->ID, 'header_bg', true))?get_post_meta ( $post->ID, 'header_bg', true):false;
				if($header_bg) :
					$bg_color = 'style="background-color:'.$header_bg.'"';		
				elseif( post_type_exists('portfolio') && ( isset($hiilite_options['portfolio_on']) && $hiilite_options['portfolio_on'] == true  )):
					if($category = get_the_terms( $post->ID, $hiilite_options['portfolio_tax_slug'] )) {  
						$portfolio_work_color = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true))?get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true):false;	
						if($portfolio_work_color) {
							$bg_color = 'style="background-color:'.$portfolio_work_color.'"';	
						} 
					}
				endif;
			endif;
			
			do_action( 'hii_before_main_header' );	
			
			echo "<header id='main_header' class='". sanitize_html_class($hiilite_options['header_type'])."' {$bg_color}>";
				do_action('hii_header_hgroup');?>
				<div class="container_inner">
				<?php 
				if($hiilite_options['header_in_grid'] == true) { echo '<div class="in_grid">'; }
				
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
							
							<a href="<?php echo esc_url( home_url() ); ?>">
								<img src="<?php echo esc_url($hiilite_options['main_logo']);?>" width="<?php echo intval($hiilite_options['logo_width']);?>" alt="<?php echo hii_get_the_title();?>">
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
					
					echo '<div class="mobile_menu_button"><i class="fa fa-bars"></i></div>';
					wp_nav_menu(array(
						'menu' =>  'header-menu',
						'container' => 'nav',
						'container_class' => 'flex-item',
						'container_id' => 'main-nav',
						'items_wrap'  => '<ul id="%1s" class="%2$s main-menu">%3$s</ul>',
						'theme_location' => 'header-menu',
						'fallback_cb'    => false
					));
					
					if($hiilite_options['header_center_right_on'] && $hiilite_options['header_type'] == 'regular'){ ?>
						<div id="header_center_right" class="flex-item"><?php
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
						?></div><?php
					} 
					
				if($hiilite_options['header_in_grid'] == true) { echo '</div>'; } ?>
				</div>
				<?php if($hiilite_options['header_bottom_on']): 
				do_action( 'hii_before_header_bottom' );
				?>
				<aside id="header_bottom" class="flex-item">
					<div class="container_inner">
						<div class="in_grid">
							<div id="header_bottom_left">
								<?php
								do_action( 'hii_header_bottom_left' );
								?>
							</div>
							<div id="header_bottom_right">
								<?php
								do_action( 'hii_header_bottom_right' );
								?>
							</div>
							<?php 

								wp_nav_menu(array(
										'menu' =>  'bottom-menu',
										'container' => 'div',
										'container_class' => 'align-center flex-item',
										'container_id' => 'header_bottom_menu',
										'items_wrap'  => '<ul id="%1s" class="%2$s bottom-menu">%3$s</ul>',
										'theme_location' => 'bottom-menu',
										'fallback_cb'    => false
									));	 ?>
						</div>
					</div>
				</aside>
				<?php 
				do_action( 'hii_after_header_bottom' );
				endif;
			echo "</header>";
do_action( 'hii_after_main_header' );
do_action( 'hii_before_content' );