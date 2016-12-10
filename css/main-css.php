<style <?php if($hiilite_options['amp']) echo 'amp-custom'; ?>>
<?php 
global $is_IE;
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
include_once('font-awesome/css/font-awesome.min.css'); 
	
	
function get_font_css($font){
	if(is_array($font)){
		foreach($font as $key => $value){
			if($value != ' ' && $value != '' && $value != 'px'){
				if($key == 'variant') { 
					echo 'font-weight:';
					switch ($value) {
						case 'regular':
							echo '400';
						break;
						case '100italic':
							echo '100;font-style:italic;';
						break;
						case '200italic':
							echo '200;font-style:italic;';
						break;
						case '300italic':
							echo '300;font-style:italic;';
						break;
						case '400italic':
							echo '400;font-style:italic;';
						break;
						case '600italic':
							echo '600;font-style:italic;';
						break;
						case '700italic':
							echo '700;font-style:italic;';
						break;
						case '800italic':
							echo '800;font-style:italic;';
						break;
						case '900italic':
							echo '900;font-style:italic;';
						break;
						case 'italic':
							echo '400;font-style:italic;';
						break;
						default:
							echo $value.';';
						break;
					}
					echo ';';
				}
				elseif ($key == 'text-align') {
					switch ($value) {
						case 'right':
							echo 'margin-left:auto;';
						break;
						case 'center':
							echo 'margin-left:auto;';
							echo 'margin-right:auto;';
						break;
						case 'left':
							echo 'margin-right:auto;';
						break;
					}
					echo $key.':'.$value.';';
				}
				else { echo $key.':'.$value.';'; }
				
				
				
				
			}
		}
	}
}
function get_spacing($spacing){
	$values = '';

	$values = $spacing['top'].' '.$spacing['right'].' '.$spacing['bottom'].' '.$spacing['left'];
	
	return $values;
}
?>
html {
	<?php 
	get_font_css($hiilite_options['default_font']);
	?>
	-webkit-font-smoothing: antialiased;
    text-shadow: 1px 1px 1px rgba(0,0,0,0.004);
}
body {
	margin: 0;
}
<?php 
$link_color = get_theme_mod('link_color');
	?>
a {
	color:<?=$link_color['link'];?>;<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_link_custom_css']); ?>
}
a:hover {
	color:<?=$link_color['hover'];?>;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
	color: #303030;
    transition: color .1s linear;
}
.blog-article .post_author a {
    color: #bebebe;
}
figure {
	display: block;
	margin: auto;
	padding: 0;
	position: relative;
}
figure.align-center <?=$_amp?>img{
	margin: auto;
}

figure.single-image.hover-image {
    position: relative;
}
figure.single-image.hover-image .hover_image-img {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    opacity: 0;
    transition: all 0.5s;
}
figure.single-image.hover-image:hover .hover_image-img {
    opacity: 1;
}

address {
	display: inline-block;
}
amp-img[layout=responsive] {
    max-width: 100%;
}

hr {
    clear: both;
    width: 100%;
}

/* TYPOGRAPHY */
h1,h2,h3,h4,h5,h6,.h1,.h2 {
	<?php 
	get_font_css($hiilite_options['heading_font']);
	?>
	line-height:1.5;
	margin: 0;
}
<?php 
//////////////////////
//
//	Generate Heading tags
//
//////////////////////
for($h=1;$h<=6;$h++):
	echo "h$h,.h$h {";
	get_font_css($hiilite_options['typography_h'.$h.'_font']);
	echo '}';
endfor; ?>
@media (max-width:768px){
<?php 
for($h=1;$h<=6;$h++):
	$font_size = preg_match('!\d+!', $hiilite_options['typography_h'.$h.'_font']['font-size'],$fs_int);
	$font_unit = preg_replace("/[^a-zA-Z]+/", "", $hiilite_options['typography_h'.$h.'_font']['font-size']);
	if($font_size && $font_unit){
	echo "h$h,.h$h {";
	echo 'font-size:'. ($fs_int[0]* 0.8).$font_unit;
	echo '}';
	}
endfor; ?>
}
@media (max-width:550px){
<?php 
for($h=1;$h<=6;$h++):
	$font_size = preg_match('!\d+!', $hiilite_options['typography_h'.$h.'_font']['font-size'],$fs_int);
	$font_unit = preg_replace("/[^a-zA-Z]+/", "", $hiilite_options['typography_h'.$h.'_font']['font-size']);
	if($font_size && $font_unit){
	echo "h$h,.h$h {";
	echo 'font-size:'. ($fs_int[0]* 0.75).$font_unit;
	echo '}';
	}
endfor; ?>
}

p {
<?php	
	get_font_css(get_theme_mod( 'text_font' ));
	echo 'margin-bottom:'.get_theme_mod( 'text_margin' ).';';
?>
}
.clearfix:before,
.clearfix:after {
	content: " ";
	display: table;
	clear: both;
}

table td {
	vertical-align: top;
}
/* CONTAINERS */
.wrapper, .wrapper_inner {
	width:100%;
}

