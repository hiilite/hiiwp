<?php
$post_id = get_the_id();
$options = get_option('company_options');
extract(  array(
      'section'			=> 'all',
      'show_image'		=> false,
      'show_title'		=> false,
      'show_rating'		=> true,
      'heading_tag'		=> 'h3',
      'height'			=> '500px',
      'image_style'		=> 'none',
      'image_position'	=> 'above',
      'is_slider'		=> false,
      'slider_speed'		=> 5000,
      "css"  		=> "",
   ) );
$output = '';
$output .= '<div itemscope itemtype="http://schema.org/Review" class="testimonial_item row container_inner"><div class="flex-item  align-center">
	  <div itemprop="itemReviewed" itemscope itemtype="http://schema.org/'.$options['business_type'].'">';
	  
// image
if($show_image){
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'medium' );
	$output .= '<'.$_amp.'img src="'.$image[0].'" itemprop="image" class="'.$image_style.' testimonial_image" width="'.($image[1]).'" height="'.($image[2]).'" alt="'.get_the_title().'">';
	if($hiilite_options['amp'])$output .= '</amp-img>';
}

$output .=	'<meta itemprop="name" content="'.$options['business_name'].'"></div>';

// rating
$output .= '<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="testimonial_rating">
	    <meta itemprop="ratingValue" content="'.get_post_meta($post_id, 'testimonial_rating', true).'">';
if($show_rating){
	for($i=1;$i <= get_post_meta($post_id, 'testimonial_rating', true); $i++){
		$output .= '<i class="fa fa-star"></i>';
	}
}
$output .= '</div>';

// title
if($show_title)$output .= '<'.$heading_tag.' class="testimonial_title"><span itemprop="name">'.get_the_title().'</span></'.$heading_tag.'>';
	  
// content
$output .= '<div itemprop="reviewBody" class="testimonial_content text-block">'.get_the_content().'</div>';
	  
// author
$output .= '<span itemprop="author" itemscope itemtype="http://schema.org/Person">
	    <span itemprop="name" class="testimonial_author">'.get_post_meta($post_id, 'testimonial_author', true).'</span>
	  </span>';
  
// publisher info
$output .= '<div itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="'.$options['business_name'].'"></div>';

//End item
$output .= '</div></div><div class="align-center text-block"></div>';

echo $output;
?>