<?php
/**
 * HiiWP: Header-CSS
 *
 * Header CSS file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
if(false): ?><style><?php endif; ?>
header#main_header {
	width: 100%;
	align-items: center;
	flex-wrap: wrap;
	z-index: 100;
	transition: all 0.5s;
	<?php 
	get_background_css(Hii::$options['header_background']);
	if(Hii::$options['header_content_under'] == true)
		echo 'position: absolute;';
	else
		echo 'position: relative;';
	?>
	border-bottom: <?php echo Hii::$options['header_bottom_border_width'] . ' solid ' . Hii::$options['header_bottom_border_color'];?>;
}
<?php
if(Hii::$options['header_top_home'] == true): ?>

	#header_top_pages {<?php
		get_background_css(Hii::$options['header_top_pages_background_image']);
		echo 'height:'.Hii::$options['header_top_pages_height'].';'; ?>
	}

<?php
endif;
?>


<?php
if(Hii::$options['header_type'] == 'centered') : ?>

	header.centered, 
	header.centered .container_inner,
	header.centered .in_grid,
	header.centered .main-menu,
	#main-nav .main-menu {
		justify-content: center;
		flex-wrap: wrap;
		text-align: center;
	}
	header.centered #main-nav, header.centered .search_button {
		margin: auto 0 auto 0;
		flex: 0 1 auto;
	}
	header.centered #logo_container {
		margin: auto;
		
	}
	header.centered #main-nav {
    	width: 100%;
	}	

<?php 
elseif(Hii::$options['header_type'] == 'fixed'):	?>
	header#main_header.fixed.scrolled {
	    position: fixed;
	    top: 0;
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
else: ?>
	#main_header .container_inner, #main_header .in_grid {
	    justify-content: space-between;
	}
<?php
endif;

if(Hii::$options['header_bottom_on'] == true) : ?>

#header_bottom_left, #header_bottom_right {
	width:50%;	
}
<?php
endif;
?>

@media (max-width:<?php echo Hii::$options['grid_width'];?>){
	.container_inner {
		padding: 0em;
	}
}
<?php
if(Hii::$options['header_top_area_yesno'] == true):
	/*
	//  note: Header Top
	*/	
	$header_top_colors = get_theme_mod( 'header_top_colors' );
	?>
	#header_top {
		background: <?php echo get_theme_mod('header_top_background_color', '#f8f8f8');?>;
		border-top: <?php echo get_theme_mod('header_top_border_width', '0px').' solid '.get_theme_mod('header_top_border_color', 'transparent');?>;
		border-bottom-style: solid;
		
		<?php 
		get_font_css(Hii::$options['header_top_font']);
	?>
	}
	#header_top a,
	#header_top a .fa {
		color:<?php echo sanitize_rgba($header_top_colors['link']);?>;
	}
	#header_top a:hover{
		color:<?php echo sanitize_rgba($header_top_colors['hover']);?>;
	}
	<?php if(get_theme_mod('hide_top_bar_on_mobile_yesno') == true): ?>
	@media (max-width:<?php echo get_theme_mod('mobile_menu_switch','768px')?>){
		#header_top {
			display:none;
		}
	}
	<?php 
	endif;
endif; ?>
#main_search {
	position: relative;
	display: none;
}
#main_search input.search-field {
    width: 100%;
    text-indent: 2em;
}
#main_search:before {
    position: absolute;
    left: 0;
    top: 0;
    padding: 1em 1.5em;
    font-family: FontAwesome;
    content: '\f002';
    
}


#header_bottom {
	border-bottom-style: solid;
}
#header_bottom .menu .menu-item a{
	<?php 
	get_font_css(get_theme_mod( 'header_bottom_font' ));
	?>
}

#header_bottom .bottom-menu {
	justify-content: center;
}


#logo_container {
    max-width: 100%;
    position: relative;
    align-self: center;
    <?php 
    foreach(Hii::$options['logo_padding'] as $key=>$value){
	    echo 'padding-'.$key.':'.$value.';';
    }
    ?>
}

#logo_container img {
    height: auto;
    transition: all 0.5s;
    display:block;
}
<?php
	
?>