.container_inner, .in_grid {
	margin: auto;
	display: flex;
	width: 100%;
	align-items: stretch;
	flex-wrap: wrap;
	box-sizing: border-box;
}
.row {
	box-sizing: border-box;
	background-position: center top;
}
.in_grid {
	max-width: <?=$hiilite_options['grid_width'];?>;
}
.row-o-full-height {
	min-height: 100vh;
	display: flex;
	scroll-snap-type: proximity;

	/* older spec implementation */
	scroll-snap-destination: 0% 100%;
	scroll-snap-points-x: repeat(100%);
}
.row_reverse {
	flex-direction: row-reverse;
}
.row-o-direction-row>.container_inner, .flex-container.row-o-direction-row, .row-o-direction-row .vc_column-inner .wpb_wrapper.flex-container {
	flex-direction: row !important;
}
.row-o-direction-row-reverse>.container_inner, .flex-container.row-o-direction-row-reverse, .row-o-direction-row-reverse .vc_column-inner .wpb_wrapper.flex-container {
	flex-direction: row-reverse !important;
}
.row-o-direction-column>.container_inner, .flex-container.row-o-direction-column, .row-o-direction-column .vc_column-inner .wpb_wrapper.flex-container {
	flex-direction: column !important;
}
.row-o-direction-column-reverse>.container_inner, .flex-container.row-o-direction-column-reverse, .row-o-direction-column-reverse .vc_column-inner .wpb_wrapper.flex-container {
	flex-direction: column-reverse !important;
}
.row-o-wrap-nowrap>.container_inner, .flex-container.row-o-wrap-nowrap, .row-o-wrap-nowrap .vc_column-inner .wpb_wrapper.flex-container {
	flex-wrap: nowrap !important;
}
.row-o-wrap-wrap>.container_inner, .flex-container.row-o-wrap-wrap, .row-o-wrap-wrap .vc_column-inner .wpb_wrapper.flex-container {
	flex-wrap: wrap !important;
}
.row-o-wrap-wrap-reverse>.container_inner, .flex-container.row-o-wrap-wrap-reverse, .rrow-o-wrap-wrap-reverse .vc_column-inner .wpb_wrapper.flex-container {
	flex-wrap: wrap-reverse !important;
}
.row-o-content-justify-flex-start>.container_inner, .flex-container.row-o-content-justify-flex-start, .row-o-content-justify-flex-start .vc_column-inner .wpb_wrapper.flex-container {
	justify-content: flex-start !important;
}
.row-o-content-justify-flex-end>.container_inner, .flex-container.row-o-content-justify-flex-end, .row-o-content-justify-flex-end .vc_column-inner .wpb_wrapper.flex-container {
	justify-content: flex-end !important;
}
.row-o-content-justify-center>.container_inner, .flex-container.row-o-content-justify-center, .row-o-content-justify-center .vc_column-inner .wpb_wrapper.flex-container {
	justify-content: center !important;
}
.row-o-content-justify-space-between>.container_inner, .flex-container.row-o-content-justify-space-between, .row-o-content-justify-space-between .vc_column-inner .wpb_wrapper.flex-container {
	justify-content: space-between !important;
}
.row-o-content-justify-space-around>.container_inner, .flex-container.row-o-content-justify-space-around, .row-o-content-justify-space-around .vc_column-inner .wpb_wrapper.flex-container {
	justify-content: space-around !important;
}
.vc_row-o-columns-top>.container_inner, .flex-container.vc_row-o-columns-top, .vc_row-o-columns-top .vc_column-inner .wpb_wrapper.flex-container {
	align-items: flex-start !important;
}
.vc_row-o-columns-bottom>.container_inner, .flex-container.vc_row-o-columns-bottom, .vc_row-o-columns-bottom .vc_column-inner .wpb_wrapper.flex-container {
	align-items: flex-end !important;
}
.vc_row-o-columns-middle>.container_inner, .flex-container.vc_row-o-columns-middle, .vc_row-o-columns-middle .vc_column-inner .wpb_wrapper.flex-container {
	align-items: center !important;
}
.vc_row-o-columns-stretch>.container_inner, .flex-container.vc_row-o-columns-stretch, .vc_row-o-columns-stretch .vc_column-inner .wpb_wrapper.flex-container {
	align-items: stretch !important;
}
.vc_row-o-columns-baseline>.container_inner, .flex-container.vc_row-o-columns-baseline, .vc_row-o-columns-baseline .vc_column-inner .wpb_wrapper.flex-container {
	align-items: baseline !important;
}
.row-o-content-align-w-flex-start>.container_inner, .flex-container.row-o-content-align-w-flex-start, .row-o-content-align-w-flex-start .vc_column-inner .wpb_wrapper.flex-container {
	align-content: flex-start !important;
}
.row-o-content-align-w-flex-end>.container_inner, .flex-container.row-o-content-align-w-flex-end, .row-o-content-align-w-flex-end .vc_column-inner .wpb_wrapper.flex-container {
	align-content: flex-end !important;
}
.row-o-content-align-w-center>.container_inner, .flex-container.row-o-content-align-w-center, .row-o-content-align-w-center .vc_column-inner .wpb_wrapper.flex-container {
	align-content: center;
}
.row-o-content-align-w-stretch>.container_inner, .flex-container.row-o-content-align-w-stretch, .row-o-content-align-w-stretch .vc_column-inner .wpb_wrapper.flex-container {
	align-content: stretch !important;
}
.row-o-content-align-w-space-between>.container_inner, .flex-container.row-o-content-align-w-space-between, .row-o-content-align-w-space-between .vc_column-inner .wpb_wrapper.flex-container {
	align-content: space-between !important;
}
.row-o-content-align-w-space-around>.container_inner, .flex-container.row-o-content-align-w-space-around, .row-o-content-align-w-space-around .vc_column-inner .wpb_wrapper.flex-container {
	align-content: space-around !important;
}

