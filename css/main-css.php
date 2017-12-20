<style>
<?php 
global $is_IE;
include_once('font-awesome/css/font-awesome.min.css'); 
?>
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 Normalize
2.0 Accessibility
3.0 Alignments
4.0 Clearings
5.0 Typography
6.0 Forms
7.0 Formatting
8.0 Lists
9.0 Tables
10.0 Links
11.0 Featured Image Hover
12.0 Navigation
13.0 Layout
   13.1 Header
   13.2 Front Page
   13.3 Regular Content
   13.4 Posts
   13.5 Pages
   13.6 Footer
14.0 Comments
15.0 Widgets
16.0 Media
   16.1 Galleries
17.0 Customizer
18.0 SVGs Fallbacks
19.0 Media Queries
20.0 Print
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1.0 Normalize
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

body {
	margin: 0;
}

body,
button,
input,
select,
textarea {<?php 
	get_font_css(Hii::$options['default_font']); ?>
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


/*--------------------------------------------------------------
2.0 Accessibility
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
	font-size: 14px;
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
3.0 Alignments
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
.align-left, 
.alignleft {
	text-align: left;
	align-self: flex-start;
	margin: auto auto auto 0;
}
img.alignleft {
	float:left;
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


/*--------------------------------------------------------------
4.0 Clearings
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
5.0 Typography
--------------------------------------------------------------*/

h1, 
h2, 
h3, 
h4, 
h5, 
h6 {
	clear: both;
	line-height:1.4;
	margin: 0;
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
	margin: 0 0 1.5em;
	padding: 0;
}

dfn,
cite,
em,
i {
	font-style: italic;
}

blockquote {
	color: #666;
	font-size: 18px;
	font-size: 1.125rem;
	font-style: italic;
	line-height: 1.7;
	margin: 0;
	overflow: hidden;
	padding: 0;
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
	font-size: 15px;
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
	font-size: 15px;
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

/*--------------------------------------------------------------
6.0 Forms
--------------------------------------------------------------*/
get_template_part('css/elements/forms');

?>
/*--------------------------------------------------------------
7.0 Formatting
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

/*--------------------------------------------------------------
8.0 Lists
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
	font-weight: 700;
}

dd {
	margin: 0 1.5em 1.5em;
}

ol li ol li {
    list-style-type: lower-alpha;
}

/*--------------------------------------------------------------
9.0 Tables
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
10.0 Links
--------------------------------------------------------------*/

a,  
a .fa {
	color:<?php echo $link_color['link'];?>;<?php echo preg_replace('/[{}]/','',Hii::$options['typography_link_custom_css']); ?>
	text-decoration: none;
	-webkit-transition: color 80ms ease-in, -webkit-box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, -webkit-box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, box-shadow 130ms ease-in-out, -webkit-box-shadow 130ms ease-in-out;
}

h1 a, 
h2 a, 
h3 a, 
h4 a, 
h5 a, 
h6 a {
	color: #303030;
	text-decoration: none;
	-webkit-transition: color 80ms ease-in, -webkit-box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, -webkit-box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, box-shadow 130ms ease-in-out;
	transition: color 80ms ease-in, box-shadow 130ms ease-in-out, -webkit-box-shadow 130ms ease-in-out;
}

/* Hover effects */
a:not(.button):hover, 
a:not(.button):active,
h1 a:hover, 
h2 a:hover, 
h3 a:hover, 
h4 a:hover, 
h5 a:hover, 
h6 a:hover  {
	color:<?php echo $link_color['hover'];?>;
	outline: 0;
	-webkit-box-shadow: inset 0 0 0 rgba(0, 0, 0, 0), 0 2px 0 <?php echo $link_color['hover'];?>;
	box-shadow: inset 0 0 0 rgba(0, 0, 0, 0), 0 2px 0 <?php echo $link_color['hover'];?>;
}



/* Fixes linked images */
.entry-content a img,
.widget a img {
	-webkit-box-shadow: 0 0 0 8px #fff;
	box-shadow: 0 0 0 8px #fff;
}

.post-navigation a:focus .icon,
.post-navigation a:hover .icon {
	color: #222;
}

/*--------------------------------------------------------------
11.0 Featured Image Hover
--------------------------------------------------------------*/
/*--------------------------------------------------------------
13.4 Posts
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
	color: #333;
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
	color: #767676;
	font-size: 11px;
	font-size: 0.6875rem;
	font-weight: 800;
	letter-spacing: 0.1818em;
	padding-bottom: 0.25em;
	text-transform: uppercase;
}
.cat-links, .tags-links {
    display: block;
    font-size: 11px;
    font-size: 0.6875rem;
    font-weight: 400;
    letter-spacing: 0.1818em;
    position: relative;
    text-transform: uppercase;
}
.entry-meta a {
	color: #767676;
}

.byline,
.updated:not(.published) {
	display: none;
}

.single .byline,
.group-blog .byline {
	display: inline;
}

.pagination,
.comments-pagination {
	border-top: 1px solid #eee;
	font-size: 14px;
	font-size: 0.875rem;
	font-weight: 800;
	padding: 2em 0 3em;
	text-align: center;
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
#home_blog_loop .blog-article:first-child {
	margin-top: 1em;
}
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
	font-size: 14px;
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
	font-size: 14px;
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
	font-size: 15px;
	font-size: 0.9375rem;
}

.nav-links .nav-previous .nav-title .nav-title-icon-wrapper {
	margin-right: 0.5em;
}

.nav-links .nav-next .nav-title .nav-title-icon-wrapper {
	margin-left: 0.5em;
}

/*--------------------------------------------------------------
14.0 Comments
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
	font-size: 14px;
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
	font-size: 14px;
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
16.0 Media
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

/*--------------------------------------------------------------
16.1 Galleries
--------------------------------------------------------------*/

.gallery-item {
	display: inline-block;
	text-align: left;
	vertical-align: top;
	margin: 0 0 1.5em;
	padding: 0 1em 0 0;
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
}

.gallery-item a img {
	display: block;
	-webkit-transition: -webkit-filter 0.2s ease-in;
	transition: -webkit-filter 0.2s ease-in;
	transition: filter 0.2s ease-in;
	transition: filter 0.2s ease-in, -webkit-filter 0.2s ease-in;
	-webkit-backface-visibility: hidden;
	backface-visibility: hidden;
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
18.0 SVGs Fallbacks
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


.blog-article .post_author a {
    color: #bebebe;
}
.back_to_blog {
  font-size:14px;
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



<?php 
//////////////////////
//
//	note: Generate Heading tags
//
//////////////////////
$tablet_heading_sizes = '@media (max-width:768px){';
$mobile_heading_sizes = '@media (max-width:550px){';
for($h=1;$h<=6;$h++):
	$heading_rule = "h$h,.h$h {";
	echo $heading_rule;
	get_font_css(Hii::$options['typography_h'.$h.'_font']);
	echo '}';
	
	$font_size = preg_match('/([0-9]+\.[0-9]+)/', Hii::$options['typography_h'.$h.'_font']['font-size'],$fs_int);
	$font_unit = preg_replace("/[^a-zA-Z]+/", "", Hii::$options['typography_h'.$h.'_font']['font-size']);
	if(isset($font_size) && $font_unit){
		$tablet_heading_sizes .= $heading_rule . 'font-size:' . ($fs_int[0]* 0.85) . $font_unit . '}';
		$mobile_heading_sizes .= $heading_rule . 'font-size:' . ($fs_int[0]* 0.75) . $font_unit . '}';
	}
endfor; 

echo $tablet_heading_sizes.'}';
echo $mobile_heading_sizes.'}';
?>


p {
<?php	
	get_font_css(Hii::$options['text_font']);
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
	margin: auto;
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
get_template_part('css/elements/buttons'); 

get_template_part('css/header/header', 'css'); 
get_template_part('css/header/menu', 'css');
get_template_part('css/elements/page_titles', 'css');
/*
//	note: FOOTER 
*/
$footer_top_colors = get_theme_mod('footer_top_colors');
$footer_bottom_colors = get_theme_mod('footer_bottom_colors');	
?>
#main_footer {
	position: relative;
	<?php 
	get_background_css(Hii::$options['footer_background']);
	get_font_css(Hii::$options['typography_footer_text_font']);
	
?>
border-top-style:solid;
} 

#main_footer h1,#main_footer h2,#main_footer h3,#main_footer h4,#main_footer h5,#main_footer h6 {
	<?php get_font_css(Hii::$options['typography_footer_headings_font']); ?>
}
#main_footer a {
	<?php get_font_css(Hii::$options['typography_footer_links_font']); ?>
}
#main_footer .menu .menu-item a {
	padding:0;
}
<?php 
if(get_theme_mod( 'show_footer_top_yesno', true )): ?>
 #footer_top {
	<?php 
	get_background_css(Hii::$options['footer_top_background']);
	if($footer_top_colors['text']) echo 'color:'.$footer_top_colors['text'];
?>
}

