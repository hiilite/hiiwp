<?php 
/**
 * HiiWP: Main-CSS
 *
 * Main CSS file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.1
 */
global $is_IE; ?><style>
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 General
	1.1 Normalize
	1.2 Accessibility
	1.3 Alignments
	1.4 Clearings
	1.5 Typography
	1.6 Formatting
	1.7 Lists
	1.8 Tables
	1.9 Widgets
	1.10 Media
	1.11 Layout
2.0 Logo
3.0 Header
	3.1 Header General
	3.2 Header Top
	3.3 Menu
4.0 Footer
5.0 Title
6.0 Elements
	6.1 Buttons
	6.2 Forms
	6.3 Social Icons
    6.4 Galleries
7.0 Fonts/Typography
	7.1 Headings
	7.2 Paragraphs & Links
	7.3 Icons
8.0 Sidebar
9.0 Testimonials
10.0 Blog
	10.1 Blog List
	10.2 Blog Single
	10.3 Pagination
	10.4 Comments
11.0 Portfolio
12.0 Teams
13.0 Extensions
	13.7 WooCommerce
14.0 Overwrites
--------------------------------------------------------------*/
/*--------------------------------------------------------------
1.0 General
--------------------------------------------------------------*/
/*--------------------------------------------------------------
1.1 Normalize
--------------------------------------------------------------*/
body * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
html {
	-webkit-font-smoothing: antialiased;
    text-shadow: 1px 1px 1px rgba(0,0,0,0.004);
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
}

body, html {
	margin: 0;
<?php echo get_font_css(Hii::$options['default_font']); ?>
}

article,
aside,
footer,
header,
nav,
section,
details,
menu,
figcaption,
figure,
main {
	display: block;
}

figure {
	margin: auto;
	padding: 0;
	position: relative;
    line-height: 0;
}

pre {
	font-family: monospace, monospace;
	font-size: 1em;
}

a {
	background-color: transparent;
	-webkit-text-decoration-skip: objects;
}

a:active,
a:hover {
	outline-width: 0;
}

abbr[title] {
	border-bottom: 1px #767676 dotted;
	text-decoration: none;
}

b,
strong {
	font-weight: 700;
}

code,
kbd,
samp {
	font-family: monospace, monospace;
	font-size: 1em;
}

dfn {
	font-style: italic;
}

mark {
	background-color: #eee;
	color: #222;
}

small {
	font-size: 80%;
}

sub,
sup {
	font-size: 75%;
	line-height: 0;
	position: relative;
	vertical-align: baseline;
}

sub {
	bottom: -0.25em;
}

sup {
	top: -0.5em;
}

audio,
video,
canvas {
	display: inline-block;
}

audio:not([controls]) {
	display: none;
	height: 0;
}

img {
	border-style: none;
}

svg:not(:root) {
	overflow: hidden;
}

summary {
	display: list-item;
}

template,
[hidden] {
	display: none;
}

[onclick] {
	cursor:pointer;
}
/*--------------------------------------------------------------
1.2 Accessibility
--------------------------------------------------------------*/

/* Text meant only for screen readers. */

.screen-reader-text {
	clip: rect(1px, 1px, 1px, 1px);
	height: 1px;
	overflow: hidden;
	position: absolute !important;
	width: 1px;
	word-wrap: normal !important; /* Many screen reader and browser combinations announce broken words as they would appear visually. */
}

.screen-reader-text:focus {
	background-color: #f1f1f1;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
	box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
	clip: auto !important;
	color: #21759b;
	display: block;
	font-size: 16px;
	font-size: 0.875rem;
	font-weight: 700;
	height: auto;
	left: 5px;
	line-height: normal;
	padding: 15px 23px 14px;
	text-decoration: none;
	top: 5px;
	width: auto;
	z-index: 100000; /* Above WP toolbar. */
}

/*--------------------------------------------------------------
1.3 Alignments
--------------------------------------------------------------*/

.inline_block {
	display: inline-block;
}

.align-right, 
.alignright {
	text-align: right;
	align-self: flex-end;
	margin: auto 0 auto auto;
}
img.alignright {
	float:right;
}
p img.alignright,
figure.alignright {
	margin-left: 1em;
}
.align-left, 
.alignleft {
	text-align: left;
	align-self: flex-start;
	margin: auto auto auto 0;
}
img.alignleft {
	float:left;
}
p img.alignleft,
figure.alignright {
	margin-right: 1em;
}