/* Background Images */
body .bg-img-pos-lt {
	background-position: left top !important;
}
body .bg-img-pos-lc {
	background-position: left center !important;
}
body .bg-img-pos-lb {
	background-position: left bottom !important;
}
body .bg-img-pos-rt {
	background-position: right top !important;
}
body .bg-img-pos-rc {
	background-position: right center !important;
}
body .bg-img-pos-rb {
	background-position: right bottom !important;
}
body .bg-img-pos-ct {
	background-position: center top !important;
}
body .bg-img-pos-cc {
	background-position: center center !important;
}
body .bg-img-pos-cb {
	background-position: center bottom !important;
}

/* HEADER */
header#main_header {
	width: 100%;
	padding: 1em 0;
	align-items: center;
	flex-wrap: wrap;
	z-index: 9999;
	transition: all 0.5s;
	<?php 
	if ($hiilite_options['header_above_content'] == false){ 
		echo 'position:absolute;'; 
	} 
	?>
}
<?php
if($hiilite_options['header_top_home'] == true){
	?>
	#header_top_pages {
		<?php
		echo ($hiilite_options['header_top_pages_background_image'] != '')?'background-image:url('.$hiilite_options['header_top_pages_background_image'].');':'';
		echo 'background-repeat:'.$hiilite_options['header_top_pages_background_repeat'].';';
		echo 'background-size:'.$hiilite_options['header_top_pages_background_size'].';';
		echo 'background-attachment:'.$hiilite_options['header_top_pages_background_attach'].';';
		echo 'background-position:'.str_replace('-', ' ', $hiilite_options['header_top_pages_background_position']).';';
		echo 'background-color:'.$hiilite_options['header_top_pages_background_color'].';';	
		echo 'height:'.$hiilite_options['header_top_pages_height'].';';
	?>
	}

	<?php
}

?>
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

<?php } elseif($hiilite_options['header_type'] == 'fixed'){	?>
header#main_header.fixed.scrolled {
    position: fixed;
    top: 0;
    max-height: 3em;
    padding: 0;
}
header#main_header.fixed.scrolled #logo_container img {
    width: auto;
    
    max-height: 2em;
    margin: 0.5em;
}
header#main_header.fixed.scrolled ~ section:first-of-type {
    margin-top:5em !important;
}
<?php
}
?>

@media (max-width:<?=$hiilite_options['grid_width'];?>){
	.container_inner {
		padding: 0em;
	}
}
<?php
/*
*
*  HEADER TOP
*
*/	
$header_top_colors = get_theme_mod( 'header_top_colors' );
?>
#header_top {
	background: <?=$hiilite_options['header_top_background_color']?>;
	border:0px solid;
	<?php 
	get_font_css($hiilite_options['header_top_font']);
?>
}
#header_top a{
	color:<?=$header_top_colors['link'];?>;
}
#header_top a:hover{
	color:<?=$header_top_colors['hover'];?>;
}
<?php if(get_theme_mod('hide_top_bar_on_mobile_yesno') == true): ?>
@media (max-width:<?=get_theme_mod('mobile_menu_switch','768px')?>){
	#header_top {
		display:none;
	}
}
<?php endif; ?>

#header_bottom {
	border-bottom-style: solid;
}
#main_header #header_bottom .menu .menu-item a{
	<?php 
		get_font_css(get_theme_mod( 'header_bottom_font' ));
	?>
}

#header_bottom .bottom-menu {
	justify-content: center;
}


#logo_container {
    max-width: 100%;
    <?php 
	    foreach($hiilite_options['logo_padding'] as $key=>$value){
		    echo 'padding-'.$key.':'.$value.';';
	    }
    ?>
}

#logo_container <?=($_amp!='')?$_amp.'img':'';?> img {
    height: auto;
    transition: all 0.5s;
}

