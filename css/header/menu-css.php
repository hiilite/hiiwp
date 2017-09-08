<?php if(false): ?><style><?php endif; 

$main_menu_colors = $hiilite_options['main_menu_colors'];
$second_level_menu_colors = $hiilite_options['second_level_menu_colors'];	
?>
#main-nav {
	margin:<?=get_spacing($hiilite_options['menu_margin']);?>;
}
.main-menu.menu, #header_top .menu, #header_bottom .menu {
	list-style: none;
	padding: 0;
	margin: 0;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}
#footer-nav .menu {
    display: flex;
    justify-content: space-evenly;
}
.menu .menu-item  {
	position: relative;
	cursor: pointer;
}
.menu .menu-item a{
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

#main-nav .main-menu, #header_top .menu {
	<?php get_justify_content($hiilite_options['main_menu_align']); ?>
}
.left-menu {
	<?php get_justify_content($hiilite_options['left_menu_align']); ?>
}
.right-menu {
	<?php get_justify_content($hiilite_options['right_menu_align']); ?>
}
.bottom-menu {
	<?php get_justify_content($hiilite_options['bottom_menu_align']); ?>
}

<?php
/*
//	note: SUB MENU
 */
?>
ul.sub-menu {
    position: absolute;
    list-style: none;
    padding: 0;
    display: none;
	min-width: 12em;
	z-index: 10; 
	background-color: <?=$hiilite_options['dropdown_background_color'];?>;
}

#main_header .menu ul.sub-menu .menu-item a {
	text-decoration: none;
	display:block;
	<?php 
	get_font_css(get_theme_mod('second_level_menu_font'));
	echo get_theme_mod('second_level_menu_links_css');
	?>
}
#main_header .menu ul.sub-menu .menu-item a:hover {
	color:<?=$second_level_menu_colors['hover'];?>;
}
#main_header .menu ul.sub-menu .menu-item:hover {
	background-color:<?=$second_level_menu_colors['hover_background'];?>;
}
<?php
/*
//	note: SUB SUB MENU
 */
?>

#main_header .menu ul.sub-menu ul.sub-menu .menu-item a {
	<?php 
	get_font_css(get_theme_mod('third_level_menu_font'));
	echo get_theme_mod('third_level_menu_links_css');
	?>
}

.mobile_menu_button {
	display: none;
}
.search_button {
	display: block;
	text-align: center;
	margin:<?=get_spacing($hiilite_options['menu_margin']);?>;
    text-align: right;
    flex: 0 1 auto; 
}
.search_button .fa {
	color: <?=$hiilite_options['mobile_menu_icon_color'];?>;
}

@media (min-width:<?=$hiilite_options['mobile_menu_switch'];?>){
	.menu li:hover > ul.sub-menu {
		display:block;
		box-shadow: 0 0 1px rgba(0,0,0,0.4);
	}
	#main_header .menu li>ul.sub-menu>li:hover>ul.sub-menu {
	    position: absolute;
	    left: 100%;
	    top: 0;
	}
	.sub-menu > .menu-item-has-children > a:after {
	    font-family: FontAwesome;
	    content: '\f105';
	    float:right;
	}
	.sub-menu > .menu-item-has-children:hover > a:after {
		content: '\f107';
	}
}
@media (max-width:<?=$hiilite_options['mobile_menu_switch'];?>){
	.menu-item-has-children:after {
	    position: absolute;
	    right: 0;
	    top: 0;
	    padding: 1em 1.5em;
	    font-family: FontAwesome;
	    content: '\f105';
	}	
	.menu-item-has-children.open:after{
		content: '\f107';
	}
	
	.mobile_menu_button {
		display: block;
		text-align: center;
		margin:<?=get_spacing($hiilite_options['menu_margin']);?>;
	    text-align: right;
	    flex: 1 1 auto;
	}
	.mobile_menu_button .fa {
		padding: 1em;
		color: <?=$hiilite_options['mobile_menu_icon_color'];?>;
	}
	#main_header #main-nav {
		position: absolute;
		top: 100%;
	    width: 100%;
	    overflow: auto;
	    display: none;
	    left:0;
	    background: <?=$hiilite_options[ 'moblie_menu_background_color' ]?>;
	}

	#main_header #main-nav .main-menu {
		display: flex;
	}

	#main_header .main-menu li {
		width: 100%;
		text-align: left;
	}
	.main-menu ul.sub-menu {
		position: relative;
		display: none;
	}
	.main-menu ul.sub-menu li {
		text-indent: 1em;
	}
	.main-menu ul.sub-menu ul.sub-menu li {
		text-indent: 2em;
	}
	
}
