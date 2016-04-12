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
	$WebSite = '{
	  "@context" : "http://schema.org",
	  "@type" : "WebSite",';
 		if($options['business_name']!='')$WebSite .= ' "name" : "'.$options['business_name'].'",';
	 if($options['business_url']!='')$WebSite .= '"url" : "'.$options['business_url'].'"';
	$WebSite .= '}';
echo $WebSite;
?>
</script>
<script type="application/ld+json">
	<?php 
	
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
	  if($options['business_telephone']!='')$html .= ' "contactPoint" : [{
		"@type" : "ContactPoint",
		"telephone" : "'.$options['business_telephone'].'",
		"contactType" : "customer service"
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
<style <?php if($hiilite_options['amp']) echo 'amp-custom'; ?>>
<?php include_once('css/font-awesome/css/font-awesome.min.css'); ?>
html {
	<?php 
	foreach($hiilite_options['default_font'] as $key => $value){
		echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
	}
	?>
}
body {
	margin: 0;
	background: <?=$hiilite_options['default_background_color'];?>;
}
a {
	color:<?=$hiilite_options['typography_link_color'];?>;<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_link_custom_css']); ?>
}
figure {
	display: block;
	margin: auto;
	padding: 0;
}
figure.align-center <?=$_amp?>img{
	margin: auto;
}