/* FOOTER */
<?php
$footer_top_colors = get_theme_mod('footer_top_colors');
$footer_bottom_colors = get_theme_mod('footer_bottom_colors');	
?>
#main_footer {
	background: <?=$hiilite_options['footer_background_color'];?>;
	<?php 
	echo 'background-image:url('.$hiilite_options['footer_background_image'].');';
	echo 'background-repeat:'.$hiilite_options['footer_background_repeat'].';';
	echo 'background-size:'.$hiilite_options['footer_background_size'].';';
	echo 'background-attachment:'.$hiilite_options['footer_background_attach'].';';
	echo 'background-position:'.str_replace('-', ' ', $hiilite_options['footer_background_position']).';';
	echo 'background-color:'.$hiilite_options['footer_background_color'].';';
 
	get_font_css($hiilite_options['typography_footer_text_font']);
	
?>
border-top-style:solid;
} 

#main_footer h1,#main_footer h2,#main_footer h3,#main_footer h4,#main_footer h5,#main_footer h6 {
	<?php get_font_css($hiilite_options['typography_footer_headings_font']); ?>
}
#main_footer a {
	<?php get_font_css($hiilite_options['typography_footer_links_font']); ?>
}

<?php 
if(get_theme_mod( 'show_footer_top_yesno', true )): ?>
 #footer_top {
	<?php 
	echo 'background-image:url('.get_theme_mod('footer_top_background_image').');';
	echo 'background-repeat:'.get_theme_mod('footer_top_background_repeat').';';
	echo 'background-size:'.get_theme_mod('footer_top_background_size').';';
	echo 'background-attachment:'.get_theme_mod('footer_top_background_attach').';';
	echo 'background-position:'.str_replace('-', ' ', get_theme_mod('footer_top_background_position')).';';
	echo 'background-color:'.get_theme_mod('footer_top_background_color').';';
	?>
<?php 
	if($footer_top_colors['text']) echo 'color:'.$footer_top_colors['text'];
?>
}
<?php endif; ?>

#footer_top .widgettitle {
<?php 
	get_font_css($hiilite_options['typography_footer_headings_font']);
	if($footer_top_colors['title']) echo 'color:'.$footer_top_colors['title'];
?>
}

#footer_top a {
<?php 
	get_font_css($hiilite_options['typography_footer_links_font']);
	if($footer_top_colors['link']) echo 'color:'.$footer_top_colors['link'];
?>
}
#footer_top a:hover {
<?php 
	if($footer_top_colors['hover']) echo 'color:'.$footer_top_colors['hover'];
?>
}

#main_footer ul {
    list-style: none;
    padding: 0;
}
#footer_top, #footer_page {
	
	align-content: flex-start;
	display: flex;
	align-items: center;
	flex-wrap: wrap;
}
#footer_top .menu, #footer_page .menu {
	display: block;
}


#footer_top .flex-item{
	margin: 0 auto auto 0;
	
}
#footer_bottom{
	background: <?php echo $hiilite_options['footer_bottom_background_color']; ?>;
	border-top-style: solid;
	<?php 
	get_font_css(get_theme_mod('typography_footer_bottom_text_font'));
	if($footer_bottom_colors['text']) echo 'color:'.$footer_bottom_colors['text']; ?>
}


#footer_bottom a {
<?php 
	if($footer_bottom_colors['link']) echo 'color:'.$footer_bottom_colors['link'];
?>
}
#footer_bottom a:hover {
<?php 
	if($footer_bottom_colors['hover']) echo 'color:'.$footer_bottom_colors['hover'];
?>
}

.flex-container {
	display: flex;
	flex-wrap:wrap;
	width: 100%;
	box-sizing: border-box;
}
.flex-item {
	flex: 1 1 auto;
	<?php if($is_IE) echo 'flex-basis: 0%';?>
}
.flex-item.item-align-auto, .wpb_column.item-align-auto {
	align-self:auto;
}
.flex-item.item-align-start, .wpb_column.item-align-start {
	align-self:flex-start;
}
.flex-item.item-align-end, .wpb_column.item-align-end {
	align-self:flex-end;
}
.flex-item.item-align-center, .wpb_column.item-align-center {
	align-self:center;
}
.flex-item.item-align-stretch, .wpb_column.item-align-stretch {
	align-self:stretch;
}
.flex-item.item-align-baseline, .wpb_column.item-align-baseline {
	align-self:baseline;
}


<?php 
	
/*
*
*	MENU
*	
*/
$main_menu_colors = get_theme_mod('main_menu_colors');	
?>
/* MENU */
.menu {
	
	list-style: none;
	padding: 0;
	margin: 0;
	display: flex;
	flex-wrap: wrap;
	justify-content: flex-end;
}

.menu .menu-item  {
	position: relative;
}
#main_header .menu .menu-item a {
	text-decoration: none;
	display:block;
	<?php 
	get_font_css($hiilite_options['main_menu_font']);
	?>
	<?=$hiilite_options['main_menu_links_css'];?>
}

#main_header .menu li:hover {
	background: <?=$main_menu_colors['hover_background'];?>;
}
#main_header .menu .current-menu-item a {
	color:<?=$main_menu_colors['active'];?>;
}
#main_header .menu li:hover a {
	color:<?=$main_menu_colors['hover'];?>;
}

