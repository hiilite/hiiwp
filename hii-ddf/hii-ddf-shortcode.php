<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

add_shortcode( 'ddf_listings',        array( 'HiiDdfShortcode', 'hiiddf_residential_shortcode' ) );
add_shortcode( 'ddf_search_form',     array( 'HiiDdfShortcode', 'hiiddf_search_form_shortcode' ) );
add_shortcode( 'ddf_map_search',     array( 'HiiDdfShortcode', 'hiiddf_map_search' ) );

class HiiDdfShortcode {
	
	/**
     * [ddf_listings] - Residential Listings Shortcode
     *
     * Show all residential listings with the ability to filter by mlsid
     * to show a single listing.
     * ie, [sr_residential mlsid="12345"]
     */
    public static function hiiddf_residential_shortcode( $atts ) {
        global $wp_query;
		$listing_params = array();
		
		$atts['limit'] = isset($atts['limit'])?$atts['limit']:12;
    	$atts['keywords'] = isset($atts['keywords'])?$atts['keywords']:false;
    	$atts['type'] = isset($atts['type'])?$atts['type']:false;
    	$atts['offset'] = isset($atts['offset'])?$atts['offset']:0;
    	$atts['pagination'] = isset($atts['pagination'])?$atts['pagination']:false;
    	
    	$listings_content = '<div class="container_inner">';
	    $listings_content .= HiiDdfHelper::retrieveDdfListings( $listing_params, $atts );
		$listings_content .= '</div>';
        return $listings_content;
    }
    
    
    public static function hiiddf_map_search(){
	    global $wpdb;
	    
	    
	    
	    
			 
		$q_vars = HiiDdfHelper::$q_vars;
		
			
	    // GET LAT LONG for all listings
	    
	    
		$search_ids = array();
		if(isset($_GET['s'])) {
			
			$map_query_args = array(
				'post_type' => 'listing', 
				'posts_per_page' => '-1', 
				's' => $_GET['s'], 
				'meta_query' => $q_vars, 
				'fields' => 'ids'
			);
			
			$map_query = new WP_Query($map_query_args);
			$search_ids = $map_query->posts;
			if(!empty($search_ids)):	
				$search_ids_imploded = implode(',',$search_ids);
				
				$lat_lng_query = "SELECT Lat.post_id AS lid, Lat.meta_value AS latitude, Lon.meta_value AS longitude
					 FROM $wpdb->postmeta Lat
					 LEFT JOIN $wpdb->postmeta Lon
					 	ON Lon.post_id = Lat.post_id
					   AND Lon.meta_key = 'Address-Longitude'
					 WHERE Lat.meta_key = 'Address-Latitude'
					   AND Lat.post_id IN($search_ids_imploded)";
				$results = $wpdb->get_results($lat_lng_query , OBJECT );
				foreach($results as $result){
					HiiDdf::add_marker($result->lid, $result->latitude,$result->longitude); 
				}
			else:
				echo '<h3 class="align-center text-block">Sorry no listings that match that query</h3>';
				echo '<p class="align-center text-block">Perhaps some of these listings may interest you</p>';
				echo '<div class=in_grid>';
				echo do_shortcode( '[ddf_listings limit=12 pagination=true]' );
				echo '</div>';
			endif;
		} else {
			$lat_lng_query = "SELECT Lat.post_id AS lid, Lat.meta_value AS latitude, Lon.meta_value AS longitude
					 FROM $wpdb->postmeta Lat
					 LEFT JOIN $wpdb->postmeta Lon
					 	ON Lon.post_id = Lat.post_id
					   AND Lon.meta_key = 'Address-Longitude'
					 WHERE Lat.meta_key = 'Address-Latitude'";
			$results = $wpdb->get_results($lat_lng_query , OBJECT );
			foreach($results as $result){
				HiiDdf::add_marker($result->lid, $result->latitude,$result->longitude); 
			}
			
		}
		// Set up query
	    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	    
	
	    $listing_query_args = array('post_type' => 'listing', 'posts_per_page' => 12, 'paged' => $paged, 'meta_query' => $q_vars, 'fields' => 'ids');
	    
	    if(isset($_GET['s'])) $listing_query_args['s'] = $_GET['s'];
	    $listing_query = new WP_Query($listing_query_args);
	   

		if($listing_query->have_posts()):
			echo '<div class="row" id="listing_search_container"><div class="container_inner">';
			echo '<div class="col-4" id="listing_list">';
			while($listing_query->have_posts()):
				$listing_query->the_post();
				
				$post_id = get_the_id();
				
				get_template_part('/hii-ddf/templates/listing', 'medium');
				
			endwhile;
			$offset_next = $paged + 1;
			$offset_prev = $paged - 1;
			$next_link = "<a href='/listing/page/$offset_next' class='button'>Next</a>";
			$prev_link = ($offset_prev > 0)?"<a href='/listing/page/$offset_prev' class='button'>Prev</a>":'';
			echo "<hr><p class='sr-pagination'>$prev_link $next_link</p>";
			echo '</div>'.
				 '<div class="col-8">';
				 ?>
				 <div id="hiiddf_map" style="width:100%;height: 100%;"></div>
				 <?php
			echo '</div>';
			echo '</div></div>';
			wp_reset_postdata( );
		endif;	

    }
    
    /**
     * [ddf_search_form] - Residential Listings Shortcode
     *
     * Show all residential listings with the ability to filter by mlsid
     * to show a single listing.
     * ie, [ddf_search_form]
     */
    public static function hiiddf_search_form_shortcode( $atts ) {
        global $wp_query;
		$listing_params = array();
	
    	$atts['keywords'] = isset($_REQUEST['keywords'])?$_REQUEST['keywords']:false;
    	$atts['offset'] = isset($_REQUEST['offset'])?$_REQUEST['offset']:0;
    	
    	$property_options = HiiDdf::$PropertyTypes;
		
		
    	$s = (isset($_GET['s']))?$_GET['s']:'';
    	$type = (isset($_GET['type']))?$_GET['type']:'';
    	$minbeds = (isset($_GET['minbeds']))?$_GET['minbeds']:'';
    	$maxbeds = (isset($_GET['maxbeds']))?$_GET['maxbeds']:'';
    	$maxprice = (isset($_GET['maxprice']))?$_GET['maxprice']:'';
    	$minbaths = (isset($_GET['minbaths']))?$_GET['minbaths']:'';
    	$minprice = (isset($_GET['minprice']))?$_GET['minprice']:'';
    	
    	include(locate_template('/hii-ddf/templates/search-form.php'));
		
        //return $cont;
    }

}





?>