.align-center, 
.aligncenter {
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
.row-o-content-bottom .container_inner {
    margin-top: auto;
    margin-bottom: 0;
}
.text-align.center {
	text-align: center;
}

.fl {
	float: left;
}


/*--------------------------------------------------------------
1.4 Clearings
--------------------------------------------------------------*/

.clear:before,
.clear:after,
.entry-content:before,
.entry-content:after,
.entry-footer:before,
.entry-footer:after,
.comment-content:before,
.comment-content:after,
.site-header:before,
.site-header:after,
.site-content:before,
.site-content:after,
.site-footer:before,
.site-footer:after,
.nav-links:before,
.nav-links:after,
.pagination:before,
.pagination:after,
.comment-author:before,
.comment-author:after,
.widget-area:before,
.widget-area:after,
.widget:before,
.widget:after,
.comment-meta:before,
.comment-meta:after {
	content: "";
	display: table;
	table-layout: fixed;
}

.clear:after,
.entry-content:after,
.entry-footer:after,
.comment-content:after,
.site-header:after,
.site-content:after,
.site-footer:after,
.nav-links:after,
.pagination:after,
.comment-author:after,
.widget-area:after,
.widget:after,
.comment-meta:after {
	clear: both;
}

/*--------------------------------------------------------------
1.5 Typography
--------------------------------------------------------------*/

h1, 
h2, 
h3, 
h4, 
h5, 
h6 {
	clear: both;
}

h1:first-child,
h2:first-child,
h3:first-child,
h4:first-child,
h5:first-child,
h6:first-child {
	padding-top: 0;
}

p {
	padding: 0;
}

dfn,
cite,
em,
i {
	font-style: italic;
}

blockquote {
	padding: 10px 20px;
	border-left: 5px solid #d7e0e5;
	margin: 0;
	overflow: hidden;
}
blockquote p {
	color: #666;
	font-size: 18px;
	font-size: 1.125rem;
	font-style: italic;
	line-height: 1.7;
	
}

blockquote cite {
	display: block;
	font-style: normal;
	font-weight: 600;
	margin-top: 0.5em;
}

address {
	margin: 0 0 1.5em;
	display: inline-block;
}

pre {
	background: #eee;
	font-family: "Courier 10 Pitch", Courier, monospace;
	font-size: 16px;
	font-size: 0.9375rem;
	line-height: 1.6;
	margin-bottom: 1.6em;
	max-width: 100%;
	overflow: auto;
	padding: 1.6em;
}

code,
kbd,
tt,
var {
	font-family: Monaco, Consolas, "Andale Mono", "DejaVu Sans Mono", monospace;
	font-size: 16px;
	font-size: 0.9375rem;
}

abbr,
acronym {
	border-bottom: 1px dotted #666;
	cursor: help;
}

mark,
ins {
	background: #eee;
	text-decoration: none;
}

big {
	font-size: 125%;
}

blockquote {
	quotes: "" "";
}

q {
	quotes: "“" "”" "‘" "’";
}

blockquote:before,
blockquote:after {
	content: "";
}

:focus {
	outline: none;
}
<?php
get_template_part('css/typography/language-fixes', 'css');
?>
/*--------------------------------------------------------------
1.6 Formatting
--------------------------------------------------------------*/

hr {
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	overflow: visible;
    clear: both;
    width: 100%;
    background-color: #bbb;
	border: 0;
	height: 1px;
	margin-bottom: 1.5em;
}
.transform-uppercase { text-transform: uppercase; }
.transform-lowercase { text-transform: lowercase; }
.transform-capitalize { text-transform: capitalize; }
.transform-none { text-transform: none; }


/*--------------------------------------------------------------
1.7 Lists
--------------------------------------------------------------*/

ul,
ol {
	margin: 0 0 1.5em;
	padding: 0 0 0 1em;
}

ul {
	list-style: disc;
}

ol {
	list-style: decimal;
}

li > ul,
li > ol {
	margin-bottom: 0;
	margin-left: 1.5em;
}

dt {
	font-weight: 400;
}

dd {
	<?php	
	echo get_font_css(Hii::$options['text_font']);
	if(Hii::$options['text_margin'] != '') echo 'margin-bottom:'.Hii::$options['text_margin'].';';
?>
	margin-left:0;
}

ol li ol li {
    list-style-type: lower-alpha;
}

/*--------------------------------------------------------------
1.8 Tables
--------------------------------------------------------------*/

table {
	border-collapse: collapse;
	margin: 0 0 1.5em;
	width: 100%;
	
}
table, tr, th, td {
	box-sizing:border-box;	
}
thead th {
	border-bottom: 2px solid #bbb;
	padding-bottom: 0.5em;
}

th {
	padding: 0.4em;
	text-align: left;
}

tr {
	border-bottom: 1px solid #eee;
}

td {
	padding: 0.5rem;
}
th:first-child,
td:first-child {
	padding-left: 0;
}

th:last-child,
td:last-child {
	padding-right: 0;
}

/*--------------------------------------------------------------
1.10 Media
--------------------------------------------------------------*/

img,
video {
	height: auto; /* Make sure images are scaled correctly. */
	max-width: 100%; /* Adhere to container width. */
}

.page-content .wp-smiley,
.entry-content .wp-smiley,
.comment-content .wp-smiley {
	border: none;
	margin-bottom: 0;
	margin-top: 0;
	padding: 0;
}

/* Make sure embeds and iframes fit their containers. */

embed,
iframe,
object {
	margin-bottom: 1.5em;
	max-width: 100%;
}

.blog-article embed, .blog-article iframe, .blog-article object {
    height:auto;
    margin-bottom: 0 !important;
}

.wp-caption,
.gallery-caption {
	color: #666;
	font-size: 13px;
	font-size: 0.8125rem;
	font-style: italic;
	margin-bottom: 1.5em;
	max-width: 100%;
}

.wp-caption img[class*="wp-image-"] {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

.wp-caption .wp-caption-text {
	margin: 0.8075em 0;
}

/* Media Elements */

.mejs-container {
	margin-bottom: 1.5em;
}

/* Audio Player */

.mejs-controls a.mejs-horizontal-volume-slider,
.mejs-controls a.mejs-horizontal-volume-slider:focus,
.mejs-controls a.mejs-horizontal-volume-slider:hover {
	background: transparent;
	border: 0;
}

/* Playlist Color Overrides: Light */

.site-content .wp-playlist-light {
	border-color: #eee;
	color: #222;
}

.site-content .wp-playlist-light .wp-playlist-current-item .wp-playlist-item-album {
	color: #333;
}

.site-content .wp-playlist-light .wp-playlist-current-item .wp-playlist-item-artist {
	color: #767676;
}

.site-content .wp-playlist-light .wp-playlist-item {
	border-bottom: 1px dotted #eee;
	-webkit-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;
	transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;
}

.site-content .wp-playlist-light .wp-playlist-item:hover,
.site-content .wp-playlist-light .wp-playlist-item:focus {
	border-bottom-color: rgba(0, 0, 0, 0);
	background-color: #767676;
	color: #fff;
}

.site-content .wp-playlist-light a.wp-playlist-caption:hover,
.site-content .wp-playlist-light .wp-playlist-item:hover a,
.site-content .wp-playlist-light .wp-playlist-item:focus a {
	color: #fff;
}

/* Playlist Color Overrides: Dark */

.site-content .wp-playlist-dark {
	background: #222;
	border-color: #333;
}

.site-content .wp-playlist-dark .mejs-container .mejs-controls {
	background-color: #333;
}

.site-content .wp-playlist-dark .wp-playlist-caption {
	color: #fff;
}

.site-content .wp-playlist-dark .wp-playlist-current-item .wp-playlist-item-album {
	color: #eee;
}

.site-content .wp-playlist-dark .wp-playlist-current-item .wp-playlist-item-artist {
	color: #aaa;
}

.site-content .wp-playlist-dark .wp-playlist-playing {
	background-color: #333;
}

.site-content .wp-playlist-dark .wp-playlist-item {
	border-bottom: 1px dotted #555;
	-webkit-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;
	transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;
}

.site-content .wp-playlist-dark .wp-playlist-item:hover,
.site-content .wp-playlist-dark .wp-playlist-item:focus {
	border-bottom-color: rgba(0, 0, 0, 0);
	background-color: #aaa;
	color: #222;
}

.site-content .wp-playlist-dark a.wp-playlist-caption:hover,
.site-content .wp-playlist-dark .wp-playlist-item:hover a,
.site-content .wp-playlist-dark .wp-playlist-item:focus a {
	color: #222;
}

/* Playlist Style Overrides */

.site-content .wp-playlist {
	padding: 0.625em 0.625em 0.3125em;
}

.site-content .wp-playlist-current-item .wp-playlist-item-title {
	font-weight: 700;
}

.site-content .wp-playlist-current-item .wp-playlist-item-album {
	font-style: normal;
}

.site-content .wp-playlist-current-item .wp-playlist-item-artist {
	font-size: 10px;
	font-size: 0.625rem;
	font-weight: 800;
	letter-spacing: 0.1818em;
	text-transform: uppercase;
}

.site-content .wp-playlist-item {
	padding: 0 0.3125em;
	cursor: pointer;
}

.site-content .wp-playlist-item:last-of-type {
	border-bottom: none;
}

.site-content .wp-playlist-item a {
	padding: 0.3125em 0;
	border-bottom: none;
}

.site-content .wp-playlist-item a,
.site-content .wp-playlist-item a:focus,
.site-content .wp-playlist-item a:hover {
	-webkit-box-shadow: none;
	box-shadow: none;
	background: transparent;
}

.site-content .wp-playlist-item-length {
	top: 5px;
}

/* SVG Icons base styles */

.icon {
	display: inline-block;
	fill: currentColor;
	height: 1em;
	position: relative; /* Align more nicely with capital letters */
	top: -0.0625em;
	vertical-align: middle;
	width: 1em;
}
/* Fixes linked images */
.entry-content a img,
.widget a img {
	-webkit-box-shadow: 0 0 0 8px #fff;
	box-shadow: 0 0 0 8px #fff;
}
.entry-content img.alignleft {
	padding-right:1em;
	padding-bottom: 1em;
}
.entry-content img.alignright {
	padding-left:1em;
	padding-bottom: 1em;
}
.post-navigation a:focus .icon,
.post-navigation a:hover .icon {
	color: #222;
}
/*--------------------------------------------------------------
1.11 Layout
--------------------------------------------------------------*/
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
	padding: 1rem;
	box-sizing: border-box;
	display: block;
    width: 100%;
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

for($i = 12; $i>0;$i--):
	echo '.vc_col-sm-'.$i.', .col-'.$i;
	echo ($alt_cols[$i])?', .'.$alt_cols[$i]:'';
	echo '{';
		$perc_ratio = floor((($i/12)*100));
		$min_width = ($i>4)?'320':'160';
		echo ($i < 12)?'min-width:'.$min_width.'px;':'max-width:100%;';
		echo 'width:'.$perc_ratio.'%;'.
			 'flex:1 1 '.$perc_ratio.'%;';
		if($is_IE) echo 'flex-basis: '.($perc_ratio - 5).'%;';
	echo '}';
endfor; ?>

/* 
	MOBILE
*/
@media (max-width:768px){ <?php 
	for($i = 12; $i>0;$i--):
		$perc_ratio = floor((($i/12)*100));
		echo '.vc_col-xs-'.$i.'{'.
			 'width:'.$perc_ratio.'%;'.
			 'flex:1 1 '.$perc_ratio.'%;'.
			 '}';
	endfor; ?>
}

/* 
	TABLET
*/
@media (min-width:768px){ <?php 
	for($i = 12; $i>0;$i--):
		$perc_ratio = floor((($i/12)*100));
		echo '.vc_col-md-'.$i.'{'.
			 'width:'.$perc_ratio.'%;'.
			 'flex:1 1 '.$perc_ratio.'%;'.
			 '}';
	endfor; ?>
}

/* 
	DESKTOP
*/
@media (min-width:992px){ <?php 
	for($i = 12; $i>0;$i--):
		$perc_ratio = floor((($i/12)*100));
		echo '.vc_col-lg-'.$i.'{'.
			 'width:'.$perc_ratio.'%;'.
			 'flex:1 1 '.$perc_ratio.'%;'.
			 '}';
	endfor; ?>
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

/*--------------------------------------------------------------
6.2 Forms
--------------------------------------------------------------*/
<?php get_template_part('css/elements/forms'); ?>
/*--------------------------------------------------------------
6.3 Social Icons
--------------------------------------------------------------*/
.social-profiles a .fa, 
.social-profiles .fa {
	<?php echo get_font_css($hiilite_options['social_icon_settings']); ?>
	<?php echo get_background_css($hiilite_options['social_icon_settings_bg']); ?>
	border:<?php echo get_theme_mod('social_icon_settings_border', '0'); ?> solid;
	border-radius:<?php echo get_theme_mod('social_icon_settings_border_r', '0'); ?>;
	box-sizing: content-box;
}

<?php 
echo Hii::$options['typography_social_icon_custom_css'];?>
/*--------------------------------------------------------------
6.4 Galleries
--------------------------------------------------------------*/

.gallery-item {
	display: inline-block;
	text-align: left;
	vertical-align: top;
	margin: 0;
	padding: 0 10px 0 0;
	width: 50%;
}

.gallery-columns-1 .gallery-item {
	width: 100%;
}

.gallery-columns-2 .gallery-item {
	max-width: 50%;
}

.gallery-item a,
.gallery-item a:hover,
.gallery-item a:focus {
	-webkit-box-shadow: none;
	box-shadow: none;
	background: none;
	display: inline-block;
	max-width: 100%;
	width: 100%;
}

.gallery-item a img {
	display: block;
	-webkit-transition: -webkit-filter 0.2s ease-in;
	transition: -webkit-filter 0.2s ease-in;
	transition: filter 0.2s ease-in;
	transition: filter 0.2s ease-in, -webkit-filter 0.2s ease-in;
	-webkit-backface-visibility: hidden;
	backface-visibility: hidden;
	padding: 10px;
	width: 100%;
}

.gallery-item a:hover img,
.gallery-item a:focus img {
	-webkit-filter: opacity(60%);
	filter: opacity(60%);
}

.gallery-caption {
	display: block;
	text-align: left;
	padding: 0 10px 0 0;
	margin-bottom: 0;
}

/*--------------------------------------------------------------
6.5 Accordian
--------------------------------------------------------------*/
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
.wpb_gmaps_widget .wpb_wrapper {
	padding:0;
}

/*--------------------------------------------------------------
7.2 Paragraph & Links
--------------------------------------------------------------*/
<?php
	$link_color = Hii::$options['link_color']; ?>
a,  
a .fa {
	color:<?php echo sanitize_rgba($link_color['link']);?>;
	
	-webkit-transition: color 80ms ease-in, -webkit-box-shadow 130ms ease-in-out; 
	transition: color 80ms ease-in, -webkit-box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, box-shadow 130ms ease-in-out, -webkit-box-shadow 130ms ease-in-out;
}
<?php echo Hii::$options['typography_link_custom_css']; ?>

h1 a, 
h2 a, 
h3 a, 
h4 a, 
h5 a, 
h6 a {
	color: #303030;
	text-decoration: none;
}

/* Hover effects */
a:not([class*=button]):hover, 
a:not([class*=button]):active,
h1 a:hover, 
h2 a:hover, 
h3 a:hover, 
h4 a:hover, 
h5 a:hover, 
h6 a:hover  {
	color:<?php echo sanitize_rgba($link_color['hover']);?>;
	outline: 0;
}

<?php 
	
if(strpos(Hii::$options['custom_format_1'], '.custom_format_1') === false) echo '.custom_format_1 { '.Hii::$options['custom_format_1']. '}';
else echo Hii::$options['custom_format_1'];
	
if(strpos(Hii::$options['custom_format_2'], '.custom_format_2') === false) echo '.custom_format_2 { '.Hii::$options['custom_format_2']. '}';
else echo Hii::$options['custom_format_2'];
	
if(strpos(Hii::$options['custom_format_3'], '.custom_format_3') === false) echo '.custom_format_3 { '.Hii::$options['custom_format_3']. '}';
else echo Hii::$options['custom_format_3'];
?>

/*--------------------------------------------------------------
7.3 Icons
--------------------------------------------------------------*/

a .fa, .fa {
	display: inline-block;
	width: 1em;
	text-align: center;
	line-height: 1;
	<?php echo get_font_css(get_theme_mod('icon_settings')); ?>
	<?php echo get_font_css(get_theme_mod('icon_settings_bg')); ?>
	border:<?php echo get_theme_mod('icon_settings_border', '0'); ?> solid;
	border-radius:<?php echo get_theme_mod('icon_settings_border_r', '0'); ?>;
	box-sizing: content-box;
}

<?php 
echo Hii::$options['typography_icon_custom_css'];
?>
/*--------------------------------------------------------------
10.0 Blog
--------------------------------------------------------------*/

/* Post Landing Page */
.sticky {
	position: relative;
}

.post:not(.sticky) .icon-thumb-tack {
	display: none;
}

.sticky .icon-thumb-tack {
	display: block;
	height: 18px;
	left: -1.5em;
	position: absolute;
	top: 1.65em;
	width: 20px;
}

.entry-header .entry-title {
	margin-bottom: 0.25em;
}

.entry-title a {
	text-decoration: none;
	margin-left: -2px;
}
.entry-title .fa {
	text-align: left;
	width: 1.2em;
}

.entry-title:not(:first-child) {
	padding-top: 0;
}

.entry-meta {
	color: <?php echo Hii::$options['title_font']['color'];?>;
	font-size: 11px;
	margin: 10px 0;
}
.cat-links, .tags-links {
    display: block;
    font-size: 11px;
    font-size: 0.6875rem;
    font-weight: 400;
    position: relative;
    text-transform: uppercase;
    margin: 10px 0;
}
.page-title .entry-meta a {
	color: <?php echo Hii::$options['title_font']['color'];?>;
}

.single-post .blog-article p {
	<?php echo get_font_css(Hii::$options['blog_single_text_font']); ?>
}

.byline,
.updated:not(.published) {
	display: none;
}

.single .byline,
.group-blog .byline {
	display: inline;
}
li.recentcomments {
    text-overflow: ellipsis;
    overflow: hidden;
}
/*--------------------------------------------------------------
10.3 Pagination
--------------------------------------------------------------*/
.pagination,
.comments-pagination {
	font-size: 16px;
	font-size: 0.875rem;
	font-weight: 800;
	padding: 2em 0 3em;
	text-align: center;
}
div#disqus_thread {
    width: 100%;
}

.pagination .icon,
.comments-pagination .icon {
	width: 0.666666666em;
	height: 0.666666666em;
}

.comments-pagination {
	border: 0;
}

.page-numbers {
	display: none;
	padding: 0.5em 0.75em;
}

.page-numbers.current {
	color: #767676;
	display: inline-block;
}

.page-numbers.current .screen-reader-text {
	clip: auto;
	height: auto;
	overflow: auto;
	position: relative !important;
	width: auto;
}

.prev.page-numbers,
.next.page-numbers {
	background-color: #ddd;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	display: inline-block;
	line-height: 1;
	padding: 0.25em 0.5em 0.4em;
}

.prev.page-numbers,
.next.page-numbers {
	-webkit-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;
	transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;
}

.prev.page-numbers:focus,
.prev.page-numbers:hover,
.next.page-numbers:focus,
.next.page-numbers:hover {
	background-color: #767676;
	color: #fff;
}

.prev.page-numbers {
	float: left;
}

.next.page-numbers {
	float: right;
}

/* Aligned blockquotes */

.entry-content blockquote.alignleft,
.entry-content blockquote.alignright {
	color: #666;
	font-size: 13px;
	font-size: 0.8125rem;
	width: 48%;
}

/* Blog landing, search, archives */

.blog .site-main > article,
.archive .site-main > article,
.search .site-main > article {
	padding-bottom: 2em;
}

.blog .entry-meta a.post-edit-link,
.archive .entry-meta a.post-edit-link,
.search .entry-meta a.post-edit-link {
	color: #222;
	display: inline-block;
	margin-left: 1em;
	white-space: nowrap;
}

.search .page .entry-meta a.post-edit-link {
	margin-left: 0;
	white-space: nowrap;
}

.taxonomy-description {
	color: #666;
	font-size: 13px;
	font-size: 0.8125rem;
}

/* More tag */

.entry-content .more-link:before {
	content: "";
	display: block;
	margin-top: 1.5em;
}

.single-featured-image-header {
	background-color: #fafafa;
	border-bottom: 1px solid #eee;
}

.single-featured-image-header img {
	display: block;
	margin: auto;
}

.page-links {
	font-size: 16px;
	font-size: 0.875rem;
	font-weight: 800;
	padding: 2em 0 3em;
}

.page-links .page-number {
	color: #767676;
	display: inline-block;
	padding: 0.5em 1em;
}

.page-links a {
	display: inline-block;
}

.page-links a .page-number {
	color: #222;
}

/* Entry footer */

.entry-footer {
	border-bottom: 1px solid #eee;
	border-top: 1px solid #eee;
	margin-top: 2em;
	padding: 2em 0;
}

.entry-footer .cat-links,
.entry-footer .tags-links {
	display: block;
	font-size: 11px;
	font-size: 0.6875rem;
	font-weight: 800;
	letter-spacing: 0.1818em;
	position: relative;
	text-transform: uppercase;
}

.entry-footer .cat-links + .tags-links {
	margin-top: 1em;
}

.entry-footer .cat-links a,
.entry-footer .tags-links a {
	color: #333;
}

.entry-footer .cat-links .icon,
.entry-footer .tags-links .icon {
	color: #767676;
	left: 0;
	margin-right: 0.5em;
	position: absolute;
	top: 2px;
}

.entry-footer .edit-link {
	display: inline-block;
}

.entry-footer .edit-link a.post-edit-link {
	background-color: #222;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #fff;
	display: inline-block;
	font-size: 16px;
	font-size: 0.875rem;
	font-weight: 800;
	margin-top: 2em;
	padding: 0.7em 2em;
	-webkit-transition: background-color 0.2s ease-in-out;
	transition: background-color 0.2s ease-in-out;
	white-space: nowrap;
}

.entry-footer .edit-link a.post-edit-link:hover,
.entry-footer .edit-link a.post-edit-link:focus {
	background-color: #767676;
}

/* Post Formats */

.blog .format-status .entry-title,
.archive .format-status .entry-title,
.blog .format-aside .entry-title,
.archive .format-aside .entry-title {
	display: none;
}

.format-quote blockquote {
	color: #333;
	font-size: 20px;
	font-size: 1.25rem;
	font-weight: 300;
	overflow: visible;
	position: relative;
}

.format-quote blockquote .icon {
	display: block;
	height: 20px;
	left: -1.25em;
	position: absolute;
	top: 0.4em;
	-webkit-transform: scale(-1, 1);
	-ms-transform: scale(-1, 1);
	transform: scale(-1, 1);
	width: 20px;
}

/* Post Navigation */

.post-navigation {
	font-weight: 800;
	margin: 3em 0;
	width: 100%;
}

.comments-pagination,
.post-navigation {
	clear: both;
}

.post-navigation .nav-previous {
	float: left;
	width: 50%;
}

.post-navigation .nav-next {
	float: right;
	text-align: right;
	width: 50%;
}

.post-navigation .nav-links {
	padding: 1em 0;
}

.nav-subtitle {
	background: transparent;
	color: #767676;
	display: block;
	font-size: 11px;
	font-size: 0.6875rem;
	letter-spacing: 0.1818em;
	margin-bottom: 1em;
	text-transform: uppercase;
}

.nav-title {
	color: #333;
	font-size: 16px;
	font-size: 0.9375rem;
}

.nav-links .nav-previous .nav-title .nav-title-icon-wrapper {
	margin-right: 0.5em;
}

.nav-links .nav-next .nav-title .nav-title-icon-wrapper {
	margin-left: 0.5em;
}

/*--------------------------------------------------------------
10.4 Comments
--------------------------------------------------------------*/

#comments {
	clear: both;
	padding: 2em 0 0.5em;
}

.comments-title {
	font-size: 20px;
	font-size: 1.25rem;
	margin-bottom: 1.5em;
}

.comment-list,
.comment-list .children {
	list-style: none;
	margin: 0;
	padding: 0;
}

.comment-list li:before {
	display: none;
}

.comment-body {
	margin-left: 65px;
}

.comment-author {
	font-size: 16px;
	font-size: 1rem;
	margin-bottom: 0.4em;
	position: relative;
	z-index: 2;
}

.comment-author .avatar {
	height: 50px;
	left: -65px;
	position: absolute;
	width: 50px;
}

.comment-author .says {
	display: none;
}

.comment-meta {
	margin-bottom: 1.5em;
}

.comment-metadata {
	color: #767676;
	font-size: 10px;
	font-size: 0.625rem;
	font-weight: 800;
	letter-spacing: 0.1818em;
	text-transform: uppercase;
}

.comment-metadata a {
	color: #767676;
}

.comment-metadata a.comment-edit-link {
	color: #222;
	margin-left: 1em;
}

.comment-body {
	color: #333;
	font-size: 16px;
	font-size: 0.875rem;
	margin-bottom: 4em;
}

.comment-reply-link {
	font-weight: 800;
	position: relative;
}

.comment-reply-link .icon {
	color: #222;
	left: -2em;
	height: 1em;
	position: absolute;
	top: 0;
	width: 1em;
}

.children .comment-author .avatar {
	height: 30px;
	left: -45px;
	width: 30px;
}

.bypostauthor > .comment-body > .comment-meta > .comment-author .avatar {
	border: 1px solid #333;
	padding: 2px;
}

.no-comments,
.comment-awaiting-moderation {
	color: #767676;
	font-size: 16px;
	font-size: 0.875rem;
	font-style: italic;
}

.comments-pagination {
	margin: 2em 0 3em;
}

.form-submit {
	text-align: right;
}


/*--------------------------------------------------------------
15.0 SVGs Fallbacks
--------------------------------------------------------------*/

.svg-fallback {
	display: none;
}

.no-svg .svg-fallback {
	display: inline-block;
}

.no-svg .dropdown-toggle {
	padding: 0.5em 0 0;
	right: 0;
	text-align: center;
	width: 2em;
}

.no-svg .dropdown-toggle .svg-fallback.icon-angle-down {
	font-size: 20px;
	font-size: 1.25rem;
	font-weight: 400;
	line-height: 1;
	-webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
	-ms-transform: rotate(180deg); /* IE 9 */
	transform: rotate(180deg);
}

.no-svg .dropdown-toggle.toggled-on .svg-fallback.icon-angle-down {
	-webkit-transform: rotate(0); /* Chrome, Safari, Opera */
	-ms-transform: rotate(0); /* IE 9 */
	transform: rotate(0);
}

.no-svg .dropdown-toggle .svg-fallback.icon-angle-down:before {
	content: "\005E";
}

/* Social Menu fallbacks */

.no-svg .social-navigation a {
	background: transparent;
	color: #222;
	height: auto;
	width: auto;
}

/* Show screen reader text in some cases */

.no-svg .next.page-numbers .screen-reader-text,
.no-svg .prev.page-numbers .screen-reader-text,
.no-svg .social-navigation li a .screen-reader-text,
.no-svg .search-submit .screen-reader-text {
	clip: auto;
	font-size: 16px;
	font-size: 1rem;
	font-weight: 400;
	height: auto;
	position: relative !important; /* overrides previous !important styles */
	width: auto;
}
/*--------------------------------------------------------------
18.0 Page Loader
--------------------------------------------------------------*/
#page-loader {
	opacity: 1;
	transition: all 0.4s;
}
#page-loader circle {
	stroke-width: 10;
	stroke-linecap: round;
	fill: none;
}
#page-loader circle:nth-child(1) {
	stroke: #e0e0e0;
	stroke-dasharray: 50;
}
#page-loader circle:nth-child(2) {
	stroke: #ebebeb;
	stroke-dasharray: 100;
}