.right-menu {
	justify-content: flex-start;
}

<?php
/*
*	SUB MENU
*/
$second_level_menu_colors = get_theme_mod('second_level_menu_colors');
?>
#main_header ul.sub-menu {
    position: absolute;
    list-style: none;
    padding: 0;
    display: none;
	min-width: 12em;
	z-index: 10;
}
#main_header .menu li:hover > ul.sub-menu {
	display:block;
}
#main_header .menu ul.sub-menu .menu-item a {
	text-decoration: none;
	display:block;
	<?php 
	get_font_css(get_theme_mod('second_level_menu_font'));
	echo get_theme_mod('second_level_menu_links_css');
	?>
}
#main_header .menu ul.sub-menu li:hover {
	background: <?=$second_level_menu_colors['hover_background'];?>;
}
#main_header .menu ul.sub-menu .current-menu-item a {
	color:<?=$second_level_menu_colors['active'];?>;
}
#main_header .menu ul.sub-menu li:hover a {
	color:<?=$second_level_menu_colors['hover'];?>;
}

<?php
/*
*	SUB SUB MENU
*/
$third_level_menu_colors = get_theme_mod('third_level_menu_colors');
?>
#main_header .menu li>ul.sub-menu>li:hover>ul.sub-menu {
    position: absolute;
    left: 100%;
    top: 0;
}
#main_header .menu ul.sub-menu ul.sub-menu .menu-item a {
	<?php 
	get_font_css(get_theme_mod('third_level_menu_font'));
	echo get_theme_mod('third_level_menu_links_css');
	?>
}
#main_header .menu ul.sub-menu ul.sub-menu li:hover {
	background: <?=$third_level_menu_colors['hover_background'];?>;
}
#main_header .menu ul.sub-menu ul.sub-menu .current-menu-item a {
	color:<?=$third_level_menu_colors['active'];?>;
}
#main_header .menu ul.sub-menu ul.sub-menu li:hover a {
	color:<?=$third_level_menu_colors['hover'];?>;
}




a, .button, .menu li {
	transition:all 0.4s;
}
@media (max-width:<?=$hiilite_options['mobile_menu_switch'];?>){
	#main_header nav#main-nav:before {
		content: '\f0c9';
		text-align: center;
		display: block;
		line-height: <?=$hiilite_options['header_line_height'];?>;
		font-family: FontAwesome;
		padding: 1em;
		font-size: 1.5em;
	}

	#main_header nav#main-nav {
		position: relative;
		transition:all 1s;
		display: block;
	}

	#main_header nav#main-nav .main-menu {
		position: relative;
		z-index: 9999;
		background: <?=get_theme_mod( 'main_menu_background_color', 'white' )?>;
		left: 0;
		top: 0;
		max-height: 0;
		transition: all 1s;
		width: 100vw;
		display: flex;
		overflow: auto;
	}

	#main_header .main-menu li {
		width: 100%;
		text-align: center;
	}

	#main_header nav#main-nav:hover .main-menu {
		max-height: 100vh;
	}
	#main_header ul.sub-menu {
		position: relative;
		display: block;
	}
	#main_header ul.sub-menu:before {
	    position: absolute;
	    content: "M";
	    top: -3.5em;
	    right: 0em;
	    padding: 1em 1.5em;
	    font-family: FontAwesome;
	    content: '\f055';
	}
	#main_header ul.sub-menu:hover:before {
	    content: '\f056';
	}
	#main_header ul.sub-menu li {
	    display: none;
	}
	#main_header ul.sub-menu:hover>li {
	    display: block;
	}
	#main_header .menu li>ul.sub-menu>li:hover>ul.sub-menu {
		box-shadow: inset 0 0 1px black;
		position: relative;
		left: 0;
	}
	#main_header ul.sub-menu>li ul.sub-menu:hover>li {
	    display: block;
	    
	    
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
		echo ($hiilite_options['title_background_image'] != '')?'background-image:url('.$hiilite_options['title_background_image'].');':'';
		echo 'background-repeat:'.$hiilite_options['title_background_repeat'].';';
		echo 'background-size:'.$hiilite_options['title_background_size'].';';
		echo 'background-attachment:'.$hiilite_options['title_background_attach'].';';
		echo 'background-position:'.str_replace('-', ' ', $hiilite_options['title_background_position']).';';
		echo 'background-color:'.$hiilite_options['title_background_color'].';';
	}
	?>
	
	height: <?=$hiilite_options['title_height'];?>; /*set*/
	display: flex;
	
}
.page-title h1 {
	margin-bottom: 0;
	<?php 
	get_font_css($hiilite_options['title_font']);
	?>
}

