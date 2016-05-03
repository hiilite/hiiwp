<?php get_header();
get_template_part( 'templates/title' );
if(have_posts()):
	$sections = get_terms('menu-section', array('parent' => 0));
	foreach($sections as $section){
		echo '<section class="row vc_row-has-fill ">
				<div class="text-block align-center">
					<h1><a href="/menu-section/'.$section->slug.'">'.$section->name.'</a></h1>
				</div>
			</section>';
		
		echo '<div class="row"><div class="container_inner"><div class="in_grid align-top">';	
			echo '<div class="flex-item text-block ">';
			echo do_shortcode('[menu section="'.$section->slug.'"]');
			echo '</div>';
		echo '</div></div></div>';
		
		echo '<div class="row"><div class="container_inner"><div class="in_grid align-top">';	
		$children = get_terms('menu-section', array('parent' => $section->term_id));
		foreach($children as $child){
			echo '<div class="col-9">';
			echo do_shortcode('[menu section="'.$child->slug.'"]');
			echo '</div>';
		}
		echo '</div></div></div>';
	}
	
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	echo '<div class="flex-item align-center text-block">';
	echo '<h4>Share Menu</h4>';
	echo do_shortcode('[social-share gp="true" fa="true" tw="true" pt="true" li="true" em="true"]');
	echo '</div>';
	echo '</div></div></div>';

endif;
get_footer(); ?>