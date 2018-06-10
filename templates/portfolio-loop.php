<?php
/**
 * HiiWP Template: portfolio-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
global $post;
$hiilite_options = HiiWP::get_options();
$image_aspect_style = '';
$portfolio_columns = $hiilite_options['portfolio_columns'];
$portfolio_image_style = (isset($atts['portfolio_image_style']))?$atts['portfolio_image_style']:$hiilite_options['portfolio_image_style'];
$portfolio_image_pos = (isset($atts['portfolio_image_pos']))?$atts['portfolio_image_pos']:$hiilite_options['portfolio_image_pos'];
$portfolio_show_info = (isset($atts['portfolio_show_info']))?$atts['portfolio_show_info']:$hiilite_options['portfolio_show_info'];
$portfolio_heading_size = (isset($atts['portfolio_heading_size']))?$atts['portfolio_heading_size']:$hiilite_options['portfolio_heading_size'];

if(isset($is_slider) && $is_slider == true) $portfolio_columns .= ' slide';
?>
<!--PORTFOLIO-LOOP-->
<article  <?php post_class("portfolio-piece flex-item {$portfolio_columns} {$portfolio_image_pos} "); ?> id="post-<?php the_ID(); ?>" >
	<div class="portfolio-piece-wrapper"><?php
		if(has_post_thumbnail($post->id)): 
				
			$tn_id = get_post_thumbnail_id( $post->ID );
	
			$img = wp_get_attachment_image_src( $tn_id, 'large' );
			$width = $img[1];
			$height = $img[2];
			if($portfolio_image_style == 'square') {
				$image_aspect_style = ($height < $width)?'height:100%;max-width:none;width:auto;':'height:auto;';
			} 
			echo "<figure class='portfolio-piece-image flex-item {$portfolio_image_style}'>";
			echo "<a href='".get_the_permalink()."'><img src='".$img[0]."' layout='responsive' width='{$width}' height='{$height}' style='{$image_aspect_style}'></a>";
			echo "</figure>";
		endif;
		if($portfolio_show_info == true): ?>
		<div class="portfolio-piece-content flex-item content-box">
			<?php 
			if($hiilite_options['portfolio_show_post_title'] == true):
				echo "<{$portfolio_heading_size} class='portfolio-item-title'><a href='".get_the_permalink()."'>".get_the_title()."</a></{$portfolio_heading_size}>";
			endif; 
			if($hiilite_options['portfolio_show_post_meta']):
				echo "<div itemprop='articleSection' class='portfolio-item-meta'>"; 
				$terms = get_the_terms( $post->id, $hiilite_options['portfolio_tax_slug'] );
				if($terms) echo esc_html__($terms[0]->name, 'hiiwp');
				echo "</div>";
			endif;
			if($hiilite_options['portfolio_excerpt_on'] == true) echo "<p class='portfolio-item-excerpt'>".excerpt($hiilite_options['portfolio_excerpt_length'])."</p>";
			
			if($hiilite_options['portfolio_more_on'] == true) {
				echo "<div class='align-".$hiilite_options['portfolio_button_align']."'><a class='button ".$hiilite_options['portfolio_button_style']."' href='".get_the_permalink()."'>"; 
				echo esc_html__( $hiilite_options['portfolio_more_text'], 'hiiwp' );
				echo "</a></div>"; 
			}
			?>
		<div>
	</div>
<?php 
	endif; // end portfolio_show_info
echo '</article>';