/* TYPOGRAPHY */
h1,h2,h3,h4,h5,h6,.h1,.h2 {
	<?php 
	foreach($hiilite_options['heading_font'] as $key => $value){
		if($value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
	?>
	line-height:1.5;
	margin-top: 0;
}
h1,.h1 {
	<?php 
	foreach($hiilite_options['typography_h1_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
	?>
}
h2, .h2 {
	<?php 
	foreach($hiilite_options['typography_h2_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
	?>
}
h3 {
	<?php 
	foreach($hiilite_options['typography_h3_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
	?>
}
h4 {
	<?php 
	foreach($hiilite_options['typography_h4_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
	?>
}

h5 {
	<?php 
	foreach($hiilite_options['typography_h5_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
	?>
}
h6 {
	<?php 
	foreach($hiilite_options['typography_h6_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
	?>
}
.clearfix:before,
.clearfix:after {
	content: " ";
	display: table;
	clear: both;
}


/* CONTAINERS */
.wrapper {
	position: fixed;
	overflow: hidden;
	height: 100%;
	width: 100%;
}
.wrapper_inner {
	width:100%;
	overflow-y: auto;
	overflow-x: hidden;
		flex-direction: column;
	min-height: 100vh;
	align-content: space-around;

	perspective: 1px;
	perspective-origin-x: 100%;
	transform-style: preserve-3d;
	position: relative;
	height: 100%;
}

.container_inner, .in_grid {
	margin: auto;
	display: flex;
	width: 100%;
	align-items: center;
	flex-wrap: wrap;
}
.row {
	box-sizing: content-box;
}
.in_grid {
	max-width: <?=$hiilite_options['grid_width'];?>;
}
.row-o-full-height {
	min-height: 100vh;
	display: flex;
}

/* HEADER */
header#main_header {
	width: 100%;
	padding: 1em 0;
	align-items: center;
	line-height: <?=$hiilite_options['header_line_height']?>;
	flex-wrap: wrap;
	z-index: 9999;
	<?php 
	if ($hiilite_options['header_above_content'] == false){ 
		echo 'position:absolute;'; 
	} else {
		echo ($hiilite_options['header_background_image'] != '')?'background-image:url('.$hiilite_options['header_background_image'].');':'';
		echo 'background-repeat:'.$hiilite_options['header_background_repeat'].';';
		echo 'background-size:'.$hiilite_options['header_background_size'].';';
		echo 'background-attachment:'.$hiilite_options['header_background_attach'].';';
		echo 'background-position:'.str_replace('-', ' ', $hiilite_options['header_background_position']).';';
		echo 'background-color:'.$hiilite_options['header_background_color'].';';
	}
	?>
}
<?php if($hiilite_options['header_type'] == 'centered') { ?>

header.centered, 
header.centered .container_inner,
header.centered .main-menu{
	justify-content: center;
	flex-wrap: wrap;
	text-align: center;
}
header.centered #main-nav {
	width:100%;
}

<?php } ?>

.blog-article {
	margin-bottom: 1em;
	display: flex;
}
.blog-article .content-box {
	padding-top: 0;
}
@media (max-width:<?=$hiilite_options['grid_width'];?>){
	.container_inner {
		padding: 0 1em;
	}
}
#header_top {
	background: <?=$hiilite_options['header_top_background_color']?>;
	line-height: 50px;
	<?php 
	echo ($hiilite_options['header_top_border_color'] != '')?'border-top-color:'.$hiilite_options['header_top_border_color'].';border-top-style: solid;':'';
	echo ($hiilite_options['header_top_border_width'] != '')?'border-top-width:'.$hiilite_options['header_top_border_width'].';':''; ?>
}


#logo_container {
    max-width: 100%;
}

#logo_container <?=($_amp!='')?$_amp.'img':'';?> img {
    height: auto;
}

/* FOOTER */

#main_footer {
	<?php 
	foreach($hiilite_options['typography_footer_text_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
?>
}

#main_footer .widgettitle {
	<?php 
	foreach($hiilite_options['typography_footer_headings_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
?>
}

#main_footer a, #main_footer a .fa {
	<?php 
	foreach($hiilite_options['typography_footer_links_font'] as $key => $value){
		if($value != ' ' && $value != '' && $value != 'px'){
			echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
		}
	}
?>
}

#main_footer ul {
    list-style: none;
    padding: 0;
}
#footer_top {
	background: <?=$hiilite_options['footer_background_color'];?>;
	<?php 
	echo 'background-image:url('.$hiilite_options['footer_background_image'].');';
	echo 'background-repeat:'.$hiilite_options['footer_background_repeat'].';';
	echo 'background-size:'.$hiilite_options['footer_background_size'].';';
	echo 'background-attachment:'.$hiilite_options['footer_background_attach'].';';
	echo 'background-position:'.str_replace('-', ' ', $hiilite_options['footer_background_position']).';';
	echo 'background-color:'.$hiilite_options['footer_background_color'].';';
	?>
	color: <?=$hiilite_options['footer_font_color'];?>;
	padding: 1em;
	align-content: flex-start;
	display: flex;
	align-items: center;
	flex-wrap: wrap;
}

#footer_top .flex-item{
	margin: 0 auto auto 0;
	
}
#footer_bottom{
	background: <?php echo $hiilite_options['footer_bottom_background_color']; ?>;
	color: #fff;
	padding:1em;
}
.flex-item {
	flex: 1 auto;
}


/* MENU */
.menu {
	
	list-style: none;
	padding: 0;
	margin: 0;
	display: flex;
	flex-wrap: wrap;
	justify-content: flex-end;
}
.menu.main-menu {
	<?php if($hiilite_options['main_menu_background_color'] != '')
		echo 'background:'.$hiilite_options['main_menu_background_color'].';';
	?>

}
.menu .menu-item  {
	position: relative;
}
.menu .menu-item a {
	<?php 
	foreach($hiilite_options['main_menu_font'] as $key => $value){
		echo ($key == 'variant')?'font-weight:'.$value.';':$key.':'.$value.';';
	}
	?>
	<?=$hiilite_options['main_menu_links_css'];?>
	text-decoration: none;
	padding: 1em; /*set*/
	display:block;
}
.menu .menu-item:hover {
	background: <?=$hiilite_options['color_one'];?>;
}
.menu .menu-item:hover a {
	color:white;
}
ul.sub-menu {
    position: absolute;
    list-style: none;
    padding: 0;
    display: none;
    background: grey;
	min-width: 12em;
	z-index: 10;
}
.menu .menu-item:hover > ul.sub-menu {
	display:block;
}

@media (max-width:<?=$hiilite_options['mobile_menu_switch'];?>){
	#logo_container {
	    padding: 0 1em;
	}
	nav#main-nav:before {
		content: '\f0c9';
		text-align: center;
		display: block;
		line-height: <?=$hiilite_options['header_line_height'];?>;
		font-family: FontAwesome;
		padding: 1em;
		font-size: 1.5em;
	}

	nav#main-nav {
		position: relative;
		transition:all 1s;
	}

	nav#main-nav .main-menu {
		position: fixed;
		z-index: 9999;
		left: 10vw;
		top: 0;
		max-height: 0vh;
		transition:all 1s;
		width: 80vw;
		display: flex;
		overflow: auto;
		box-shadow: 0 0 0 0vw rgba(0,0,0,0.3);
	}

	.main-menu li.menu-item {
		width: 100%;
		text-align: center;
	}

	nav#main-nav:hover .main-menu {
		max-height: 100vh;
		box-shadow: 0 0 0 10vw rgba(0,0,0,0.3);
	}
}

.link-list {
	list-style: none;
	margin: 1em 0;
	padding: 0;
	line-height: 2;
}
.link-list a {
	text-decoration: none;
	text-transform: uppercase;
}

.row-o-content-top .flex-item, .row-o-content-top {
    margin-top: 0;
}

.content-box {
	padding: 1em; /*set*/
	box-sizing: border-box;
}


.page-title {
	
	overflow: hidden;
	<?php 
	if ($hiilite_options['header_above_content'] == false){ echo 'position:absolute;z-index:100;margin-top: 200px;'; } else {
		echo 'position: relative;';
		echo ($hiilite_options['header_background_image'] != '')?'background-image:url('.$hiilite_options['header_background_image'].');':'';
		echo 'background-repeat:'.$hiilite_options['header_background_repeat'].';';
		echo 'background-size:'.$hiilite_options['header_background_size'].';';
		echo 'background-attachment:'.$hiilite_options['header_background_attach'].';';
		echo 'background-position:'.str_replace('-', ' ', $hiilite_options['header_background_position']).';';
		echo 'background-color:'.$hiilite_options['header_background_color'].';';
	}
	?>
	
	height: <?=$hiilite_options['title_height'];?>; /*set*/
	display: flex;
	
}

<?=$_amp?>img {
	max-width: 100%;
	height: auto;
}
<?=$_amp?>img.full-width, .full-width <?=$_amp?>iframe, .row {
	min-width: 100%;
}

.full-width, .col-12 {
	width: 100%;
}
.col-1 {
	width: 16.67%;
}
.threequarter-width, .col-9 {
	min-width: 25em;
	max-width: 76em;
	width: 75%;
	margin: auto;
}
.half-width, .col-6 {
	min-width: 20em;
	max-width: 50em;
	width: 50%;
	margin: auto;
}

.third-width, .col-4 {
	min-width: 15em;
	max-width: 33em;
	width: 33.33%;
	margin: auto;
}

.twothird-width , .col-8{
	min-width: 25em;
	max-width: 66em;
	width: 66.66%;
	margin: auto;
}
.quarter-width, .col-3 {
	min-width: 10em;
	max-width: 25em;
	width: 25%;
	margin: auto;
}


.tagline {
	background: #f2f2f2;
	width: 100%;
	text-align: center;
	padding: 0 1em;
}

.text-block {
	padding: 1em;
}




/* BUTTONS */

.button {
	<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_button_custom_css']);?>
}

.fa {
	<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_icon_custom_css']);?>
}

.custom_format_1 {
	<?php echo preg_replace('/[{}]/','',$hiilite_options['custom_format_1']);?>
}
.custom_format_2 {
	<?php echo preg_replace('/[{}]/','',$hiilite_options['custom_format_2']);?>
}
.custom_format_3 {
	<?php echo preg_replace('/[{}]/','',$hiilite_options['custom_format_3']);?>
}

/* Re coloring*/
.color_one  { color: <?=$hiilite_options['color_one'];?>; }
.color_two 	{ color: <?=$hiilite_options['color_two'];?>; }
.color_three{ color: <?=$hiilite_options['color_three'];?>; }
.color_four { color: <?=$hiilite_options['color_four'];?>; }

.label{
	background: rgba(128,128,128,0.4);
	padding: 0.3em;
	color: white;
}
.labels a{
	background: <?=$hiilite_options['color_one'];?>;
	padding: 0.3em;
	color: white;
}
strong.label {
	background: <?=$hiilite_options['color_two'];?>;
}
/* Complimentary styles */
.align-right {
	text-align: right;
	align-self: flex-end;
	margin: auto 0 auto auto;
}
.align-left {
	text-align: left;
	align-self: flex-start;
	margin: auto auto auto 0;
}
.align-center {
	text-align: center;
	align-self: center;
	margin: auto;
}
.align-top {
	vertical-align: top;
	align-self: flex-start;
	margin: 0 auto;
}


hr.small {
	width: 60px;
	border-style: solid;
}

/* dynamic custom styles when an id is defined */

.my_custom_row {
	background: url(<?php bloginfo('template_url');?>/images/bg.jpg);
	color: white;
}
.my_white_header {
	color: white;
	border-color: white;
}

/* SLIDER */
<?=$_amp?>carousel {
	min-width: 100%;
	min-height: 400px;
	max-height: 100vh;
}

<?=$_amp?>carousel.slider .slide-text-overlay {
	position: absolute;
	width: 80%;
	top: 10%;
	left: 10%;
	height: 80%;
	<?=$slider_slide_styles?>
}
amp-carousel.slider .slide-text-overlay amp-fit-text {
	height: 100%;
}

/*for when image bleeds beyond edges*/
amp-carousel <?=$_amp?>img {
	max-height: 100%;
	max-width: 150%;
	margin-left: -25%;
}
.text-align.center {
	text-align: center;
}

/* Gravity Forms */
.gform_fields {
	padding: 0;
	list-style: none;
}
input,textarea {padding: 1em;border: 1px solid gray; font-size: 1rem;}

.gfield {
    margin-bottom: 2em;
}

.gfield span label {
    /* width: 100%; */
    display: inline-block;
    position: absolute;
    left: 0;
    bottom: -2em;
    font-size: 12px;
}

.gfield span {
    position: relative;
    display: inline-block;
}

#disqus_thread {
	width: 100%;
}


