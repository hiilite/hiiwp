<style <?php if($hiilite_options['amp']) echo 'amp-custom'; ?>>
<?php 
global $is_IE;
/*$post_id = get_the_id();

if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
	$hiilite_options['amp'] = false;
} else {
	$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
}

*/
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
include_once('font-awesome/css/font-awesome.min.css'); 
	
function get_font_css($font){
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
			else { echo $key.':'.$value.';'; }
			
			
			
			
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
	background: <?=$hiilite_options['default_background_color'];?>;
}
a {
	color:<?=$hiilite_options['typography_link_color'];?>;<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_link_custom_css']); ?>
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
#header_top {
	background: <?=$hiilite_options['header_top_background_color']?>;
	<?php 
	get_font_css($hiilite_options['header_top_font']);
	echo ($hiilite_options['header_top_border_color'] != '')?'border-top-color:'.$hiilite_options['header_top_border_color'].';border-top-style: solid;':'';
	echo ($hiilite_options['header_top_border_width'] != '')?'border-top-width:'.$hiilite_options['header_top_border_width'].';':''; ?>
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

#main_footer {
	<?php 
	get_font_css($hiilite_options['typography_footer_text_font']);
	
?>
} 
 
#main_footer .widgettitle {
<?php 
	get_font_css($hiilite_options['typography_footer_headings_font']);
?>
}

#main_footer a {
<?php 
	get_font_css($hiilite_options['typography_footer_links_font']);
?>
}

#main_footer ul {
    list-style: none;
    padding: 0;
}
#footer_top, #footer_page {
	background: <?=$hiilite_options['footer_background_color'];?>;
	<?php 
	echo 'background-image:url('.$hiilite_options['footer_background_image'].');';
	echo 'background-repeat:'.$hiilite_options['footer_background_repeat'].';';
	echo 'background-size:'.$hiilite_options['footer_background_size'].';';
	echo 'background-attachment:'.$hiilite_options['footer_background_attach'].';';
	echo 'background-position:'.str_replace('-', ' ', $hiilite_options['footer_background_position']).';';
	echo 'background-color:'.$hiilite_options['footer_background_color'].';';
	?>
	padding: 1em;
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
	color: #fff;
	padding:1em;
}
.flex-item {
	flex: 1 1 auto;
	<?php if($is_IE) echo 'flex-basis: 0%';?>
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
	text-decoration: none;
	padding: 1em; /*set*/
	display:block;
	<?php 
	get_font_css($hiilite_options['main_menu_font']);
	?>
	<?=$hiilite_options['main_menu_links_css'];?>
}

.menu li:hover {
	border-radius: 4px;
	background: <?=$hiilite_options['color_one'];?>;
}
.menu .current-menu-item a {
	color:<?=$hiilite_options['color_one'];?>;
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
.menu li>ul.sub-menu>li:hover>ul.sub-menu {
    position: absolute;
    left: 100%;
    top: 0;
}
a, .button, .menu li {
	transition:all 0.4s;
}
@media (max-width:<?=$hiilite_options['mobile_menu_switch'];?>){
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
		display: block;
	}

	nav#main-nav .main-menu {
		position: relative;
		z-index: 9999;
		background: white;
		left: 0;
		top: 0;
		max-height: 0;
		transition: all 1s;
		width: 100vw;
		display: flex;
		overflow: auto;
	}

	.main-menu li {
		width: 100%;
		text-align: center;
	}

	nav#main-nav:hover .main-menu {
		max-height: 100vh;
	}
	ul.sub-menu {
		position: relative;
		display: block;
	}
	ul.sub-menu:before {
	    position: absolute;
	    content: "M";
	    top: -3.5em;
	    right: 0em;
	    padding: 1em 1.5em;
	    font-family: FontAwesome;
	    content: '\f055';
	}
	ul.sub-menu:hover:before {
	    content: '\f056';
	}
	ul.sub-menu li {
	    display: none;
	}
	ul.sub-menu:hover>li {
	    display: block;
	}
	.menu li>ul.sub-menu>li:hover>ul.sub-menu {
		box-shadow: inset 0 0 1px black;
		position: relative;
		left: 0;
	}
	ul.sub-menu>li ul.sub-menu:hover>li {
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



/* BUTTONS */

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

.fa {
	<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_icon_custom_css']);?>
}

.custom_format_1 <?=$hiilite_options['custom_format_1'];?>
.custom_format_2 <?=$hiilite_options['custom_format_2'];?>
.custom_format_3 <?=$hiilite_options['custom_format_3'];?>

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
input,textarea {padding:0.5em 1em;border: 1px solid gray; font-size: 1rem;}

.gfield {
    margin-bottom: 2em;
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
<?php
do_action ( 'custom_css' );
echo $hiilite_options['custom_css'];
echo $hiilite_options['portfolio_custom_css'];
?>
</style>