<?php 
//remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
//remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    function woocommerce_template_loop_product_thumbnail()
    {
        echo woocommerce_get_product_thumbnail();
    }
}
if (!function_exists('woocommerce_get_product_thumbnail')) {
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

add_action( 'init', 'custom_fix_thumbnail' );
 
function custom_fix_thumbnail() {
  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
   
	function custom_woocommerce_placeholder_img_src( $src ) {
		$src = Hii::$options['product_default_image'] ;
		 
		return $src;
	}
}

//add_filter( 'woocommerce_before_add_to_cart_button', 'add_price_before_button', 99 );
function add_price_before_button(){
	woocommerce_template_single_price();
}
function wc_subscriptions_custom_price_string( $pricestring ) {
    $newprice = str_replace( '/ month', '<span class="reoccuring-internal">per month</span> <br>', $pricestring );
    $newprice = str_replace( 'and a', '', $newprice );
    return $newprice;
}
//add_filter( 'woocommerce_subscriptions_product_price_string', 'wc_subscriptions_custom_price_string' );
//add_filter( 'woocommerce_subscription_price_string', 'wc_subscriptions_custom_price_string' );


add_action( 'before_page_title', 'add_woocommerce_title_content' );

function add_woocommerce_title_content() {
	if(is_woocommerce()) { 
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		
		do_action( 'woocommerce_before_main_content' );
	}
}


add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Apartment'
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb in_grid" itemprop="breadcrumb">';
	return $defaults;
}