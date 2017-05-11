<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
echo '<!--CONTENT-PRODUCT-->';
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );?>
		<div class="top-product-section">

            <a itemprop="url" href="<?php the_permalink(); ?>" class="product-category">
                <span class="image-wrapper">
                <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
                </span>
            </a>

			<?php do_action('qode_woocommerce_after_product_image'); ?>

        </div>
        <div class="bottom-product-section">
	    	<?php 
	            echo $product->get_categories(', ','<div class="product-categories">','</div>');
	         ?>
	        <a itemprop="url" href="<?php the_permalink(); ?>" class="product-category product-info">
	            <h3 itemprop="name"><?php the_title(); ?></h3>
	
	            <?php ?>
	            <div class="separator after-title-spearator small center"></div>
	            <span class="description"><?php  the_excerpt(); ?></span>
	            
	            <?php
	                /**
	                 * woocommerce_after_shop_loop_item_title hook
	                 *
	                 * @hooked woocommerce_template_loop_rating - 5
	                 * @hooked woocommerce_template_loop_price - 10
	                 */
	                do_action( 'woocommerce_after_shop_loop_item_title' );
	            ?>
	        </a>
        
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
</li>
