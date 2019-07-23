<?php
/**
 * HiiWP Template: team-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
global $post;
$hiilite_options = HiiWP::get_options();
$teams_cols = $hiilite_options['teams_cols'];
$teams_image_style = $hiilite_options['teams_image_style'];
$teams_image_position = $hiilite_options['teams_image_position'];

$max_width = 'none';
switch($teams_cols){
	case 'col-3':
		$max_width = '275px'; break;
	case 'col-4':
		$max_width = '366px'; break;
	case 'col-6':
		$max_width = '550px'; break;
	case 'col-2':
		$max_width = '183px'; break;
}
if(isset($is_slider) && $is_slider == true) $teams_cols .= ' slide';
?>
<article  <?php post_class("team-member flex-item {$teams_cols} {$teams_image_position}"); echo "style='max-width:{$max_width};'"; ?> id="post-<?php the_ID(); ?>" >
	<div class="team-member-wrapper">
		<?php 
		if(has_post_thumbnail($post->id) && $hiilite_options['teams_show_image']): 
				
			$tn_id = get_post_thumbnail_id( $post->ID );
	
			$img = wp_get_attachment_image_src( $tn_id, 'large' );
			$width = $img[1];
			$height = $img[2];
			$css_height = ($height < $width)?'100%;max-width:none;width:auto':'auto';
			echo "<figure class='team-member-image flex-item {$teams_image_style}'>";
			echo "<a href='".get_the_permalink()."'><img src='".$img[0]."' layout='responsive' width='{$width}' height='{$height}' style='height:{$css_height};'></a>";
			echo "</figure>";
		endif; // end if has_post_thumbnail ?>
		<div class="team-member-content flex-item content-box">
			<?php
			if($hiilite_options['teams_title_show'] == true) {
				$teams_heading_tag = $hiilite_options['teams_heading_tag'];
				echo "<{$teams_heading_tag} class='team-member-name'><a href='".get_the_permalink()."'>".get_the_title()."</a></{$teams_heading_tag}>";
			}
			if($hiilite_options['teams_show_position'] == true) {
				echo "<div itemprop='articleSection' class='team-member-position'>"; 
				$terms = get_the_terms( $post->id, $hiilite_options['team_tax_slug'] );
				if($terms) echo esc_html__($terms[0]->name, 'hiiwp');
				echo "</div>";
			}
			if($hiilite_options['teams_show_excerpt'] == true) echo "<p class='team-member-excerpt'>".excerpt(30)."</p>";
				
			if($hiilite_options['teams_show_button'] == true) {
				echo "<a class='button ".$hiilite_options['teams_button_style']."' href='".get_the_permalink()."'>"; 
				echo esc_html__($hiilite_options['teams_button_text'], 'hiiwp');
				echo "</a>";
			}	
			?>
		
		<div>
	</div>
</article>
<?php
	
?>