<style>
<?php 
global $is_IE;
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

function get_justify_content($align){
	if(is_array($align)){
		foreach($align as $key => $value){
			if($value != ' ' && $value != ''){
				if($key == 'text-align') { 
					echo 'justify-content:';
					switch ($value) {
						case 'left':
							echo 'flex-start;';
						break;
						case 'right':
							echo 'flex-end;';
						break;
						case 'center':
							echo 'center;';
						break;
						case 'justify':
							echo 'space-around;';
						break;
					}
					echo ';';
				}
			}
		}
	}
}
function get_spacing($spacing){
	$values = '';

	$values = $spacing['top'].' '.$spacing['right'].' '.$spacing['bottom'].' '.$spacing['left'];
	
	return $values;
}
$link_color = get_theme_mod('link_color');
?>
html {
	<?php 
	get_font_css($hiilite_options['default_font']); ?>
	-webkit-font-smoothing: antialiased;
    text-shadow: 1px 1px 1px rgba(0,0,0,0.004);
}

body {
	margin: 0;
}

a,  a .fa {
	color:<?=$link_color['link'];?>;<?php echo preg_replace('/[{}]/','',$hiilite_options['typography_link_custom_css']); ?>
}
a:hover, a:hover .fa,
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover  {
	color:<?=$link_color['hover'];?>;
}

a, .button, .menu li {
	transition:all 240ms;
}

h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
	color: #303030;
}
.blog-article .post_author a {
    color: #bebebe;
}
ol li ol li {
    list-style-type: lower-alpha;
}
figure {
	display: block;
	margin: auto;
	padding: 0;
	position: relative;
}
figure.align-center img{
	margin: auto;
	
}
.single-image img {
	display:block;
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
.wp-caption.alignright {
    display: inline-block;
    float: right;
}
p .alignright {
	margin-left:1em;
}
.wp-caption-text {
	color: #637282;
	font-size: 14px;
    font-style: italic;
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
	get_font_css($hiilite_options['heading_font']); ?>
	line-height:1.5;
	margin: 0;
}
<?php 
//////////////////////
//
//	note: Generate Heading tags
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
.grid-left {
    padding-left: calc((100vw - 1100px)/2);
    min-width: initial;
}
.grid-right {
    padding-right: calc((100vw - 1100px)/2);
    min-width: initial;
}
@media (max-width: 1100px) {
    .grid-right {
        padding-right: 0;
        min-width: initial;
    }
    .grid-left {
        padding-left: 0;
        min-width: initial;
    }
}
.row {
	box-sizing: border-box;
	background-position: center top;
}
.vc_section {
	width: 100%;
	padding: 0;
}
.in_grid {
	max-width: <?=$hiilite_options['grid_width'];?>;
}
<?php
include_once(HIILITE_DIR.'/css/vc_elements/row-css.php');	
include_once(HIILITE_DIR.'/css/elements/buttons.php'); 
include_once(HIILITE_DIR.'/css/header/header-css.php'); 
include_once(HIILITE_DIR.'/css/header/menu-css.php');

/*
//	note: FOOTER 
*/
$footer_top_colors = get_theme_mod('footer_top_colors');
$footer_bottom_colors = get_theme_mod('footer_bottom_colors');	
?>
#main_footer {
	position: relative;
	background: <?=get_theme_mod('footer_background_color', '#c8c8c8');?>;
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
#main_footer .menu .menu-item a {
	padding:0;
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
#footer_page .menu {
	display: block;
}


#footer_top .flex-item{
	margin: 0 auto auto 0;
	
}
#footer_bottom{
	background: <?=get_theme_mod('footer_bottom_background_color'); ?>;
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

<?php
/*
//	note: Page Title 
*/	
?>
.page-title {
	overflow: hidden;
	<?php 
	if ($hiilite_options['header_above_content'] == false){ echo 'z-index:100;top:0;'; } 
	echo 'position: relative;';
	echo ($hiilite_options['title_background_image'] != '')?'background-image:url('.$hiilite_options['title_background_image'].');':'';
	echo 'background-repeat:'.$hiilite_options['title_background_repeat'].';';
	echo 'background-size:'.$hiilite_options['title_background_size'].';';
	echo 'background-attachment:'.$hiilite_options['title_background_attach'].';';
	echo 'background-position:'.str_replace('-', ' ', $hiilite_options['title_background_position']).';';
	echo 'background-color:'.$hiilite_options['title_background_color'].';';

	?>
	min-height: <?=$hiilite_options['title_height'];?>;
	padding: <?=get_spacing(get_theme_mod( 'title_padding' ));?>;
	display: block;
	width:100%;
}
.page-title h1 {
	margin-bottom: 0;
	<?php 
	get_font_css($hiilite_options['title_font']);
	?>
}
.page-title .back_to_blog, .page-title small, .page-title small a {
	color: <?=$hiilite_options['title_font']['color'];?>;
}

