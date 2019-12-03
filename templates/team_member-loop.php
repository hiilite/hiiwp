<?php
/**
 * HiiWP Template: team-member-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
$hiilite_options = HiiWP::get_options();
$post_meta = get_post_meta(get_the_ID());
$team_member_content_layout = $hiilite_options['team_member_content_layout'];
$team_member_image_style = $hiilite_options['team_member_image_style'];
$output = '';
?>

<article <?php post_class('row single-team-member'); ?> id="post-<?php the_ID(); ?>" >
<?php
	
$output .=  '<div class="team-member-content flex-item col-9 content-box">';
		if($hiilite_options['team_member_title_show'] == true) {
			$team_member_heading_tag = $hiilite_options['team_member_heading_tag'];
			$output .=  "<{$team_member_heading_tag} class='team-member-name'><a href='".get_the_permalink()."'>".get_the_title()."</a></{$team_member_heading_tag}>";
		}
		if($hiilite_options['team_member_show_position'] == true) {
			$output .=  "<div itemprop='articleSection' class='team-member-position'>"; 
			$terms = get_the_terms( $post->id, 'position');
			if($terms) $output .=  esc_html__($terms[0]->name, 'hiiwp');
			$output .=  "</div>";
		}
	
$output .= '<div class="container_inner">
	<div class="in_grid team-member-wrapper">';

	
	if(has_post_thumbnail($post->id) && $hiilite_options['team_member_show_image']): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );
	
		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
			$height = $img[2];
		
		$output .=  "<div class='flex-item col-3 align-top'><figure class='team-member-image {$team_member_image_style}'>";
		$output .=  "<img src='".$img[0]."' layout='responsive' width='{$width}' height='{$height}'>";
		$output .=  "</figure></div>";
	endif; 
		$output .= '<div class="flex-item col-9 align-top">';
		$output .= '<div class="team-member-content">';
		ob_start();
		the_content();
		$output .= ob_get_clean();
		
		$output .='</div>';
		$output .= '</div>';	

$output .=  '</div></div></article>';


/////////////////////////
//
//	Other Team Members Slider
//
/////////////////////////


	$output .= '<aside class="col-12 text-block">';
	$output .= '<div class="in_grid">';
	$output .= '<div class="align-center teams-title"><h4>More Team Members</h4></div>';
	$output .=  do_shortcode('[teams show_image="true" show_title="true" heading_tag="h5" is_slider="true"]');
	$output .= '</div>';
	$output .= '</aside>';

//end team slider
$output .=  '<div class="row"><div class="container_inner"><div class="in_grid">';
$output .=  '<a class="button full-width align-center meet-the-team-btn" href="' . get_site_url() . '/team/">Meet the Whole Team</a>';
$output .=  '</div></div></div>';
echo __hii($output); // WPCS: XSS ok.