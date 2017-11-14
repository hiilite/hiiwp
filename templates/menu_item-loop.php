<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
	?>
	<article  <?php post_class('row blog-article'); ?> id="post-<?php the_ID(); ?>" >
		<div class="in_grid">
	<?php
	echo '<div class="container_inner">';

	
	if(has_post_thumbnail($post->id)): 
		
		$tn_id = get_post_thumbnail_id( $post->ID );
	
		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
			$height = $img[2];
		?>
		<figure class="flex-item third-width align-top">
			<img src='<?php echo $img[0];?>' layout='responsive' width='<?php echo $width?>' height='<?php echo $height?>'>
		</figure>
	<?php endif; 
		
	echo '<div class="twothird-width content-box">';
	if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on'){
		?>
		<span itemprop="articleSection" class="labels"><a rel="category tag"><?php 
			$terms = get_the_terms( $post->id, 'menu-section');
			if($terms){ echo '<a href="/menu-section/'.$terms[0]->slug.'">'.$terms[0]->name.'</a>'; }
		?></a>
		<?php
		echo '<h1>';
		the_title();
		echo '</h1>';
	}
	$output = '';
	$post_id = get_the_id();
    $output .= '<span class="menu-item">';
    $output .= '<br>';
    $output .= '<span class="menu-ingredients">'.get_post_meta($post_id, 'ingredients', true).'</span>';
    $output .= ' = ';
    $output .= '<span class="menu-price">'.get_post_meta($post_id, 'price', true).'</span>';
    $output .= '<br>';
   
	if(get_post_meta($post_id, 'addons', true)){
	    $output .= '<table><tr>';
	    $output .= '<td class="menu-addons-title flex-item col-2">Add Ons:</td>';
	    $output .= '<td class="menu-addons"><table class="full-width">';
	    
	    $entries = get_post_meta( get_the_ID(), 'addons', true );
		foreach ( (array) $entries as $key => $entry ) {
		    $title = $desc = '';
		
		    if ( isset( $entry['addons_text'] ) )
		        $title = esc_html( $entry['addons_text'] );
		
		    if ( isset( $entry['addons_price'] ) )
		        $desc = esc_html( $entry['addons_price'] );
			
			$output .= '<tr><td>'.$title.'</td><td>'.$desc.'</td></tr>';
		   
		    // Do something with the data
		}
	    $output .= '</table></td></tr></table>';
	}
    $output .= '</span>';
     echo $output;
	if(has_excerpt($post->id)){
		the_excerpt();
	}

	echo '</div>';

	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	the_content();
	
	echo '</div></div></div>';
	
	
	echo '</div>';
	echo '</article>';


	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	echo '<div class="flex-item text-block align-center">';
	echo '<h4>Share this meal</h4>';
	echo do_shortcode('[social-share gp="true" fa="true" tw="true" pt="true" li="true" em="true"]');
	
	echo '</div>';
	echo '</div></div></div>';
	
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	
	echo '<div class="flex-item text-block col-9">';
	echo '<h2 class="full-width align-center">More from the '.$terms[0]->name.' menu</h2>';
	echo do_shortcode('[menu section="'.$terms[0]->slug.'" show_title="false"]');
	echo '</div>';
	echo '</div></div></div>';


	echo '<div class="row"><div class="container_inner"><div class="in_grid content-box">';
	echo '<a class="button full-width align-center" href="/menu/">See Whole Menu</a>';
	echo '</div></div></div>';

endif;
?>