#page-loader circle:nth-child(3) {
	stroke: #f3f3f3;
	stroke-dasharray: 180;
}
#page-loader circle:nth-child(4) {
	stroke: #f9f9f9;
	stroke-dasharray: 350; 
	stroke-dashoffset: -100;
}

/* 2. Create the keyframe animation. We start at 50% so the circle will rotate back to its original position. */
@keyframes loader {
	50% {
		transform: rotate(360deg);
	}
}

#page-loader circle {
	animation-name: loader;
	animation-duration: 4s;
	animation-iteration-count: infinite;
	animation-timing-function: ease-in-out;
	transform-origin: center center;
}

#page-loader circle:nth-of-type(1) {
	animation-delay: -0.2s;
}

#page-loader circle:nth-of-type(2) {
	animation-delay: -0.4s;
}

#page-loader circle:nth-of-type(3) {
	animation-delay: -0.6s;
}

#page-loader circle:nth-of-type(4) {
	animation-delay: -0.8s;
}
html[class*="-active"] #page-loader {
	opacity: 0;
	display: none !important;
}
/*--------------------------------------------------------------
19.0 Media Queries
--------------------------------------------------------------*/

/*--------------------------------------------------------------
20.0 Print
--------------------------------------------------------------*/
a, 
.button, 
.menu li {
	transition:all 240ms;
}

