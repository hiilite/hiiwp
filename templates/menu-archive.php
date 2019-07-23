<?php
/* HiiWP Template: menu-archive
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
$hiilite_options = Hii::$hiiwp->get_options();
if(have_posts()):
	$sections = get_terms('menu-section', array('parent' => 0));
	$menu_html = '';
	$nav_html = '';
	foreach($sections as $section){
		$nav_html .= '<li class="menu-item"><a href="#menu_section_'.$section->slug.'" class="">'.$section->name.'</a></li>';
		$menu_html .= '<section class="row vc_row-has-fill" id="menu_section_'.$section->slug.'">
				<div class="text-block align-center">
					<h1><a href="/menu-section/'.$section->slug.'">'.$section->name.'</a></h1>
				</div>
			</section>';
		
		$sectionoutput = do_shortcode('[menu section="'.$section->slug.'"]');
		if($sectionoutput !== '') {
			$menu_html .= '<div class="row"><div class="container_inner"><div class="in_grid align-top">';	
				$menu_html .= '<div class="flex-item text-block ">';
				$menu_html .= do_shortcode('[menu section="'.$section->slug.'"]');
				$menu_html .= '</div>';
			$menu_html .= '</div></div></div>';
		}
		$menu_html .= '<div class="row"><div class="container_inner"><div class="in_grid align-top">';	
		$children = get_terms('menu-section', array('parent' => $section->term_id));
		foreach($children as $child){
			$menu_html .= '<div class="col-9">';
			$menu_html .= do_shortcode('[menu section="'.$child->slug.'"]');
			$menu_html .= '</div>';
		}
		$menu_html .= '</div></div></div>';
	}
	echo '<nav class="anchor_menu"><ul class="menu main-menu align-center">'.$nav_html.'</ul></nav>';
	echo wp_kses_post($menu_html); // WPCS: XSS ok.
	
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	echo '<div class="flex-item align-center text-block">';
	echo '<h4>Share Menu</h4>';
	echo do_shortcode('[social-share gp="true" fa="true" tw="true" pt="true" li="true" em="true"]');
	echo '</div>';
	echo '</div></div></div>';

endif;
