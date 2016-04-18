<?php
global $hiilite_options;
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';

$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');

if(get_theme_mod('site_seo_title') != '' && is_front_page()) {
	$page_title = get_theme_mod('site_seo_title');
} else {
	$page_title = wp_title('|',false,'right').$brand_title;
}
?>
<!doctype html>
<html <?php if($hiilite_options['amp'] && $hiilite_options['subdomain'] != 'iframe') echo 'amp'; ?> lang="en">
<head>
<meta charset="utf-8">
<title><?= $page_title ?></title>
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<script type="application/ld+json">
	<?php
	$options = get_option('company_options');
	
	/*
	*
	*	WEBSITE
	*
	*/
	$WebSite = '{
	  "@context" : "http://schema.org",
	  "@type" : "WebSite",';
 		if($options['business_name']!='')$WebSite .= ' "name" : "'.$options['business_name'].'",';
	 if($options['business_url']!='')$WebSite .= '"url" : "'.$options['business_url'].'"';
	$WebSite .= '}';
echo $WebSite;
?></script><script type="application/ld+json"><?php
	/*
	*
	*	ORGANIZATION
	*
	*/
	$html = '{
		"@context" : "http://schema.org",
		"@type" : "Organization",';
	if($options['business_url']!='')$html .= '"url" : "'.$options['business_url'].'",';
	if($options['business_logo']!='')$html .= '"logo" : "'.$options['business_logo'].'",';
	if($options['business_email']!='')$html .= '"email" : "'.$options['business_email'].'",';
	if($options['business_telephone']!='')$html .= '"telephone" : "'.$options['business_telephone'].'",';
	if($options['business_faxNumber']!='')$html .= '"faxNumber" : "'.$options['business_faxNumber'].'",';
	if($options['business_description']!='')$html .= ' "description" : "'.$options['business_description'].'",';
	if($options['business_name']!='')$html .= ' "name" : "'.$options['business_name'].'",';
	if($options['business_telephone']!='')$html .= ' "contactPoint" : [{
		"@type" : "ContactPoint",
		"telephone" : "'.$options['business_telephone'].'",
		"contactType" : "'.$options['business_contactType'].'"
	  }],';
	 $html .= '"sameAs" : [';
		if($options['business_facebook']!='')$html .= '"'.$options['business_facebook'].'"';
		if($options['business_twitter']!='')$html .= ',"'.$options['business_twitter'].'"';
		if($options['business_googleplus']!='')$html .= ',"'.$options['business_googleplus'].'"';
		if($options['business_linkedin']!='')$html .= ',"'.$options['business_linkedin'].'"';
		if($options['business_instagram']!='')$html .= ',"'.$options['business_instagram'].'"';
	 $html.= ' ],
	  "address": {
		"@type": "PostalAddress",';
		if($options['business_addressLocality']!='')$html .= '"addressLocality": "'.$options['business_addressLocality'].'",';
		if($options['business_addressRegion']!='')$html .= '"addressRegion": "'.$options['business_addressRegion'].'",';
		if($options['business_streetAddress']!='')$html .= '"streetAddress": "'.$options['business_streetAddress'].'",';
		if($options['business_addressCountry']!='')$html .= '"addressCountry": "'.$options['business_addressCountry'].'"';
	$html.='  }';

	$html .= '}';
	echo $html;
?></script><script type="application/ld+json"><?php	
	/*
	*
	*	SPECIFIC TYPE
	*
	*/
	$html = '{
	  "@context" : "http://schema.org",
	  "@type" : "'.$options['business_type'].'",';
	if($options['business_url']!='')$html .= '"url" : "'.$options['business_url'].'",';
	 
	if($options['business_logo']!='')$html .= '"logo" : "'.$options['business_logo'].'",';
	if($options['business_email']!='')$html .= '"email" : "'.$options['business_email'].'",';
	if($options['business_telephone']!='')$html .= '"telephone" : "'.$options['business_telephone'].'",';
	if($options['business_faxNumber']!='')$html .= '"faxNumber" : "'.$options['business_faxNumber'].'",';
	if($options['business_description']!='')$html .= ' "description" : "'.$options['business_description'].'",';
	if($options['business_name']!='')$html .= ' "name" : "'.$options['business_name'].'",';
	  
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
	if($options['business_telephone']!='')$html .= ' "contactPoint" : [{
		"@type" : "ContactPoint",
		"telephone" : "'.$options['business_telephone'].'",
		"contactType" : "'.$options['business_contactType'].'"
		}],';
	$hoursets = $options['hoursets'];
	 
	$html .= '"openingHoursSpecification" : [';
	$comma = '';
	for($i=0;$i < $hoursets;$i++):
	 
	$html .= $comma.'{
			    "@type": "OpeningHoursSpecification",
			    "dayOfWeek": [';
			$comma2 ='';
			foreach($options['business_openingHoursSpecification'][$i]['dayOfWeek'] as $key=>$day){
				$html .= $comma2.'"'.$day.'"';
				$comma2 =',';
			}
			
	$html .= '],
			    "opens": "'.$options['business_openingHoursSpecification'][$i]['opens'].'",
			    "closes": "'.$options['business_openingHoursSpecification'][$i]['closes'].'"
			  }';
		$comma = ',';
	endfor;
	$html .= ' ],';
	$html .= '"sameAs" : [';
		if($options['business_facebook']!='')$html .= '"'.$options['business_facebook'].'"';
		if($options['business_twitter']!='')$html .= ',"'.$options['business_twitter'].'"';
		if($options['business_googleplus']!='')$html .= ',"'.$options['business_googleplus'].'"';
		if($options['business_linkedin']!='')$html .= ',"'.$options['business_linkedin'].'"';
		if($options['business_instagram']!='')$html .= ',"'.$options['business_instagram'].'"';
	$html.= ' ],
	  "address": {
		"@type": "PostalAddress",';
		if($options['business_addressLocality']!='')$html .= '"addressLocality": "'.$options['business_addressLocality'].'",';
		if($options['business_addressRegion']!='')$html .= '"addressRegion": "'.$options['business_addressRegion'].'",';
		if($options['business_streetAddress']!='')$html .= '"streetAddress": "'.$options['business_streetAddress'].'",';
		if($options['business_addressCountry']!='')$html .= '"addressCountry": "'.$options['business_addressCountry'].'",';
		if($options['business_postalCode']!='')$html .= '"postalCode": "'.$options['business_postalCode'].'"';
	$html.='  },';
	  if($options['business_geo_latitude']!='' && $options['business_geo_longitude']!=''){$html .= '"geo": {
		"@type": "GeoCoordinates",
		"latitude": "'.$options['business_geo_latitude'].'",
		"longitude": "'.$options['business_geo_longitude'].'"
	  }';}
	$html .= '}';
echo $html;
?>
</script>
<?php if($hiilite_options['amp']) { ?>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<?php } ?>
<link href='https://fonts.googleapis.com/css?family=Raleway:100,300,600,400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>

<?php 
ob_start();
include_once('css/main-css.php');
$maincss = ob_get_clean();
$body = str_replace("!important", "", $maincss);
echo minify_css($body);
 ?>

<?php if($hiilite_options['amp']) { ?>

	<script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
	<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
	<script async custom-element="amp-lightbox" src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js"></script>
	<script async custom-element="amp-anim" src="https://cdn.ampproject.org/v0/amp-anim-0.1.js"></script>
	<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
	<script async custom-element="amp-facebook" src="https://cdn.ampproject.org/v0/amp-facebook-0.1.js"></script>
	<script async src="https://cdn.ampproject.org/v0.js"></script>
<?php } else { ?>
<script type="text/javascript">
(function(a,e,c,f,g,b,d){var h={ak:"123456789",cl:"_ABcDEFg12hI34567jK"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[f]||(a[f]=h.ak);b=e.createElement(g);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(g)[0];d.parentNode.insertBefore(b,d);a._googWcmGet=function(b,d,e){a[c](2,b,h,d,null,new Date,e)}})(window,document,"_googWcmImpl","_googWcmAk","script");
</script>
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', '<?=$hiilite_options['analytics_id']?>', 'auto');
ga('require', 'eventTracker');
ga('require', 'autotrack');
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<script async src='path/to/autotrack.js'></script>
<?php } ?>
</head>
<body <?php body_class(); ?>>
<?php if($hiilite_options['amp']) { ?>
	<amp-analytics type="googleanalytics" id="analytics1">
	<script type="application/json">
	{
	  "vars": {
	    "account": "<?=$hiilite_options['analytics_id']?>" 
	  },
	  "triggers": {
	    "trackPageview": { 
	      "on": "visible",
	      "request": "pageview"
	    },
	    "trackClickOnPhone" : {
	      "on": "click",
	      "selector": "a[href*=tel]",
	      "request": "event",
	      "vars": {
	        "eventCategory": "Contact Links",
	        "eventAction": "user-phoned"
	      }
	    },
	    "trackClickOnEmail" : {
	      "on": "click",
	      "selector": "a[href*=mailto]",
	      "request": "event",
	      "vars": {
	        "eventCategory": "Contact Links",
	        "eventAction": "user-emailed"
	      }
	    }
	  }
	}
	</script>
	</amp-analytics>
<?php } ?>
	<div class="wrapper">
		<div class="wrapper_inner">
			<?php if($hiilite_options['subdomain'] != 'iframe'): ?>
			<aside id="header_top">
				<div class="container_inner"><div class="in_grid">
					<?php 
						if($hiilite_options['header_top_left']){ ?>
					<div id="header_top_left" class="flex-item">
						<?php 
						//if ( is_active_sidebar( 'header_top_left' ) ) :
							if(!dynamic_sidebar( 'header_top_left' )){}
						//endif;
						?>
					</div>
					<?php } 
					if($hiilite_options['header_top_right']){ ?>
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
			
			<!-- HEADER -->
			<header id="main_header" class="<?=$hiilite_options['header_type'];?>"><div class="container_inner">
				<?php if($hiilite_options['header_in_grid']) { echo '<div class="in_grid">'; }
					if($hiilite_options['header_center_left_on']){
						wp_nav_menu(array(
								'menu' =>  'left-menu',
								'container' => 'div',
								'container_class' => 'align-left flex-item',
								'container_id' => 'header_center_left',
								'items_wrap'  => '<ul id="%1s" class="%2$s left-menu">%3$s</ul>',
								'theme_location' => 'left-menu'
							));		
					} ?>
					<div id="logo_container" class="flex-item <?php if($hiilite_options['header_center_right_on'] && !$hiilite_options['header_center_left_on']){ echo 'align-left';} ?>">
						<a href="<?php bloginfo('url'); ?>">
							<<?=$_amp?>img src="<?=$hiilite_options['main_logo'];?>" width="<?=$hiilite_options['logo_width'];?>" height="<?=$hiilite_options['logo_height'];?>"><?=($_amp!='')?'</amp-img>':'';?>
						</a>
					</div>

					<?php if($hiilite_options['header_center_right_on'] && $hiilite_options['header_type'] == 'centered'){ 
						wp_nav_menu(array(
								'menu' =>  'right-menu',
								'container' => 'div',
								'container_class' => 'align-right flex-item',
								'container_id' => 'header_center_right',
								'items_wrap'  => '<ul id="%1s" class="%2$s right-menu">%3$s</ul>',
								'theme_location' => 'right-menu',
								'fallback_cb'    => false
							));	
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
			</header>
			<aside id="header_bottom flex-item">
				<div class="container_inner">
					<div id="header_bottom_left"></div>
					<div id="header_bottom_right"></div>
				</div>
			</aside>
			<?php endif; //end iframe check ?>
			