.fa.blog-default-icon {
	color:<?php echo Hii::$options['blog_format_icon'];?>;
	font-size: 110px;
	padding-top: 45px;
}

.blog-article .post_author a {
    color: #bebebe;
}
.back_to_blog {
  font-size:16px;
}
.back_to_blog .fa {
	color:<?php echo Hii::$options['title_font']['color'];?>;
}


figcaption {
    line-height: 1.5;
    color: #999;
    font-size: 0.8em;
}
figure.align-center img{
	margin: auto;
	
}
.single-image img {
	display:inline-block;
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
    width:100%;
}
figure.single-image.hover-image.text-block .hover_image-img {
    padding: 1em;
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
	font-size: 16px;
    font-style: italic;
}



<?php 
	
//////////////////////
//
//	note: Generate Heading tags
//
//////////////////////
$tablet_heading_sizes = '@media (max-width:768px){';
$mobile_heading_sizes = '@media (max-width:550px){';
for($h=1;$h<=6;$h++):
	$heading_rule = "h{$h},.h{$h} {";
	$output = $heading_rule;
	$output .= get_font_css(Hii::$options['typography_h'.$h.'_font']);
	$output .= '}';
	
	preg_match('/^[0-9]+(\.[0-9]{1,2})?/', Hii::$options['typography_h'.$h.'_font']['font-size'], $font_size);
	
	
	$font_unit = preg_replace("/[^a-zA-Z]+/", "", Hii::$options['typography_h'.$h.'_font']['font-size']);
	if(isset($font_size) && $font_unit){
		$tablet_heading_sizes .= $heading_rule . 'font-size:' . ($font_size[0] * 0.83) . $font_unit . '}';
		$mobile_heading_sizes .= $heading_rule . 'font-size:' . ($font_size[0] * 0.75) . $font_unit . '}';
	}
	echo esc_html($output);
