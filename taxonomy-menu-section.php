<?php 
/*
*
*	Taxonomy - Secton
*	For use with restaurant menu sections
*	
*/	
get_header();
//get_template_part( 'templates/title' );
$term =	$wp_query->queried_object;
if(have_posts()):
if($term->parent == 0){
echo '<section class="row vc_row-has-fill">
				<div class="text-block align-center">
					<h1>'.$term->name.'</h1>
				</div>
			</section>';
			}
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
		
		echo '<div class="flex-item align-top">';
		echo do_shortcode('[menu section="'.$term->slug.'"]');
		echo '</div>';
	echo '</div></div></div>';	
	
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
		$children = get_terms('menu-section', array('parent' => $term->term_id));
		foreach($children as $child){
			echo '<div class="flex-item align-top text-block">';
			echo do_shortcode('[menu section="'.$child->slug.'"]');
			echo '</div>';
		}
	
	
	echo '</div></div></div>';

	echo '<div class="row"><div class="container_inner"><div class="in_grid align-top">';
	echo '<div class="flex-item align-center text-block">';
	echo '<h4>Share '.$term->name.' Menu</h4>';
	echo do_shortcode('[social-share gp="true" fa="true" tw="true" pt="true" li="true" em="true"]');
	echo '</div>';
	echo '</div></div></div>';
	
endif;
echo '<div class="row"><div class="container_inner"><div class="in_grid">';
echo '<div class="flex-item align-center">';
echo '<a class="button" href="/menu/">Back to Menu</a>';
echo '</div></div></div>';
get_footer(); ?>