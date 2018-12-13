<?php
/**
 * HiiWP: Menu-CSS
 *
 * Menu CSS file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.1
 */
if(false): ?><style><?php endif; 

$main_menu_colors = Hii::$options['main_menu_colors'];
$second_level_menu_colors = Hii::$options['second_level_menu_colors'];	
$third_level_menu_colors = Hii::$options['third_level_menu_colors'];
?>
/* Bootstrap Compatibility */
.navbar {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: flex-end;
 <?php 
	// TODO: Add option to add padding around .navbar
	// padding: $navbar-padding-y $navbar-padding-x;  
?>
}
.navbar > .container,
.navbar > .container-fluid {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}

.navbar-nav,
.main-menu.menu, 
#header_top .menu, 
#header_bottom .menu {
	list-style: none;
	padding: 0;
	margin: 0;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}

.navbar-nav .dropdown-menu {
	position: static;
	float: none;
}

.navbar-text,
.nav-link {
  display: inline-block;
}

.navbar-collapse {
  flex-basis: 100%;
  flex-grow: 1;
  align-items: center;
  display: flex;
}
/* END Bootstrap Compatibility */

#main-nav {
	margin:<?php echo get_spacing(Hii::$options['menu_margin']);?>;
}

#footer-nav .menu {
    display: flex;
    justify-content: space-evenly;
}
.menu .menu-item  {
	position: relative;
	cursor: pointer;
}
#main_header .menu .menu-item a {
	text-decoration: none;
	display:block;
	<?php 
	echo get_font_css(Hii::$options['main_menu_font']);
	echo Hii::$options['main_menu_links_css'];?>
}
#main_header .menu .menu-item .fa {
	color: <?php echo Hii::$options['main_menu_font']['color']; ?>;
}

#main_header .menu li:hover {
	background: <?php echo sanitize_rgba($main_menu_colors['hover_background']);?>;
}
#main_header .menu .current-menu-item a {
	color:<?php echo sanitize_rgba($main_menu_colors['active']);?>;
}
#main_header .menu li:hover a,
#main_header .menu li:hover .fa {
	color:<?php echo sanitize_rgba($main_menu_colors['hover']);?>;
}

#main-nav .main-menu, 
#header_top .menu {
	<?php echo get_justify_content(Hii::$options['main_menu_align']); ?>
}
.left-menu {
	<?php echo get_justify_content(Hii::$options['left_menu_align']); ?>
}
.right-menu {
	<?php echo get_justify_content(Hii::$options['right_menu_align']); ?>
}
.bottom-menu {
	<?php echo get_justify_content(Hii::$options['bottom_menu_align']); ?>
}

<?php
/*
//	note: SUB MENU
 */
?>
ul.sub-menu {
	background: none;
}
#main_header ul.sub-menu,
#header_top ul.sub-menu {
    position: absolute;
    margin-left: 0;
    list-style: none;
    padding: 0;
    display: block !important;
	min-width: 12em;
	transition: all 250ms;
    background-color: #ffffff;
    transform: scaleY(0) rotateY(90deg);
    transform-origin: top left;
    opacity: 0;
	z-index: 10; 
	background-color: <?php echo Hii::$options['dropdown_background_color'];?>;
}
#main_header ul.sub-menu ul.sub-menu,
#header_top ul.sub-menu ul.sub-menu {
	left:100%;
    top: 0;
}

#main_header .menu ul.sub-menu .menu-item a,
#header_top .menu ul.sub-menu .menu-item a {
	text-decoration: none;
	display:block;
	<?php 
	echo get_font_css(get_theme_mod('second_level_menu_font'));
	echo get_theme_mod('second_level_menu_links_css');
	?>
}
#main_header .menu ul.sub-menu .menu-item a:hover,
#header_top .menu ul.sub-menu .menu-item a:hover {
	color:<?php echo sanitize_rgba($second_level_menu_colors['hover']);?>;
}
#main_header .menu ul.sub-menu .menu-item:hover,
#header_top .menu ul.sub-menu .menu-item:hover {
	background-color:<?php echo sanitize_rgba($second_level_menu_colors['hover_background']);?>;
}
<?php
/*
//	note: SUB SUB MENU
 */
?>

#main_header .menu ul.sub-menu ul.sub-menu .menu-item a {
	<?php 
	echo get_font_css(get_theme_mod('third_level_menu_font'));
	echo get_theme_mod('third_level_menu_links_css');
	?>
}
#main_header .menu ul.sub-menu ul.sub-menu .menu-item a:hover {
	color:<?php echo sanitize_rgba($third_level_menu_colors['hover']);?>;
}
#main_header .menu ul.sub-menu ul.sub-menu .menu-item:hover {
	background-color:<?php echo sanitize_rgba($third_level_menu_colors['hover_background']);?>;
}

.mobile_menu_button {
	display: none;
}
.search_button {
	display: inline-flex;
	text-align: center;
	font-size: 1rem;
	margin:<?php echo get_spacing(Hii::$options['menu_margin']);?>;
    text-align: right;
    flex: 0 1 auto; 
}
.search_button .fa {
	color: <?php echo Hii::$options['mobile_menu_icon_color'];?>;
}

@media (min-width:<?php echo Hii::$options['mobile_menu_switch'];?>){
	#main_header .menu li:hover > ul.sub-menu,
	#header_top .menu li:hover > ul.sub-menu {
		box-shadow: 0 0 1px rgba(0,0,0,0.4);
	    transform: scaleY(1) rotateY(0deg);
		opacity: 1;
	}
	#main_header .sub-menu > .menu-item-has-children > a:after {
	    font-family: FontAwesome;
	    content: '\f105';
	    float:right;
	    transition: transform 0.4s;
	}
	#main_header .sub-menu > .menu-item-has-children:hover > a:after {
		transform: rotate(90deg);
	}
}
@media (max-width:<?php echo Hii::$options['mobile_menu_switch'];?>){
	#main_header ul.sub-menu,
	#header_top ul.sub-menu {
		height: 0;
		position: relative;
	}
	#main_header .menu li.open > ul.sub-menu {
		box-shadow: 0 0 1px rgba(0,0,0,0.4);
	    transform: scaleY(1) rotateY(0deg);
		opacity: 1;
		left:0;
		height: auto;
	}
	.menu-item-has-children:after {
	    position: absolute;
	    right: 0;
	    top: 0;
	    padding: 1em 1.5em;
	    font-family: FontAwesome;
	    content: '\f105';
	    transition: transform 0.4s;
	}	
	.menu-item-has-children.open:after{
		transform: rotate(90deg);
	}
	
	.mobile_menu_button {
		display: block;
		text-align: center;
		margin:<?php echo get_spacing(Hii::$options['menu_margin']);?>;
	    text-align: right;
	    flex: 1 1 auto;
	}
	.mobile_menu_button .fa {
		padding: 1em;
		color: <?php echo Hii::$options['mobile_menu_icon_color'];?>;
	}
	#main_header #main-nav {
		position: absolute;
		top: 100%;
	    width: 100%;
	    overflow: visible;
	    display: none;
	    left:0;
	    background: <?php echo Hii::$options[ 'moblie_menu_background_color' ]?>;
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