endfor; 

echo esc_html($tablet_heading_sizes.'}');
echo esc_html($mobile_heading_sizes.'}');
?>


p {
<?php	
	echo get_font_css(Hii::$options['text_font']);
	if(Hii::$options['text_margin'] != '') echo 'margin-bottom:'.Hii::$options['text_margin'].';';
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
	margin: 0 auto auto auto;
	display: flex;
	width: 100%;
	align-items: stretch;
	flex-wrap: wrap;
	box-sizing: border-box;
}
.grid-left {
    padding-left: calc((100vw - 1100px)/2) !important;
    min-width: initial;
}
.grid-right {
    padding-right: calc((100vw - 1100px)/2) !important;
    min-width: initial;
}
@media (max-width: 1100px) {
    .grid-right {
        padding-right: 0 !important;
        min-width: initial;
    }
    .grid-left {
        padding-left: 0 !important;
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
	max-width: <?php echo Hii::$options['grid_width'];?>;
}
<?php
get_template_part('css/vc_elements/row', 'css');
/*--------------------------------------------------------------
6.0 Elements
--------------------------------------------------------------*/
/*--------------------------------------------------------------
6.1 Buttons
--------------------------------------------------------------*/
get_template_part('css/elements/buttons'); 
/*--------------------------------------------------------------
6.3 Sliders
--------------------------------------------------------------*/
get_template_part('css/elements/amp-carousel', 'css');
get_template_part('css/elements/hii_post_carousel', 'css');

/*--------------------------------------------------------------
3.0 Header
--------------------------------------------------------------*/
get_template_part('css/header/header', 'css'); 
/*--------------------------------------------------------------
3.3 Menu
--------------------------------------------------------------*/
get_template_part('css/header/menu', 'css');


/*--------------------------------------------------------------
4.0 Footer
--------------------------------------------------------------*/
$footer_top_colors = get_theme_mod('footer_top_colors');
$footer_bottom_colors = get_theme_mod('footer_bottom_colors');	
?>
#main_footer {
	position: relative;
	<?php 
	echo get_background_css(Hii::$options['footer_background']);
	echo get_font_css(Hii::$options['typography_footer_text_font'])
	?>
	border-top-style:solid;
} 
#main_footer p {
	<?php 
	echo get_font_css(Hii::$options['typography_footer_text_font'])
	?>
} 

