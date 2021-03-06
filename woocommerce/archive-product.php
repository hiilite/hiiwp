<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 
$page_bg_color = (get_post_meta ( get_the_ID(), 'page_title_bg', true))?get_post_meta ( get_the_ID(), 'page_title_bg', true):false;
if(isset($post)) $page_bg_img = (get_post_meta ( $post->ID, 'page_title_bgimg', false))?get_post_meta ( $post->ID, 'page_title_bgimg'):false;
 ?>
	<header class="woocommerce-products-header page-title" style="<?php echo ($page_bg_img)?'background-image:url('.$page_bg_img[0].');':'';?><?php echo ($page_bg_color)?'background-color:'.$page_bg_color.';':'';?>">
		<div class="in_grid content-box">
			<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="woocommerce-products-header__title "><?php woocommerce_page_title(); ?></h1>
 
		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?> 
		
		
		</div>
    </header>

	<?php if ( have_posts() ) : ?>
	<div class="row ">
		<div class="in_grid">
			<div class="col-9">
				<div class="woocommerce_before_shop_loop content-box">
				<?php
					/**
					 * woocommerce_before_shop_loop hook.
					 *
					 * @hooked wc_print_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>
				</div>
				
				<ul class="products product-categories">
					<?php woocommerce_product_subcategories(); ?>
				</ul>
				<?php 
					woocommerce_product_loop_start(); 
					
					while ( have_posts() ) : 
						the_post(); 
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
						
						wc_get_template_part( 'content', 'product' ); 
					endwhile; // end of the loop. 
					
						
					woocommerce_product_loop_end(); 
					
					/**
					 * woocommerce_after_shop_loop hook.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				else : 
				
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
				
				endif; ?>
			</div>
			<?php
				
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			
				/**
				 * woocommerce_after_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>
		</div>
	</div>
<?php get_footer( 'shop' ); ?>
