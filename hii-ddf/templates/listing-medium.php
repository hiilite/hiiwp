<?php
$post_id = get_the_id();

// Add Lat Long if does not exist (fix for legacy listings that did not start with Lat Long)

if(get_post_meta( $post_id, 'Address-Latitude', true ) == ''){
	$data_arr = HiiDdf::geocode(get_the_title());
	if($data_arr){
		update_post_meta($post_id, 'Address-Latitude', $data_arr[0]);
		update_post_meta($post_id, 'Address-Longitude', $data_arr[1]);
	}
}
?>
<article class="listing_container listing-medium" id="listing-<?=get_the_ID();?>" itemscope itemtype="http://schema.org/Place">
	<div class="listing_image listing_thumb">
		<figure>
			<a href="<?=get_the_permalink()?>">
			<?php the_post_thumbnail('medium');?>
			</a>
		</figure>
	</div>
	<div class="listing_content listing_info">
		<h5 class="listing_title">
			<a target="_blank" href="<?=get_the_permalink()?>" title="<?=get_post_meta( $post_id, 'Address-StreetAddress', true )?>" itemscope=""><?=get_post_meta( $post_id, 'Address-StreetAddress', true )?> </a>
		</h5>
		<?php 
			$price = get_post_meta( $post_id, 'Price', true );
				$price = (is_numeric($price))?number_format(get_post_meta( $post_id, 'Price', true ),0):$price;
			 ?>
		<div class="text-block">
			<?php
			echo '<h5><strong><span class="currency">$</span> '.$price.'</strong></h5>';		
			echo '<p>
				<span style="text-transform:uppercase">'.get_post_meta( $post_id, 'PropertyType', true ).' '.get_post_meta( $post_id, 'Building-Type', true ).'</span><br>'.
				get_post_meta( $post_id, 'Address-City', true ).'<br>'.
				'bed: '.get_post_meta( $post_id, 'Building-BedroomsTotal', true ).' / bath: '.get_post_meta( $post_id, 'Building-BathroomTotal', true ).' / area: ';
				
			echo (!is_array(get_post_meta( $post_id, 'Building-SizeInterior', true )))?
					get_post_meta( $post_id, 'Building-SizeInterior', true ):
					get_post_meta( $post_id, 'Land-SizeTotalText', true );
			echo '</p>';
			echo '<a class="button button-primary" target="_blank" href="'.get_the_permalink().'">See Listing</a>';
			?>
		</div>
	</div>
</article>
