<?php
$post_id = get_the_id();
?>
<article class="flex-item text-block listing-small" id="listing-<?=get_the_ID();?>">
	<div class="listing_image">
		<figure>
			<a href="<?=get_the_permalink()?>">
			<?php the_post_thumbnail('medium');?>
			</a>
			<figcaption>
				<?php
				echo get_post_meta( $post_id, 'Building-BedroomsTotal', true ). ' Bedrooms - '. 
					 get_post_meta( $post_id, 'Building-SizeInterior', true );
				?>
			</figcaption>
		</figure>
	</div>
	
	<div class="listing_content">
		<?php
			$price = get_post_meta( $post_id, 'Price', true );
			$price = (is_numeric($price))?number_format(get_post_meta( $post_id, 'Price', true ),0):$price;
		echo '<h5><sup class="currency">$</sup> '.$price.'</h5>';
		echo '<h3><a href="'.get_the_permalink().'">'.get_post_meta( $post_id, 'Address-StreetAddress', true ).'</a></h3>';
		echo '<p class="listing-excerpt" style="overflow:hidden;height:4em;">'.get_the_excerpt().'</p>';
		echo '<p><a class="button" href="'.get_the_permalink().'">Contact Broker</a></p>';
		?>
	</div>
</article>