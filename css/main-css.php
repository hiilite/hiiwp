<style <?php if($hiilite_options['amp']) echo 'amp-custom'; ?>>
	<?php include_once('font-awesome/css/font-awesome.min.css'); ?>
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
	box-sizing: border-box;
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
	margin-bottom: 3em;
	display: flex;
	flex-wrap: wrap;
}
.blog-article .content-box {
	padding-top: 2px;
	padding:2px 2em;
}
.blog-article figure {
	padding: 0 2em;
}
<?php if($hiilite_options['portfolio_on']): ?>
.portfolio-piece {
	padding: 0.5em;
}
.portfolio-piece .content-box {
	box-shadow: inset 0 0 1px rgba(0,0,0,0.1);
}
.portfolio-piece h5 {
	margin: 0;
}
.portfolio-piece figure {
	overflow:hidden;	
	max-height: calc(100vh);
	min-height: calc(50vh);
	position: relative;
}
.portfolio-piece figure <?=$_amp?>img {
    min-height: 100%;
    min-width: 100%;
    max-width: none;
    position: absolute;
    width: 150%;
    left: -25%;
    
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

@media (max-width:<?=$hiilite_options['grid_width'];?>){
	.container_inner {
		padding: 0em;
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

#main_footer a {
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
.menu li:hover {
	background: <?=$hiilite_options['color_one'];?>;
}
.menu li:hover a {
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
.menu li:hover > ul.sub-menu {
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

	.main-menu li {
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
.page-title h1 {
	margin-bottom: 0;
}

<?=$_amp?>img {
	max-width: 100%;
	height: auto;
}
<?=$_amp?>img.full-width, .full-width <?=$_amp?>iframe, .row {
	min-width: 100%;
}
.full-width,.threequarter-width,.half-width,.third-width,.twothird-width,.quarter-width {
    box-sizing: border-box;
}
.full-width, .col-12 {
	width: 100%;
	
}
.col-1 {
	width: 16.67%;
}
.threequarter-width, .col-9 {
	min-width: 320px;
	max-width: 76em;
	width: 75%;
	margin: auto;
	flex: 1 320px;
}
.half-width, .col-6 {
	min-width: 50%;
	max-width: 50em;
	width: 50%;
	margin: auto;
	flex: 1 50%;
}

.third-width, .col-4 {
	min-width: 10em;
	max-width: 33em;
	width: 33.33%;
	margin: auto;
	flex: 1 15em;
}

.twothird-width , .col-8{
	min-width: 320px;
	max-width: 66em;
	width: 66.66%;
	margin: auto;
	flex: 1 320px;
}
.quarter-width, .col-3 {
	min-width: 10em;
	max-width: 25em;
	width: 25%;
	margin: auto;
	flex: 1 10em;
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
.white { color:white; }
.bg_color_one  { background-color: <?=$hiilite_options['color_one'];?>; }
.bg_color_two 	{ background-color: <?=$hiilite_options['color_two'];?>; }
.bg_color_three{ background-color: <?=$hiilite_options['color_three'];?>; }
.bg_color_four { background-color: <?=$hiilite_options['color_four'];?>; }
.bg_white { background-color:white; }

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
	<?php echo (isset($slider_slide_styles))?$slider_slide_styles:'';?>
}
amp-carousel.slider .slide-text-overlay amp-fit-text {
	height: 100%;
}

/*for when image bleeds beyond edges*/
<?=$_amp?>carousel <?=$_amp?>img {
	max-height: 100%;
	max-width: 150%;
	min-width:100%;
	min-height:100%;
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