<?=$_amp?>img {
	max-width: 100%;
	height: auto;
}
<?=$_amp?>img.full-width, .full-width <?=$_amp?>iframe, .row {
	min-width: 100%;
	scroll-snap-type: proximity;

	/* older spec implementation */
	scroll-snap-destination: 0% 100%;
	scroll-snap-points-x: repeat(100%);
}
.full-width,.threequarter-width,.half-width,.third-width,.twothird-width,.quarter-width,
.col-12,.col-9,.col-7,.col-8,.col-6,.col-4,.col-3,.col-2,.col-1 {
    box-sizing: border-box;
    min-width: 100px;
}
<?php 
$alt_cols =	array(false,false,false,'quarter-width','third-width',false,'half-width',false,'twothird-width','threequarter-width',false,false,'full-width');
$col_4 = ($hiilite_options['grid_width'] / 3) + 1;
for($i = 12; $i>0;$i--){
	echo '.col-'.$i;
	echo ($alt_cols[$i])?', .'.$alt_cols[$i]:'';
	echo '{';
		$perc_ratio = (($i/12)*100) - 0.1;
		echo ($i > 12)?'max-width:'.$perc_ratio.'em;':'max-width:100%;';
		echo 'width:'.$perc_ratio.'%;';
		$min_width = ($i>4)?'320':'160';
		echo 'flex:1 1 '.$perc_ratio.'%;';
		if($is_IE) echo 'flex-basis: '.($perc_ratio - 5).'%;';
	echo '}';
} 
?>
@media (max-width:550px){
<?php
for($i = 12; $i>0;$i--){
	echo '.col-'.$i;
	echo ($alt_cols[$i])?', .'.$alt_cols[$i]:'';
	echo '{';
		$perc_ratio = (($i/12)*100);
		echo 'width:'.$perc_ratio.'%;';
		$min_width = ($i>2)?'320':'160';
		echo 'flex:1 1 '.$min_width.'px;';
	echo '}';
} 	
?>
}



