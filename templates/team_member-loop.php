<?php
$hiilite_options = HiiWP::get_options();
$post_meta = get_post_meta(get_the_id());
$team_member_content_layout = $hiilite_options['team_member_content_layout'];
$team_member_image_style = $hiilite_options['team_member_image_style'];
?>
<article <?php post_class('row single-team-member'); ?> id="post-<?php the_ID(); ?>" >
<?php
echo '<div class="container_inner">
	<div class="in_grid team-member-wrapper">';

	
	if(has_post_thumbnail($post->id) && $hiilite_options['team_member_show_image']): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );
	
		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
			$height = $img[2];
		
		echo "<div class='flex-item col-3 align-top'><figure class='team-member-image {$team_member_image_style}'>";
		echo "<img src='".$img[0]."' layout='responsive' width='{$width}' height='{$height}'>";
		echo "</figure></div>";
	endif; 
		
echo '<div class="team-member-content flex-item col-8 content-box">';
		if($hiilite_options['team_member_title_show'] == true) {
			$team_member_heading_tag = $hiilite_options['team_member_heading_tag'];
			echo "<{$team_member_heading_tag} class='team-member-name'><a href='".get_the_permalink()."'>".get_the_title()."</a></{$team_member_heading_tag}>";
		}
		if($hiilite_options['team_member_show_position'] == true) {
			echo "<div itemprop='articleSection' class='team-member-position'>"; 
			$terms = get_the_terms( $post->id, 'position');
			if($terms) echo $terms[0]->name;
			echo "</div>";
		}
	
		the_content();
	
echo '</div></div></article>';

$exclude = array(get_the_id());

$team = new WP_Query(
array(	'post_type'=>'team',
		'posts_per_page'=>4,
		'orderby' => 'rand',
		'post__not_in' => $exclude
	));
if($team->have_posts()):
	echo '<div class="row"><div class="container_inner">';
	echo '<div class="in_grid"><h2 class="meet-team-title">Meet the rest of the team</h2></div>';
	echo '<div class="in_grid">';
	
	while($team->have_posts()):
		$team->the_post();
		
		get_template_part('templates/team', 'loop');
		
		
	endwhile;
	//echo do_shortcode( '[hii_rotating_carousel post_type="custom" show_title="yes" show_excerpt="yes" show_btn="yes" btn_text="Read More" custom_query="post_type=team&order=ASC&orderby=rand"]' );
	echo '</div></div></div>';

endif;
echo '<div class="row"><div class="container_inner"><div class="in_grid content-box">';
echo '<a class="button full-width align-center" href="/team/">Meet the Whole Team</a>';
echo '</div></div></div>';


?>