#footer_top .menu {
    display: block;
}
<?php endif; ?>

#footer_top .widgettitle {
<?php 
	get_font_css(Hii::$options['typography_footer_headings_font']);
	if($footer_top_colors['title']) echo 'color:'.$footer_top_colors['title'];
?>
}

#footer_top a {
<?php 
	get_font_css(Hii::$options['typography_footer_links_font']);
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
	echo '.vc_col-xs-'.$i.', .vc_col-md-'.$i.', .vc_col-sm-'.$i.', .vc_col-lg-'.$i.', .col-'.$i;
	echo ($alt_cols[$i])?', .'.$alt_cols[$i]:'';
	echo '{';
		$perc_ratio = floor((($i/12)*100));
		echo ($i > 12)?'max-width:'.$perc_ratio.'em;':'max-width:100%;';
		echo 'width:'.$perc_ratio.'%;';
		$min_width = ($i>4)?'320':'160';
		echo 'flex:1 1 '.$perc_ratio.'%;';
		if($is_IE) echo 'flex-basis: '.($perc_ratio - 5).'%;';
	echo '}';
endfor;
?>

@media (max-width:550px){
	width:100%;
	flex:1 1 100%;
<?php 
for($i = 12; $i>0;$i--):
	echo '.vc_col-xs-'.$i.', .vc_col-md-'.$i.', .vc_col-sm-'.$i.', .vc_col-lg-'.$i.', .col-'.$i;
	echo ($alt_cols[$i])?', .'.$alt_cols[$i]:'';
	echo '{';
		$perc_ratio = floor((($i/12)*100));
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
<?php 

if(Hii::$options['portfolio_on']): 
	get_template_part( 'css/portfolio/portfolio', 'css');
endif; ?>

<?php if(Hii::$options['teams_on']): ?>
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





<?php echo Hii::$options['typography_icon_custom_css'];?>

.fa {
	display: inline-block;
	width: 1.5em;
	text-align: center;
	line-height: 1.6em;
	<?php get_font_css(get_theme_mod('icon_settings')); ?>
	<?php get_font_css(get_theme_mod('icon_settings_bg')); ?>
	border:<?php echo get_theme_mod('icon_settings_border', '0'); ?> solid;
	border-radius:<?php echo get_theme_mod('icon_settings_border_r', '0'); ?>;
}



<?php 
echo Hii::$options['typography_icon_custom_css'];
	
if(strpos(Hii::$options['custom_format_1'], '.custom_format_1') === false) echo '.custom_format_1 { '.Hii::$options['custom_format_1']. '}';
else echo Hii::$options['custom_format_1'];
	
if(strpos(Hii::$options['custom_format_2'], '.custom_format_2') === false) echo '.custom_format_2 { '.Hii::$options['custom_format_2']. '}';
else echo Hii::$options['custom_format_2'];
	
if(strpos(Hii::$options['custom_format_3'], '.custom_format_3') === false) echo '.custom_format_3 { '.Hii::$options['custom_format_3']. '}';
else echo Hii::$options['custom_format_3'];
?>


/*
//	note: Widgets
*/
.sidebar,
.widget {
	<?php get_font_css(get_theme_mod( 'sidebar_widget_text_font' )); ?>
}
.sidebar h3,
.widgettitle {
	<?php get_font_css(get_theme_mod( 'sidebar_widget_title_font' )); ?>
}
.sidebar a,
.widget a {
	<?php	get_font_css(get_theme_mod( 'sidebar_widget_link_font' ));	?>
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
aside .widget ul li {
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
/* Re coloring*/
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



/*
//	note: Complimentary styles	
*/


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
    background: white;
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
amp-carousel.carousel .carousel-wrapper{
	white-space: nowrap; position: absolute; z-index: 1; top: 0px; left: 0px; bottom: 0px;
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

/* POST SLIDER */

.hii_post_carousel {
  width: 100%;
  height: 100%;
  background:#fff;
  display:flex;
}
.hii_post_carousel_wrap {
	position:relative;	
}
/*.hii_post_carousel_wrap > div {
	width: 80%;
}*/
.hii_carousel_post {
	display:none;
	/*width:0;*/	
	position:absolute;
	left:-1000;
	text-align:center;
	-webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_left {
  display: block !important;
  visibility: visible !important;
  opacity: 1 !important;
  position: absolute;
  top: 30%;
  left: 0;
  width: 20% !important;
  z-index: 1;
  -webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_center {
  display: block !important;
  position: absolute;
  top:0;
  left: 20%;
  width: 60% !important;
  z-index: 2;
  -webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_right {
  display: block !important;
  visibility: visible !important;
  opacity: 1 !important;
  position: absolute;
  top: 30%;
  left: 80%;
  width: 20% !important;
  z-index: 1;
  -webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_center h3, .hii_pc_center .hii_post_exc, .hii_pc_center .button {
	visibility:visible;
	opacity:1;
	-webkit-transition: visibility 500ms, opacity 500ms;
	-moz-transition: visibility 500ms, opacity 500ms;
	-o-transition: visibility 500ms, opacity 500ms;
	-ms-transition: visibility 500ms, opacity 500ms;
	transition: visibility 500ms, opacity 500ms;	
	-webkit-transition-delay: 1s;
    -moz-transition-delay: 1s;
    -o-transition-delay: 1s;
    transition-delay: 1s;
}
.hii_pc_left h3, .hii_pc_left .hii_post_exc, .hii_pc_left .button, 
.hii_pc_right h3, .hii_pc_right .hii_post_exc, .hii_pc_right .button,
.fade-out-left h3, .fade-out-left .hii_post_exc, .fade-out-left .button,
.fade-out-right h3, .fade-out-right .hii_post_exc, .fade-out-right .button,
.fade-in h3, .fade-in .hii_post_exc, .fade-in .button {
	visibility:hidden;
	opacity:0;
	height:0;
}
#hii_pc_prev, #hii_pc_next {
	text-align:center;
	align-self: center;
}
#hii_pc_prev .fa, #hii_pc_next .fa {
	font-size:2rem;
	color:#303030;
	cursor:pointer;
}
.fade-out-left {
	display: block !important;
	visibility: visible;
	opacity: 0;
	position: absolute;
	top: 30%;
	left: 0;
	width: 20% !important;
	z-index: 1;
	-webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.fade-out-right {
	display: block !important;
	visibility: visible;
	opacity: 0;
	position: absolute;
	top: 30%;
	left: 80%;
	width: 20% !important;
	z-index: 1;
	-webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.fade-in {
	display: block;
	opacity:0;
}
@media(max-width:550px) {
	.hii_pc_left, .hii_pc_right {
		display:none !important;	
	}
}


.relatedposts .relatedarticle {
	max-width: 200px;
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
	
if(Hii::$options['testimonials_on']):
	?>
	.testimonial_item {
	    padding: 0 3em;
	}
	.testimonial_content { 
		padding:1em;
		<?php get_font_css(Hii::$options[ 'testimonials_body_font' ]); ?>
	}
	.testimonial_author {
		padding: 1em;
		<?php get_font_css(Hii::$options[ 'testimonials_author_font' ]); ?>
	}
<?php endif ?>

.text-align.center {
	text-align: center;
}

.fl {
	float: left;
}

#closelightbox{position:fixed;width:100vw;height:100vh;z-index:9999;}


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
.wpb_gmaps_widget .wpb_wrapper {
	padding:0;
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

if(class_exists('BuddyPress')): 
	get_template_part('css/service_extensions/buddypress', 'css');	
endif;
if(class_exists('WooCommerce')):
	get_template_part('css/service_extensions/woocommerce', 'css');	
endif;
if(class_exists('Sensei_Main')):
	get_template_part('css/service_extensions/sensei', 'css');	
endif;
if(class_exists('GFForms')):
	get_template_part('css/service_extensions/gravityforms', 'css');	
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

$custom_formats = '
.custom_format_1 {
	'.preg_replace('/[{}]/','',Hii::$options['custom_format_1']).'
}
.custom_format_2 {
	'.preg_replace('/[{}]/','',Hii::$options['custom_format_2']).'
}
.custom_format_3 {
	'.preg_replace('/[{}]/','',Hii::$options['custom_format_3']).'
}';
echo $custom_formats;

do_action ( 'custom_css' );
echo Hii::$options['custom_css'];
echo Hii::$options['portfolio_custom_css'];
?>

</style>