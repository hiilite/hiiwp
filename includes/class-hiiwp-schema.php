<?php
/**
 * The HiiWP Schema class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */

/**
 * HiiWP_Admin class.
 *
 * @since 0.4.3
 */
class HiiWP_Schema {
	
	public static $business_args = array(	
		array(
			'id'		=>'business_type',
			'title'		=>'Business Type',
			'callback'	=>'company_setting_schema',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_name',
			'title'		=>'Business Name',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_telephone',
			'title'		=>'Phone Number',
			'callback'	=>'company_setting_phone',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_contactType',
			'title'		=>'Contact Type',
			'callback'	=>'company_setting_contactType',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_faxNumber',
			'title'		=>'Fax Number',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_email',
			'title'		=>'Email',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_logo',
			'title'		=>'Logo',
			'callback'	=>'company_setting_logo',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_url',
			'title'		=>'Website',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
		array(
			'id'		=>'business_description',
			'title'		=>'Description',
			'callback'	=>'company_setting_textarea',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_main' ),
			
		
		array(
			'id'		=>'business_openingHoursSpecification',
			'title'		=>'Open Hours',
			'callback'	=>'company_setting_hours',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_store' ),
		array(
			'id'		=>'business_acceptsReservations',
			'title'		=>'Accepts Reservations',
			'callback'	=>'company_setting_trueFalse',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_store' ),
		
		array(
			'id'		=>'business_menu',
			'title'		=>'Menu URL',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_store' ),
			
		array(
			'id'		=>'business_facebook',
			'title'		=>'Facebook',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_twitter',
			'title'		=>'Twitter',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_googleplus',
			'title'		=>'GooglePlus',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_instagram',
			'title'		=>'Instagram',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_linkedin',
			'title'		=>'LinkedIn',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_pinterest',
			'title'		=>'Pinterest',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_houzz',
			'title'		=>'Houzz',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_tripadvisor', 
			'title'		=>'TripAdvisor',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_yelp',
			'title'		=>'Yelp',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),
		array(
			'id'		=>'business_youtube',
			'title'		=>'YouTube',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_social_settings',
			'section'	=> 'company_social' ),	
	
		array(
			'id'		=>'business_streetAddress',
			'title'		=>'Street Address',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_address' ),
		array(
			'id'		=>'business_addressLocality',
			'title'		=>'City',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_address' ),
		array(
			'id'		=>'business_addressRegion',
			'title'		=>'Province',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_address' ),
		array(
			'id'		=>'business_addressCountry',
			'title'		=>'Country',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_address' ),
		array(
			'id'		=>'business_postalCode',
			'title'		=>'Postal Code',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_address' ),
			
		array(
			'id'		=>'business_geo_latitude',
			'title'		=>'Latitude',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_geo' ),
		array(
			'id'		=>'business_geo_longitude',
			'title'		=>'Longitude',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_geo' ),
		
		array(
			'id'		=>'business_potentialAction',
			'title'		=>'Activate',
			'callback'	=>'company_setting_trueFalse',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_action' ),
		array(
			'id'		=>'business_potentialAction_urlTemplate',
			'title'		=>'Action URL',
			'callback'	=>'company_setting_url',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_action' ),
		array(
			'id'		=>'business_potentialAction_resultType',
			'title'		=>'Action Type',
			'callback'	=>'company_setting_potentialAction_resultType',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_action' ),
		array(
			'id'		=>'business_potentialAction_name',
			'title'		=>'Action Name',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_info_settings',
			'section'	=> 'company_action' ),

		array(
			'id'		=>'business_google_site_verification',
			'title'		=>'Google Site Verification',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_main_settings',
			'section'	=> 'page_validation' ),
		array(
			'id'		=>'business_fb_article_claim',
			'title'		=>'Facebook Instant Articles ID',
			'callback'	=>'company_setting_string',
			'page'		=> 'hii_main_settings',
			'section'	=> 'page_validation' ),
	);
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(){
		
		add_action('wp_head', array( $this, 'output_structured_data' ) );
		add_action('wp_head', array( $this, 'add_graph_data' ) );
		
		foreach(self::$business_args as $business){
			add_shortcode( $business['id'], array($this, 'generate_shortcodes'));
		}
	}
	
	/**
	 * generate_shortcodes function.
	 * 
	 * @access public
	 * @param mixed $atts
	 * @param string $content (default: '')
	 * @param string $shortcode (default: '')
	 * @return void
	 */
	public function generate_shortcodes($atts, $content = '', $shortcode = ''){
	 	$options = get_option('hii_seo_settings');	
	    return $options[$shortcode];
	}
	
	/**
	 * output_structured_data function.
	 * 
	 * @access public
	 * @return void
	 */
	public function output_structured_data(){
		$post_id = get_the_id();
		$post_object = get_post( $post_id );
		$options = get_option('hii_seo_settings');
		
		// Page Title
		$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
		if(get_post_meta(get_the_id(), 'page_seo_title', true) != ''){
			$page_title = get_post_meta(get_the_id(), 'page_seo_title', true);
		}
		elseif(get_theme_mod('site_seo_title') != '' && is_front_page()) {
			$page_title = get_theme_mod('site_seo_title');
		} else {
			$page_title = wp_title('|',false,'right').$brand_title;
		}
		
		// Page Description
		if(get_post_meta(get_the_id(), 'page_seo_description', true) != ''){
			$page_description = get_post_meta(get_the_id(), 'page_seo_description', true);
		}
		elseif(get_theme_mod('site_seo_description') != '' && is_front_page()) {
			$page_description = get_theme_mod('site_seo_description');
		} elseif (!is_tax() && is_singular()) {
			$the_content = $post_object->post_content;
			$the_content = substr(preg_replace('/\[.*.\]|\n+/', '', $the_content), 0, 165);
			$page_description = strip_tags($the_content);
		}
		// Page Image
		if(has_post_thumbnail($post_id)){
			$page_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
			$page_image=$page_image[0];
		} elseif(isset($options['business_logo'])) {
			$page_image = $options['business_logo'];
		} else {
			$page_image = get_theme_mod( 'main_logo' );
		}
		 
		if(! defined('WPSEO_VERSION')):
			?>
			<meta property="op:markup_version" content="v1.0">
			<meta property="og:title" content="<?php echo $page_title?>">
			<meta property="og:url" content="<?php echo 'https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>">
			<meta property="og:image" content="<?php echo $page_image?>">
			<meta property="og:description" content="<?php echo $page_description?>">
			<meta property="og:site_name" content="<?php echo $brand_title?>">
			<?php
		endif;
		if((isset($options['business_type'])) && (in_array($options['business_type'], array('FoodEstablishment', 'Bakery','BarOrPub','Brewery', 'CafeOrCoffeeShop', 'FastFoodRestaurant', 'IceCreamShop', 'Restaurant', 'Winery')))){
			
			if(is_page('menu') || is_tax('menu-section')){
				echo '<meta property="fb:app_id" content="'.$options['business_fb_article_claim'].'" />';
				echo '<meta property="og:type" content="restaurant.menu">';
				echo '<meta property="restaurant:restaurant" content="'.$options['business_name'].'" />';
			} if(is_singular('menu')){
				if(isset($options['business_fb_article_claim']))echo '<meta property="fb:app_id" content="'.$options['business_fb_article_claim'].'" />';
				echo '<meta property="og:type" content="restaurant.menu_item">';
				$section = get_the_terms($post_id, 'menu-section');
				$meta_price = get_post_meta($post_id, 'price', true);
				echo '<meta property="restaurant:section"                  content="'.$section[0]->name.'" /> 
					  <meta property="restaurant:variation:price:amount"   content="'.$meta_price.'" /> 
					  <meta property="restaurant:variation:price:currency" content="CAD" />';
			} else {
				echo '<meta property="og:type" content="restaurant.restaurant">';
				if(isset($options['business_address']['address-1'])) echo '<meta property="restaurant:contact_info:street_address" content="'.$options['business_address']['address-1'].'" />';
				if(isset($options['business_address']['city'])) echo '<meta property="restaurant:contact_info:locality"       content="'.$options['business_address']['city'].'" />';
				if(isset($options['business_address']['state'])) echo '<meta property="restaurant:contact_info:region"         content="'.$options['business_address']['state'].'" /> ';
				if(isset($options['business_address']['zip'])) echo '<meta property="restaurant:contact_info:postal_code"    content="'.$options['business_address']['zip'].'" /> ';
				if(isset($options['business_address']['country'])) echo '<meta property="restaurant:contact_info:country_name"   content="'.$options['business_address']['country'].'" /> ';
				if(isset($options['business_email'])) echo '<meta property="restaurant:contact_info:email"          content="'.$options['business_email'].'" /> ';
				if(isset($options['business_telephone'])) echo '<meta property="restaurant:contact_info:phone_number"   content="'.$options['business_telephone'].'" />'; 
				if(isset($options['business_url'])) echo '<meta property="restaurant:contact_info:website"        content="'.$options['business_url'].'" /> ';
				if(isset($options['business_geo_latitude'])) echo '<meta property="place:location:latitude"                content="'.$options['business_geo_latitude'].'" /> ';
				if(isset($options['business_geo_longitude'])) echo '<meta property="place:location:longitude"               content="'.$options['business_geo_longitude'].'" />';
			}
		} elseif(is_single()){
			echo '<meta property="og:type" content="article">';
		} elseif(is_front_page() || is_home() || !is_single() || !is_archive()){
			echo '<meta property="og:type" content="business.business">';
			if(isset($options['business_address']['address-1'])) 	echo '<meta property="business:contact_data:street_address" content="'.$options['business_address']['address-1'].'" />';
			if(isset($options['business_address']['city'])) 		echo '<meta property="business:contact_data:locality"       content="'.$options['business_address']['city'].'" />';
			if(isset($options['business_address']['state'])) 		echo '<meta property="business:contact_data:region"         content="'.$options['business_address']['state'].'" /> ';
			if(isset($options['business_address']['zip'])) 			echo '<meta property="business:contact_data:postal_code"    content="'.$options['business_address']['zip'].'" /> ';
			if(isset($options['business_address']['country'])) 		echo '<meta property="business:contact_data:country_name"   content="'.$options['business_address']['country'].'" /> ';
	
			if(isset($options['business_geo_latitude'])) echo '<meta property="place:location:latitude" content="'.$options['business_geo_latitude'].'">';
			if(isset($options['business_geo_longitude'])) echo '<meta property="place:location:longitude" content="'.$options['business_geo_longitude'].'">';
		} else {
			echo '<meta property="og:type" content="website">';
		}
		if(isset($options['business_fb_article_claim'])){
			echo '<meta property="fb:pages" content="'.$options['business_fb_article_claim'].'" />';
		}
	
	}
	
	
	/**
	 * add_graph_data function.
	 * 
	 * @access public
	 * @return void
	 */
	public function add_graph_data(){
	
		$options = get_option('hii_seo_settings');
		
		/*
		*
		*	WEBSITE
		*
		*/
		$WebSite = '<script type="application/ld+json">{
		  "@context" : "http://schema.org",
		  "@type" : "WebSite",';
	 		if(isset($options['business_name']))$WebSite .= ' "name" : "'.$options['business_name'].'",';
		 $WebSite .= '"url" : "'.home_url().'"';
		$WebSite .= '}</script>';
		echo $WebSite;
		
		/*
		*
		*	ORGANIZATION
		*
		*/
		$html = '<script type="application/ld+json">{
			"@context" : "http://schema.org",
			"@type" : "Organization",';
		$html .= '"url" : "'.home_url().'",';
		if(isset($options['business_logo']))$html .= '"logo" : "'.$options['business_logo'].'",';
		if(isset($options['business_email']))$html .= '"email" : "'.$options['business_email'].'",';
		if(isset($options['business_faxNumber']))$html .= '"faxNumber" : "'.$options['business_faxNumber'].'",';
		if(isset($options['business_description']))$html .= ' "description" : "'.$options['business_description'].'",';
		if(isset($options['business_name']))$html .= ' "name" : "'.$options['business_name'].'",';
		if(isset($options['business_telephone_numbers'])){
			foreach($options['business_telephone_numbers'] as $number){
				if(isset($number['business_telephone']))$html .= ' "contactPoint" : [{
				"@type" : "ContactPoint",
				"telephone" : "'.$number['business_telephone'].'",
				"contactType" : "'.$number['business_contactType'].'"
				}],';
			}
		}
		if(isset($options['business_social'])){
			 $html .= '"sameAs" : [';
			 $comma = '';
			foreach($options['business_social'] as $socialprofile):
				if(isset($socialprofile['social_url'])):
					$html .= $comma.'"'.$socialprofile['social_url'].'"';
					$comma = ',';
				endif;
			endforeach;
		}
		if (isset($options['business_address'])){
			$html.= ' ],
			  "address": {
				"@type": "PostalAddress",';
				if(isset($options['business_address']['city']))$html .= '"addressLocality": "'.$options['business_address']['city'].'",';
				if(isset($options['business_address']['state']))$html .= '"addressRegion": "'.$options['business_address']['state'].'",';
				if(isset($options['business_address']['address-1']))$html .= '"streetAddress": "'.$options['business_address']['address-1'].'",';
				if(isset($options['business_address']['country']))$html .= '"addressCountry": "'.$options['business_address']['country'].'",';
				if(isset($options['business_address']['zip']))$html .= '"postalCode": "'.$options['business_address']['zip'].'"';
			$html.='  }';
		}
		$html .= '}</script>';
		echo $html;
		
		/*
		*
		*	SPECIFIC TYPE
		*
		*/
		if(isset($options['business_type'])):
			$html = '<script type="application/ld+json">{
			  "@context" : "http://schema.org",
			  "@type" : "'.$options['business_type'].'",';
			$html .= '"url" : "'.home_url().'",';
			 
			if(isset($options['business_logo']))$html .= '"logo" : "'.$options['business_logo'].'",';
			if(isset($options['business_logo']))$html .= '"image" : "'.$options['business_logo'].'",';
			if(isset($options['business_email']))$html .= '"email" : "'.$options['business_email'].'",';
			if(isset($options['business_telephone_numbers'])){
				foreach($options['business_telephone_numbers'] as $number){
					if($number['business_telephone']!='')$html .= ' "contactPoint" : [{
					"@type" : "ContactPoint",
					"telephone" : "'.$number['business_telephone'].'",
					"contactType" : "'.$number['business_contactType'].'"
					}],';
				}
			}
		
			$html .= '"priceRange" : "$$$",';
			if(isset($options['business_faxNumber']))$html .= '"faxNumber" : "'.$options['business_faxNumber'].'",';
			if(isset($options['business_description']))$html .= ' "description" : "'.$options['business_description'].'",';
			if(isset($options['business_name']))$html .= ' "name" : "'.$options['business_name'].'",';
			  
			if(in_array($options['business_type'], array('FoodEstablishment','Bakery','BarOrPub','Brewery','CafeOrCoffeeShop','FastFoodRestaurant','IceCreamShop','Restaurant','Winery'))){
				if($options['business_acceptsReservations']!='')$html .= ' "acceptsReservations" : "'.$options['business_acceptsReservations'].'",';
				if($options['business_menu']!='')$html .= ' "menu" : "'.$options['business_menu'].'",';
			  	
			  	if(isset($options['business_potentialAction'])):
					$html .= '"potentialAction":{
					    "@type":"ReserveAction",
					    "target":{
					      "@type":"EntryPoint",
					      "urlTemplate":"'.$options['business_potentialAction_urlTemplate'].'",
					      "inLanguage":"en-CA",
					      "actionPlatform":[
					        "http://schema.org/DesktopWebPlatform",
					        "http://schema.org/IOSPlatform",
					        "http://schema.org/AndroidPlatform",
					        "http://schema.org/MobileWebPlatform"
					      ]
					    },
					    "result":{
					      "@type":"'.$options['business_potentialAction_resultType'].'",
					      "name":"'.$options['business_potentialAction_name'].'"
					    }
					},';
				endif;
			}
		
			if(isset($options['business_telephone_numbers'])){
				if($options['business_telephone_numbers'][0]['business_telephone']!='')$html .= '"telephone" : "'.$options['business_telephone_numbers'][0]['business_telephone'].'",';
				foreach($options['business_telephone_numbers'] as $number){
					
					if($number['business_telephone']!='')$html .= ' "contactPoint" : [{
					"@type" : "ContactPoint",
					"telephone" : "'.$number['business_telephone'].'",
					"contactType" : "'.$number['business_contactType'].'"
					}],';
				}
			}
		
			if(isset($options['business_openingHoursSpecification']) && is_array($options['business_openingHoursSpecification'])){
				$html .= '"openingHoursSpecification" : [';
				$comma = '';
				foreach($options['business_openingHoursSpecification'] as $hourset):
				 	if(!empty($hourset['dayOfWeek'])){
						$html .= $comma.'{
							    "@type": "OpeningHoursSpecification",
							    "dayOfWeek": [';
							$comma2 ='';
							foreach($hourset['dayOfWeek'] as $key=>$day){
								$html .= $comma2.'"'.$day.'"';
								$comma2 =',';
							}
							
						$html .= '],
							    "opens": "'.$hourset['opens'].'",
							    "closes": "'.$hourset['closes'].'"
							  }';
						$comma = ',';
					}
				endforeach;
				$html .= ' ],';
			}
			
			if(isset($options['business_social'])){
				$html .= '"sameAs" : [';
				$comma = '';
				foreach($options['business_social'] as $socialprofile):
					$html .= $comma.'"'.$socialprofile['social_url'].'"';
					$comma = ',';
				endforeach;
				$html.= ' ],';
			}
			if(isset($options['business_address'])){
				$html .= '"address": {
					"@type": "PostalAddress",';
					if(isset($options['business_address']['city']))$html .= '"addressLocality": "'.$options['business_address']['city'].'",';
					if(isset($options['business_address']['state']))$html .= '"addressRegion": "'.$options['business_address']['state'].'",';
					if(isset($options['business_address']['address-1']))$html .= '"streetAddress": "'.$options['business_address']['address-1'].'",';
					if(isset($options['business_address']['country']))$html .= '"addressCountry": "'.$options['business_address']['country'].'",';
					if(isset($options['business_address']['zip']))$html .= '"postalCode": "'.$options['business_address']['zip'].'"';
				$html.='  }';
			}
			  if(isset($options['business_geo_latitude']) && isset($options['business_geo_longitude'])){$html .= ', "geo": {
				"@type": "GeoCoordinates",
				"latitude": "'.$options['business_geo_latitude'].'",
				"longitude": "'.$options['business_geo_longitude'].'"
			  }';}
			$html .= '}</script>';
		
		
		endif;
		if(isset($options['business_google_site_verification'])){
			if($match = preg_match_all("/\"([^\"]*)\"/", $options['business_google_site_verification'], $output_array)){
				if(isset($output_array[1][1]))$html .= '<meta name="google-site-verification" content="'.$output_array[1][1].'">';
				else $html .= $options['business_google_site_verification'];
			} else { $html .= '<meta name="google-site-verification" content="'.$options['business_google_site_verification'].'">'; }
		}
		if(isset($options['business_bing_site_verification'])){
			if($match = preg_match_all("/\"([^\"]*)\"/", $options['business_bing_site_verification'], $output_array)){
				if(isset($output_array[1][1]))$html .= '<meta name="msvalidate.01" content="'.$output_array[1][1].'">';
				else $html .= $options['business_bing_site_verification'];
			} else { $html .= '<meta name="msvalidate.01" content="'.$options['business_bing_site_verification'].'">'; }
		}
		
		if(isset($options['business_pinterest_site_verification'])){
			if($match = preg_match_all("/\"([^\"]*)\"/", $options['business_pinterest_site_verification'], $output_array)){
				if(isset($output_array[1][1]))$html .= '<meta name="p:domain_verify" content="'.$output_array[1][1].'">';
				else $html .= $options['business_pinterest_site_verification'];
			} else { $html .= '<meta name="p:domain_verify" content="'.$options['business_pinterest_site_verification'].'">'; }
		}
		
		echo $html;
	}
}

new HiiWP_Schema();