img {
	max-width: 100%;
	height: auto;
}
img.full-width, .row, .wpb_content_element {
	min-width: 100%;
	scroll-snap-type: proximity;

	/* older spec implementation */
	scroll-snap-destination: 0% 100%;
	scroll-snap-points-x: repeat(100%);
}
.full-width,.threequarter-width,.half-width,.third-width,.twothird-width,.quarter-width,
.col-12,.col-9,.col-7,.col-8,.col-6,.col-4,.col-3,.col-2,.col-1,
.vc_col-lg-1, .vc_col-lg-10, .vc_col-lg-11, .vc_col-lg-12, .vc_col-lg-2, .vc_col-lg-3, .vc_col-lg-4, .vc_col-lg-5, .vc_col-lg-6, .vc_col-lg-7, .vc_col-lg-8, .vc_col-lg-9, .vc_col-md-1, .vc_col-md-10, .vc_col-md-11, .vc_col-md-12, .vc_col-md-2, .vc_col-md-3, .vc_col-md-4, .vc_col-md-5, .vc_col-md-6, .vc_col-md-7, .vc_col-md-8, .vc_col-md-9, .vc_col-sm-1, .vc_col-sm-10, .vc_col-sm-11, .vc_col-sm-12, .vc_col-sm-2, .vc_col-sm-3, .vc_col-sm-4, .vc_col-sm-5, .vc_col-sm-6, .vc_col-sm-7, .vc_col-sm-8, .vc_col-sm-9, .vc_col-xs-1, .vc_col-xs-10, .vc_col-xs-11, .vc_col-xs-12, .vc_col-xs-2, .vc_col-xs-3, .vc_col-xs-4, .vc_col-xs-5, .vc_col-xs-6, .vc_col-xs-7, .vc_col-xs-8, .vc_col-xs-9 {
    box-sizing: border-box;
    min-width: 100px;
}

<?php 
$alt_cols =	array(false,false,false,'quarter-width','third-width',false,'half-width',false,'twothird-width','threequarter-width',false,false,'full-width');
$col_4 = ($hiilite_options['grid_width'] / 3) + 1;
for($i = 12; $i>0;$i--):
	echo '.vc_col-xs-'.$i.', .vc_col-md-'.$i.', .vc_col-sm-'.$i.', .vc_col-lg-'.$i.', .col-'.$i;
	echo ($alt_cols[$i])?', .'.$alt_cols[$i]:'';
	echo '{';
		$perc_ratio = (($i/12)*100) - 0.1;
		echo ($i > 12)?'max-width:'.$perc_ratio.'em;':'max-width:100%;';
		echo 'width:'.$perc_ratio.'%;';
		$min_width = ($i>4)?'320':'160';
		echo 'flex:1 1 '.$perc_ratio.'%;';
		if($is_IE) echo 'flex-basis: '.($perc_ratio - 5).'%;';
	echo '}';
endfor;
?>

@media (max-width:550px){
<?php
for($i = 12; $i>0;$i--):
	echo '.col-'.$i;
	echo ($alt_cols[$i])?', .'.$alt_cols[$i]:'';
	echo '{';
		$perc_ratio = (($i/12)*100);
		echo 'width:'.$perc_ratio.'%;';
		$min_width = ($i>2)?'320':'160';
		echo 'flex:1 1 '.$min_width.'px;';
	echo '}';
endfor;
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
.text-block .text-block {
 	padding:0;
}

.author_details img {
	margin-right: 1em; 
}
.author_bio_section {
	background: rgba(240,240,240,0.8);
}
#home_blog_loop {
	position: relative;
}
.blog-article {
	padding-bottom: 2em;
	margin-top: 0;
	display: flex;
	flex-wrap: wrap;
	break-inside:avoid;
}
.blog-article header {
	width: 100%;
}
.blog-article .content-box {
	padding-top: 2px;
	padding:2px 2em;
}
.blog-article figure {
	padding: 0 2em;
	text-align: center;
}