#main_footer h1,#main_footer h2,#main_footer h3,#main_footer h4,#main_footer h5,#main_footer h6 {
	<?php echo get_font_css(Hii::$options['typography_footer_headings_font']); ?>
}
#main_footer a {
	<?php echo get_font_css(Hii::$options['typography_footer_links_font']); ?>
}
#main_footer .menu .menu-item a {
	padding:0;
}
<?php 
if(get_theme_mod( 'show_footer_top_yesno', true )): ?>
 #footer_top {
	<?php 
	echo get_background_css(Hii::$options['footer_top_background']);
	if($footer_top_colors['text']) echo 'color:'.$footer_top_colors['text'];
?>
}

#footer_top .menu {
    display: block;
}
<?php endif; ?>

#footer_top .widgettitle {
<?php 
	echo get_font_css(Hii::$options['typography_footer_headings_font']);
	if($footer_top_colors['title']) echo 'color:'.$footer_top_colors['title'];
?>
}

#footer_top a {
<?php 
	echo get_font_css(Hii::$options['typography_footer_links_font']);
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
	background: <?php echo get_theme_mod('footer_bottom_background_color'); ?>;
	border-top-style: solid;
	<?php 
	echo get_font_css(get_theme_mod('typography_footer_bottom_text_font'));
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

