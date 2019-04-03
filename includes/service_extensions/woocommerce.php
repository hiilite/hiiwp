<?php 
/**
 * HiiWP: Service Extension - WooCommerce
 *
 * Add features when WooCommerce is activated
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.4
 */
 
 

if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
	
    /**
     * woocommerce_template_loop_product_thumbnail function.
     * 
     * @access public
     * @return void
     */
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    }
    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
}

if (!function_exists('woocommerce_get_product_thumbnail')) {
    /**
     * woocommerce_get_product_thumbnail function.
     * 
     * @access public
     * @param string $size (default: 'shop_catalog')
     * @param int $deprecated1 (default: 0)
     * @param int $deprecated2 (default: 0)
     * @return void
     */
    function woocommerce_get_product_thumbnail($size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0)
    {
        global $post;
        $image_size = apply_filters('single_product_archive_thumbnail_size', $size);
        if (has_post_thumbnail()) {
            $props = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
            return '<figure class="product-image-wrapper">' . get_the_post_thumbnail($post->ID, $image_size,
                    array(
                        'title' => $props['title'],
                        'alt' => $props['alt'],
                    )) . '</figure>';
        } elseif (wc_placeholder_img_src()) {
            return '<figure class="product-image-wrapper">' . wc_placeholder_img($image_size) . '</figure>';
        }
    }
}


if (!function_exists('custom_fix_thumbnail')) {
	/**
	 * custom_fix_thumbnail function.
	 * 
	 * @access public
	 * @return void
	 */
	function custom_fix_thumbnail() {
	  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
	   
		function custom_woocommerce_placeholder_img_src( $src ) {
			$src = Hii::$options['product_default_image'] ;
			 
			return $src;
		}
	}
	add_action( 'init', 'custom_fix_thumbnail' );
}


if (!function_exists('add_woocommerce_title_content')) {
	/**
	 * add_woocommerce_title_content function.
	 * 
	 * @access public
	 * @return void
	 */
	function add_woocommerce_title_content() {
		if(is_woocommerce()) { 
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			
			do_action( 'woocommerce_before_main_content' );
		}
	}
	add_action( 'before_page_title', 'add_woocommerce_title_content' );
}

if (!function_exists('wcc_change_breadcrumb_home_text')) {
	/**
	 * wcc_change_breadcrumb_home_text function.
	 * 
	 * @access public
	 * @param mixed $defaults
	 * @return void
	 */
	function wcc_change_breadcrumb_home_text( $defaults ) {
	    // Change the breadcrumb home text from 'Home' to 'Apartment'
		$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb in_grid" itemprop="breadcrumb">';
		return $defaults;
	}
	add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
}