/*
//	note: Pagination 
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
.team-member figure img {
 
}
<?php endif; ?>





<?=$hiilite_options['typography_icon_custom_css'];?>

.fa {
	display: inline-block;
	width: 1.6em;
	text-align: center;
	color: white;
	line-height: 1.6em;
	<?php get_font_css(get_theme_mod('icon_settings')); ?>
	<?php get_font_css(get_theme_mod('icon_settings_bg')); ?>
	border:<?=get_theme_mod('icon_settings_border', '0'); ?> solid;
	border-radius:<?=get_theme_mod('icon_settings_border_r', '0'); ?>;
	width:1.6em;
}



<?=$hiilite_options['typography_icon_custom_css'];?>

.custom_format_1 { <?=$hiilite_options['custom_format_1'];?> }
.custom_format_2 { <?=$hiilite_options['custom_format_2'];?> }
.custom_format_3 { <?=$hiilite_options['custom_format_3'];?> }


/*
//	note: Widgets
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
	padding: 0.3em;
	font-size: 0.7em;
}

/*
//	note: Complimentary styles	
*/
.align-right, .alignright {
	text-align: right;
	align-self: flex-end;
	margin: auto 0 auto auto;
}
img.alignright {
	float:right;
}
.align-left, .alignleft {
	text-align: left;
	align-self: flex-start;
	margin: auto auto auto 0;
}
img.alignleft {
	float:left;
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

/*
 //	note: amp-slider	
 */
 amp-carousel{
	overflow: hidden;
	display: block;
    position: relative;
    max-width: 100vw;
}
amp-carousel[type=slides] .slide {
	position: absolute;
    top: 0;
    left: 0;
    bottom: 0; 
    right: 0;
    display: flex;
    min-width: 100%;
    max-width: 100%;
    height: 100%;
    margin: auto;
}
.amp-carousel-button {
    position: absolute;
    box-sizing: border-box;
    top: 50%;
    height: 34px;
    width: 34px;
    border-radius: 100%;
    opacity: 1;
    pointer-events: all;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    visibility: visible;
    z-index: 10;
    
    display: inline-block;
    font: normal normal normal 14px/34px FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
}
amp-carousel .amp-carousel-button.amp-disabled {
    -webkit-animation: none;
    animation: none;
    opacity: 0;
    visibility: hidden;
}
.amp-carousel-button-next {
    right: 16px;
}
.amp-carousel-button-next:before {
    content: "\f054";
}
.amp-carousel-button-prev {
    left: 16px;
}
.amp-carousel-button-prev:before {
    content: "\f053";
}
amp-carousel ul.bullets_navigation {
    position: absolute;
    bottom: 0;
    width: 100%;
    left: 0;
    padding: 0;
    margin: 0;
    text-align: center;
}

amp-carousel li.bullet_item {
    display: inline-block;
    width: 10px;
    height: 10px;
    border: 1px solid white;
    border-radius: 10px;
    margin: 5px;
    background-color: rgba(0,0,0,0.4);
}
amp-carousel li.bullet_item.on { 
	background-color: white;
}

amp-carousel.slider {
	min-width: 100%;
	max-height: 100vh;
	display: block;
	position: relative;
	
}
amp-carousel.slider_full_height {
	min-height: 100vh;
}

amp-carousel.slider .slide-text-overlay {
	flex: 1 1 auto;
    margin: auto;
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
amp-carousel.slider img {
	max-height: 100%;
	max-width: 100%;
}


amp-carousel.carousel {
	width: 100%;
	height: 300px;
	overflow: hidden;
}

amp-carousel.slider .hide {
	display:none;	
}
amp-carousel.slider .show {
	display:block;	
}

amp-carousel.rounded .vc_tta-panel-heading {
	border-radius: 6px;
	padding: 0.3em 0.5em;	
}
amp-carousel.round .vc_tta-panel-heading {
	border-radius: 2em;
	padding: 0.3em 0.5em;
}
amp-carousel.square .vc_tta-panel-heading {
	border-radius: 0;
	padding: 0.3em 0.5em;
}

amp-carousel.left .vc_tta-panel-heading {
	text-align:left;
}
amp-carousel.center .vc_tta-panel-heading {
	text-align:center;
}
amp-carousel.right .vc_tta-panel-heading {
	text-align:right;
}


.relatedposts .relatedarticle {
	max-width: 200px;
	overflow: hidden;
	display: inline-block;
	padding: 10px;
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

/* 
 //	note: Gravity Forms 
 */
.gform_fields {
	padding: 0;
	list-style: none; 
}
input,textarea,select {
	padding:1em;
	border: 1px solid rgba(203, 203, 203, 1); 
	font-size: 1rem;
}
select {
    -webkit-appearance: none;
    border-radius: 0;
}
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
.accordion .wpb_accordion_wrapper .wpb_accordion_header {
    padding: 0.5em 1em;
}
details.wpb_accordion_section.group {
    margin: 1em;
}

/*
 //	note: Tribe_Events	
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
 //	note: WP_User_Manager	
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

if(class_exists('BuddyPress')): 
	include_once(HIILITE_DIR.'/css/service_extensions/buddypress-css.php');	
endif;

if ( is_customize_preview() ) :
?>
.customizer_quick_links {
	position: absolute;
	top: 0;
	right: 0;
}

.customizer-edit {
	border: none;
    background: #555d66;
    color: white;
    position: relative;
    right: 0;
    overflow: hidden;
    max-width: 1.5em;
    white-space: nowrap;
    padding: 2px 4px;
    box-sizing: border-box;
    line-height: 1;
    cursor: context-menu;
    height: 1.5em;
}
.customizer_quick_links .customizer-edit:first-child {
	border-radius: 10px 0px 0px 10px;
}
button.customizer-edit:hover {
    max-width: 100%;
    z-index: 9999;
}
.customizer-edit:before {
	content: "\f040";
	padding-right:0.5em;
	display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.customizer-edit.font-edit:before {
	content: "\f031";
}
<?php
endif;

do_action ( 'custom_css' );
echo $hiilite_options['custom_css'];
echo $hiilite_options['portfolio_custom_css'];
?>
</style>