/* PARALLAX */
.vc_row-parallax {	
	position: relative;
	width: 100%;
	transform-style: preserve-3d;
	z-index: -1;
}
.vc_row-parallax .parallax-image img {
	height: auto;
}

.vc_row-parallax .parallax-image {
	content: '';
	position: absolute;
	
	bottom: 0;
	left: 0;
	right: 0;
	min-width: 100vw;
	transform: translateZ(-1px) scale(2);
	
}
<?php
do_action ( 'custom_css' );
echo $hiilite_options['custom_css'];
?>
</style>
<?php if($hiilite_options['amp']) { ?>

	<script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
	<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
	<script async custom-element="amp-lightbox" src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js"></script>
	<script async custom-element="amp-anim" src="https://cdn.ampproject.org/v0/amp-anim-0.1.js"></script>
	<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
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
					<!--Insert header_center_right here if layout set to centered -->
					<?php if($hiilite_options['header_center_right_on'] && $hiilite_options['header_type'] == 'centered'){ 
						wp_nav_menu(array(
								'menu' =>  'right-menu',
								'container' => 'div',
								'container_class' => 'align-right flex-item',
								'container_id' => 'header_center_right',
								'items_wrap'  => '<ul id="%1s" class="%2$s right-menu">%3$s</ul>',
								'theme_location' => 'right-menu'
							));	
					} 
					wp_nav_menu(array(
								'menu' =>  'header-menu',
								'container' => 'nav',
								'container_class' => 'flex-item',
								'container_id' => 'main-nav',
								'items_wrap'  => '<ul id="%1s" class="%2$s main-menu">%3$s</ul>',
								'theme_location' => 'header-menu'
							)); 
					
					if($hiilite_options['header_center_right_on'] && $hiilite_options['header_type'] == 'regular'){ 
						wp_nav_menu(array(
								'menu' =>  'right-menu',
								'container' => 'div',
								'container_class' => 'align-right flex-item',
								'container_id' => 'header_center_right',
								'items_wrap'  => '<ul id="%1s" class="%2$s right-menu">%3$s</ul>',
								'theme_location' => 'right-menu'
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
			