.fixed_columns .flex-item {
	min-width: 0;
	position: relative;
	box-sizing: border-box;
	max-width: 100%;
}
.fixed_columns {
	align-items: stretch;
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

.author_details <?=$_amp?>img {
	margin-right: 1em; 
}
.author_bio_section {
	background: rgba(240,240,240,0.8);
}
.blog-article {
	padding-bottom: 2em;
	margin-top: 0;
	display: flex;
	flex-wrap: wrap;
	break-inside:avoid;
}
.blog-article .content-box {
	padding-top: 2px;
	padding:2px 2em;
}
.blog-article figure {
	padding: 0 2em;
}

/*
*
*	Pagination 
*
*/
.pagination ul {
	list-style:none;
}
.pagination ul li {
	display:inline-block;
}
.pagination ul li a.button, .pagination ul li .button-dis  {
	padding: 0.5em 1em;
	margin-left:0.5em;
	margin-right:0.5em;
}

<?php if($hiilite_options['blog_layout'] == 'boxed'): ?>
.boxed .blog-article h4 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.boxed .blog-article p {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    font-size: 0.9em;
}
<?php endif; ?>
.masonry {
	display: block;
	column-width: 17em;
	-moz-column-width: 17em;
	column-gap:0;
	-moz-column-gap:0;
}
.masonry img {
    min-width: 100%;
}
.masonry article{
	-webkit-column-break-inside: avoid;
    page-break-inside: avoid;
    break-inside: avoid;
}
.col-count-1 {
	column-count:1;
	-moz-column-count:1;
}
.col-count-2 {
	column-count:2;
	-moz-column-count:2;
}
.col-count-3 {
	column-count:3;
	-moz-column-count:3;
}
.col-count-4 {
	column-count:4;
	-moz-column-count:4;
}
<?php 

if($hiilite_options['portfolio_on']): ?>
.portfolio-piece {
	padding: 0.5em;
}
.portfolio-piece .content-box {
	box-shadow: inset 0 0 1px rgba(0,0,0,0.1);
}
.portfolio-piece h5 {
	margin: 0;
}
.portfolio_row .post_meta {
	position: absolute;
    width: 100%;
    bottom: 10px;
    text-align: center;
}
.portfolio_row .post_meta h3 {
	margin: 2px;
	background: rgba(255,255,255,0.8);
	display: inline-block;
	padding: 5px;
}
.portfolio_row .post_meta small {
	margin: 2px;
    background: rgba(255,255,255,0.8);
    display: inline-block;
    padding: 5px;
}
<?php endif; ?>

<?php if($hiilite_options['teams_on']): ?>
.team-member {
	padding: 0.5em;
}

.team-member h5 {
	margin: 0;
}
.team-member figure {
	overflow:hidden;
	max-width: 300px;	
	max-height: 300px;
	position: relative;
}
.team-member figure <?=$_amp?>img {
 
}
<?php endif; ?>



/* 
*
*	BUTTONS 
*
*/

.button {
	
	<?php 
		get_font_css($hiilite_options[ 'typography_button_default_font' ]);
		echo 'background:'.$hiilite_options[ 'typography_button_default_background' ].';';
		echo 'padding:'.get_spacing($hiilite_options[ 'typography_button_default_padding' ]).';';
		echo 'border:'.$hiilite_options['typography_button_default_border_width'].' solid '.$hiilite_options['typography_button_default_border_color'].';';
		echo 'border-radius:'.$hiilite_options[ 'typography_button_default_border_radius' ].';';
		echo preg_replace('/[{}]/','',$hiilite_options['typography_button_custom_css']);?>
}
.button-primary {
	<?php 
		get_font_css($hiilite_options[ 'typography_button_primary_font' ]);
		echo 'background:'.$hiilite_options[ 'typography_button_primary_background'].';';
		echo 'padding:'.get_spacing($hiilite_options[ 'typography_button_primary_padding' ]).';';
		echo 'border: '.$hiilite_options[ 'typography_button_primary_border_width'].' solid '.$hiilite_options['typography_button_primary_border_color'].';';
		echo 'border-radius:'.$hiilite_options['typography_button_primary_border_radius'].';';
		echo preg_replace('/[{}]/','',$hiilite_options['typography_button_primary_custom_css']);?>
}

.button-secondary {
	<?php 
		get_font_css($hiilite_options[ 'typography_button_secondary_font' ]);
		echo 'background:'.$hiilite_options[ 'typography_button_secondary_background'].';';
		echo 'padding:'.get_spacing($hiilite_options[ 'typography_button_secondary_padding' ]).';';
		echo 'border: '.$hiilite_options[ 'typography_button_secondary_border_width'].' solid '.$hiilite_options['typography_button_secondary_border_color'].';';
		echo 'border-radius:'.$hiilite_options['typography_button_secondary_border_radius'].';';
		echo preg_replace('/[{}]/','',$hiilite_options['typography_button_secondary_custom_css']);?>
}
.button-dis { 
	border: 2px solid #989898;
	color: #989898;
}
.fa {
	<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_icon_custom_css']);?>
}

.custom_format_1 { <?=$hiilite_options['custom_format_1'];?> }
.custom_format_2 { <?=$hiilite_options['custom_format_2'];?> }
.custom_format_3 { <?=$hiilite_options['custom_format_3'];?> }


/*
*
*	WIDGETS
*
*/
.widget {
	<?php get_font_css(get_theme_mod( 'sidebar_widget_text_font' )); ?>
}
.widgettitle {
	<?php get_font_css(get_theme_mod( 'sidebar_widget_title_font' )); ?>
}
.widget a {
	<?php	get_font_css(get_theme_mod( 'sidebar_widget_link_font' ));	?>
}
.widget ul {
	list-style: none;
	padding: 0;
}
.widget ul ul{
	list-style: none;
	padding-left: 1em;
}
/* Re coloring*/
.color_one  { color: <?=$hiilite_options['color_one'];?>; }
.color_two 	{ color: <?=$hiilite_options['color_two'];?>; }
.color_three{ color: <?=$hiilite_options['color_three'];?>; }
.color_four { color: <?=$hiilite_options['color_four'];?>; }
.white, .page-title h1.white, 
.white h1, .white h2, .white h3, .white h4, .white h5, .white h6, .white p { color:white; }
.bg_color_one  { background-color: <?=$hiilite_options['color_one'];?>; }
.bg_color_two 	{ background-color: <?=$hiilite_options['color_two'];?>; }
.bg_color_three{ background-color: <?=$hiilite_options['color_three'];?>; }
.bg_color_four { background-color: <?=$hiilite_options['color_four'];?>; }
.bg_white { background-color:white; }

.label, .labels a{
	background: rgba(128,128,128,0.4);
	padding: 0.3em;
	color: white;
	font-size: 0.7em;
	
}
.labels a{
	background: <?=$hiilite_options['color_one'];?>;
}
strong.label {
	background: <?=$hiilite_options['color_two'];?>;
}
/* Complimentary styles */
.align-right, .alignright {
	text-align: right;
	align-self: flex-end;
	margin: auto 0 auto auto;
}
.align-left, .alignleft {
	text-align: left;
	align-self: flex-start;
	margin: auto auto auto 0;
}
.align-center, .aligncenter {
	text-align: center;
	align-self: center;
	margin: auto;
	justify-content: center;
}
.align-top {
	vertical-align: top;
	align-self: flex-start;
	margin: 0 auto auto auto;
}
.align-bottom {
	vertical-align:bottom;
	align-self: flex-end;
	margin: auto auto 0 auto;
}
.row-o-content-bottom .container_inner {
    margin-top: auto;
    margin-bottom: 0;
}
.align-top-left {
	vertical-align:top;
	align-self: flex-start;
	margin: 0 auto auto 0;
}
.align-top-right {
	vertical-align:top;
	align-self: flex-start;
	margin: 0 0 auto auto;
}
.align-bottom-left {
	vertical-align:bottom;
	align-self: flex-end;
	margin: auto auto 0 0;
}
.align-bottom-right {
	vertical-align:bottom;
	align-self: flex-end;
	margin: auto 0 0 auto;
}

hr.small {
	width: 60px;
	border-style: solid;
}

/* dynamic custom styles when an id is defined */

/* SLIDER */
amp-carousel.slider {
	min-width: 100%;
	max-height: 100vh;
	display: block;
	position: relative;
}

amp-carousel.slider .slide-text-overlay {
	position: absolute;
	width: 80%;
	top: 10%;
	left: 10%;
	height: 80%;
	<?php echo (isset($slider_slide_styles))?$slider_slide_styles:'';?>
}
amp-carousel.slider .slide-text-overlay amp-fit-text {
	height: 100%;
}
amp-carousel.slider amp-img img {
    height: auto;
}
amp-carousel[type=slides] .slide {
	transition: none;
}

/*for when image bleeds beyond edges*/
amp-carousel.slider <?=$_amp?>img {
	max-height: 100%;
	max-width: 100%;
	min-width:100%;
}


amp-carousel.carousel {
	width: 100%;
	height: 300px;
	overflow: hidden;
}

.relatedposts .relatedarticle {
	max-width: 200px;
	overflow: hidden;
}
.relatedposts .relatedarticle p {
	max-width: 200px;
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
}

.post-grid h5 {
	height:4em;
	text-overflow: ellipsis;
	overflow: hidden;
}
.post-grid figure {
    position: relative;
    padding-top:56%;
    width: 100%;
    height: 100%;
    overflow: hidden;
    margin-bottom: 0.5em;
}

.post-grid figure img {
    position: absolute;
    top: 0;
    min-height: 100%;
    max-width: 100%;
    width: auto;
    min-width: 100%;
}

<?php
	
if($hiilite_options['testimonials_on']):
	?>
.testimonial_item {
    padding: 0 3em;
}
.testimonial_content { 
	<?php get_font_css($hiilite_options[ 'testimonials_body_font' ]); ?>
}
.testimonial_author {
	<?php get_font_css($hiilite_options[ 'testimonials_author_font' ]); ?>
}
<?php endif ?>

.text-align.center {
	text-align: center;
}
/* Gravity Forms */
.gform_fields {
	padding: 0;
	list-style: none; 
}
input,textarea,select {padding:1em; border: 1px solid rgba(203, 203, 203, 1); font-size: 1rem;}
.ginput_complex {
	
}
.ginput_full {
    width: 100%;
}
.gfield {
    margin-bottom: 2em;
}
.gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]) {
	padding:1em;
}
.gform_wrapper .chosen-container-single .chosen-single,.gform_wrapper.gf_browser_chrome .ginput_complex .ginput_right select, .gform_wrapper.gf_browser_chrome .ginput_complex select {
	height: 3.4em;
    margin-top: 0;
    line-height: 3; 
}