/*--------------------------------------------------------------
5.0 Title
--------------------------------------------------------------*/
<?php get_template_part('css/elements/page_titles', 'css');?>


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
.text-block.with-icon {
	 display: flex;
}
.text-block.with-icon.icon-left { flex-flow: wrap; }
.text-block.with-icon.icon-right { flex-flow: row-reverse; flex-wrap: wrap; }
.text-block.with-icon.icon-top { flex-flow: column; }
.text-block.with-icon.icon-bottom { flex-flow: column-reverse; }
.text-block.with-icon .text-block-icon {
	flex: 0 0 auto;
}
.text-block.with-icon .with-icon-text {
    flex: 2 1 100px;
}
.text-block-icon {
	padding: 1em 0;
}
.text-block-icon.align-left {
	padding-right: 1em;
	padding-top: 0;
	margin-top: 0;
}
.small, .fa.small { font-size: 16px; }
.regular, .fa.regular  { font-size: 20px; }
.large, .fa.large  { font-size: 35px; }
.extra-large, .fa.extra-large  { font-size: 50px; }

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
.blog-loop .content-box {
	border-style: solid;
}
.blog-article header {
	width: 100%;
}
.blog-article .content-box {
	margin: 0 auto;
}
.blog-article figure {
	padding: 0 1em;
	text-align: center;
}
.blog-article .single-blog-post figure {
	padding: 0;
}
.blog-article .single-blog-post figure img {
	width: 100%;
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

<?php if(Hii::$options['blog_layouts'] == 'boxed'): ?>
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

/* Numbered Pagination */
.num-pagination li a,
.num-pagination li a:hover,
.num-pagination li.active a,
.num-pagination li.disabled {
    color: <?php echo Hii::$options['pagination_text_color'];?>;
    text-decoration:none;
}
 
.num-pagination li {
    display: inline;
}
 
.num-pagination li a,
.num-pagination li a:hover,
.num-pagination li.active a,
.num-pagination li.disabled {
    background-color: <?php echo Hii::$options['pagination_non_active_page_color'];?>;
    border-radius: 3px;
    cursor: pointer;
    padding: 10px;
    padding: 0.5rem;
}
 
.num-pagination li a:hover,
.num-pagination li.active a {
    background-color: <?php echo Hii::$options['pagination_active_page_color'];?>;
}
/* END Numbered Pagination */


/*--------------------------------------------------------------
8.0 Sidebar
--------------------------------------------------------------*/
.sidebar,
.widget {
	<?php echo get_font_css(get_theme_mod( 'sidebar_widget_text_font' )); ?>
}
.sidebar h3,
.widgettitle {
	<?php echo get_font_css(get_theme_mod( 'sidebar_widget_title_font' )); ?>
}
.sidebar a,
.widget a {
	<?php echo get_font_css(get_theme_mod( 'sidebar_widget_link_font' ));	?>
}
.sidebar ul,
.widget ul {
	list-style: none;
	padding: 0;
}
.sidebar ul ul,
.widget ul ul{
	list-style: none;
	padding-left: 1em;
}
aside .widget ul li,
.widget_recent_entries li  {
	padding: 5px 0;
	border-bottom: 1px solid rgba(204, 204, 204, 0.2);
}
.sidebar {
	background: <?php echo Hii::$options['sidebar_background'];?>;
	border: <?php echo Hii::$options['sidebar_border_width'].' solid '.Hii::$options['sidebar_border_color'];?>;
}
.sidebar .depth_2 {
	padding-left:1em;	
}
.sidebar .depth_3 {
	padding-left:2em;	
}
.sidebar,
#post_sidebar, 
#blog_sidebar {
	<?php
	echo 'padding:'.get_spacing(Hii::$options['sidebar_padding']).';';	
	?>
	background: <?php echo Hii::$options['sidebar_background'];?>;
}
.sidebar ul {
	display:block;
}
.sidebar .widget,
#post_sidebar .widget, 
#blog_sidebar .widget {
	<?php
	echo 'margin:'.get_spacing(Hii::$options['sidebar_widget_margin']).';';	
	?>
}
.sidebar > .widget {
	<?php
	echo 'padding:'.get_spacing(Hii::$options['sidebar_widget_padding']).';';	
	?>
	border: <?php echo Hii::$options['sidebar_widget_border_width'].' solid '.Hii::$options['sidebar_widget_border_color'];?>;
}



/*--------------------------------------------------------------
9.0 Testimonials
--------------------------------------------------------------*/
<?php
	