.gfield span label { 
    /* width: 100%; */
    display: inline-block;
    position: relative;
    left: 0;
    font-size: 12px;
}

.gfield span {
    position: relative;
    display: inline-block;
}

#disqus_thread {
	width: 100%;
}
.vc_empty_space {
	height: 2em;
}
.fl {
	float: left;
}
#closelightbox{position:fixed;width:100vw;height:100vh;z-index:9999;}

.woocommerce {
	width: 100%;
}
.menu-title, .menu-ingredients, .menu-price {
    padding-top: 0.5em;
}
.menu-image {
	width:4em;
}
.menu-title {
	vertical-align: middle;
}
.menu-image-link {
    position: relative;
    display: inline-block;
    width: 3em; 
    height: 3em;
    margin-right: 10px;
}
.menu-popup {
    width: 3em;
    height: 3em;
    overflow: hidden;
    border-radius: 100%;
    line-height: 3em;
    display: inline-block;
    transition: all 250ms;
    position: absolute;
    top: 0;
}
.menu-image-link:hover .menu-popup {
    width: 10em;
    height: 10em;
    z-index: 99;
    top: -3em;
}

.wpb_accordion_section h3 {
    display: inline-block;
    color: #333;
    font-size: 100%;
}
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header {
    padding: 0.5em 1em;
}

/*
*
*	TRIBE EVENTS	
*
*/
.tribe-events-cost.col-3.align-right {
    font-size: 3em;
}
.tribe-events-event-meta .tribe-events-meta-group {
    min-width: 33.3333%;
    max-width: 340px;
    width: 100%;
}
<?php
/*	
WP USER MANAGER	
*/
if(class_exists('WP_User_Manager')):
	?>
	.wpum-profile-card .wpum-profile-img {
	    position: relative;
	    left: 0;
	    border-radius: 0;
	    margin-left: 0;
	    top: 0;
	}
	.wpum-profile-card .wpum-profile-img img {
	    border-radius: 0;
	    box-shadow: none;
	    padding: 0;
	    background-color: none;
	    border: none;
	}
	.wpum-profile-card {
		text-align: left;
		box-shadow: none;
		border: none;
		padding: 0;
	}
	
	
	<?php
endif;
	
	
do_action ( 'custom_css' );
echo $hiilite_options['custom_css'];
echo $hiilite_options['portfolio_custom_css'];
?>
</style>