if(Hii::$options['testimonials_on']):
	?>
	.testimonial_item {
	    padding: 0 1em 1em 1em;
	}
	.testimonial_content { 
		<?php echo get_font_css(Hii::$options[ 'testimonials_body_font' ]); ?>
	}
	.testimonial_author {
		<?php echo get_font_css(Hii::$options[ 'testimonials_author_font' ]); ?>
	}
	.testimonial_item .circle.testimonial_image {
	    overflow: hidden;
	    border-radius: 100%;
	    width: 100px;
	    height: 100px;
	}
<?php endif ?>


#closelightbox{position:fixed;width:100vw;height:100vh;z-index:9999;}


/*--------------------------------------------------------------
10.0 Blog
--------------------------------------------------------------*/
hr.small {
	width: 60px;
	border-style: solid;
}

.relatedarticle {
	max-width: 220px;
}
.relatedposts .relatedarticle {
	max-width: 220px;
	overflow: hidden;
	display: inline-block;
	padding: 1em;
    vertical-align: top;
}
.relatedposts .relatedarticle p {
	max-width: 200px;
	text-overflow: ellipsis;
	white-space: normal;
	overflow: hidden;
	margin-top: 0;
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
/*--------------------------------------------------------------
11.0 Portfolio
--------------------------------------------------------------*/
if(Hii::$options['portfolio_on']): 
	get_template_part( 'css/portfolio/portfolio', 'css');
endif;
/*--------------------------------------------------------------
12.0 Teams
--------------------------------------------------------------*/
if(Hii::$options['teams_on']):
	get_template_part( 'css/elements/teams', 'css');
endif; ?>

.team-member-content {
	padding-left: 1em;
	padding-right: 1em;
}
.related-team-member {
	max-width: 250px;
	width: 250px;
}
.single-team-member .related-team-member {
	max-width: 250px;
	overflow: hidden;
	display: inline-block;
	padding: 1em;
    vertical-align: top;
}
.single-team-member .related-team-member p {
	max-width: 200px;
	text-overflow: ellipsis;
	white-space: normal;
	overflow: hidden;
	margin-top: 0;
}
.related-team-title {
	max-width: 200px;
	text-overflow: ellipsis;
	white-space: normal;
	overflow: hidden;
	margin: 0 auto;
	text-align: center;
	margin-top: 0;
	padding: 10px 0em;
}
.meet-the-team-btn {
	margin-top: 2em;
	margin-bottom: 3em;
}
.teams-title {
	margin-bottom: 2em;
}
.related-team-member img, .team-img-container {
	margin: 0 auto;
	text-align: center;
}
/* END Single Team Member Page */

/*--------------------------------------------------------------
13.3 Food Menu
--------------------------------------------------------------*/
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

/*--------------------------------------------------------------
13.7 The Event Calendar
--------------------------------------------------------------*/
.tribe-events-cost.col-3.align-right {
    font-size: 3em;
}
.tribe-events-event-meta .tribe-events-meta-group {
    min-width: 33.3333%;
    max-width: 340px;
    width: 100%;
}
<?php

/*--------------------------------------------------------------
13.4 WP User Manager
--------------------------------------------------------------*/
if(class_exists('WP_User_Manager')): ?>
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
/*--------------------------------------------------------------
13.5 VC Manager
--------------------------------------------------------------*/
if(class_exists('Vc_Manager')): 
	get_template_part('css/service_extensions/js_composer', 'css');	
endif;
/*--------------------------------------------------------------
13.6 BuddyPress
--------------------------------------------------------------*/
if(class_exists('BuddyPress')): 
	get_template_part('css/service_extensions/buddypress', 'css');	
endif;
/*--------------------------------------------------------------
13.7 WooCommerce
--------------------------------------------------------------*/
if(class_exists('WooCommerce')):
	get_template_part('css/service_extensions/woocommerce', 'css');	
endif;
/*--------------------------------------------------------------
13.8 Sensei
--------------------------------------------------------------*/
if(class_exists('Sensei_Main')):
	get_template_part('css/service_extensions/sensei', 'css');	
endif;
/*--------------------------------------------------------------
13.9 Gravity Forms
--------------------------------------------------------------*/
if(class_exists('GFForms')):
	get_template_part('css/service_extensions/gravityforms', 'css');	
endif;
/*--------------------------------------------------------------
13.10 Contact Form 7
--------------------------------------------------------------*/
if(class_exists('WPCF7')):
	get_template_part('css/service_extensions/contactform7', 'css');	
endif;
/*--------------------------------------------------------------
13.11 SportsPress
--------------------------------------------------------------*/
if(class_exists('SportsPress')):
	get_template_part( 'css/service_extensions/sportspress', 'css');
endif;

if(is_user_logged_in()):
	?>
	li#wp-admin-bar-new_draft, li#wp-admin-bar-edit, li#wp-admin-bar-new-content, li#wp-admin-bar-customize, li#wp-admin-bar-site-name {
	    max-width: 2.5em;
	    text-overflow: clip;
	    white-space: nowrap;
	}
	li#wp-admin-bar-my-account span.display-name {
	    display: none;
	}
	a.ab-item {
	    overflow: hidden;
	} 
	<?php
endif;

?>
/*--------------------------------------------------------------
14.0 Overwrites
--------------------------------------------------------------*/
.color_one  { color: <?php echo Hii::$options['color_one'];?>; }
.color_two 	{ color: <?php echo Hii::$options['color_two'];?>; }
.color_three{ color: <?php echo Hii::$options['color_three'];?>; }
.color_four { color: <?php echo Hii::$options['color_four'];?>; }
.white, .page-title h1.white, 
.white h1, .white h2, .white h3, .white h4, .white h5, .white h6, .white p, .white label { color:white; }
.bg_color_one  { background-color: <?php echo Hii::$options['color_one'];?>; }
.bg_color_two 	{ background-color: <?php echo Hii::$options['color_two'];?>; }
.bg_color_three{ background-color: <?php echo Hii::$options['color_three'];?>; }
.bg_color_four { background-color: <?php echo Hii::$options['color_four'];?>; }
.bg_white { background-color:white; }

<?php

do_action ( 'custom_css' );
echo Hii::$options['custom_css'];
echo Hii::$options['portfolio_custom_css'];
?>

</style>