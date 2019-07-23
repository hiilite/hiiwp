<?php
/**
 * HiiWP Template: portfolio-content-split
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
/*

// TODO: Make Title and feature image turn on by default in customizer	
// TODO: Add back Category image thumbnail
*/
$hiilite_options = HiiWP::get_options();
$portfolio_work_image = $portfolio_work_color = '';
$category = get_the_terms( $post->ID, 'work' );

if(is_front_page() || is_archive(  )){ 
	$page_title = get_wp_title('');
} elseif(is_home()) {
	$page_title = get_the_title( get_option('page_for_posts', true) );
} else {
	$page_title = get_the_title( get_the_id( ));
} 

$work_object = get_queried_object();
$work_id     = get_queried_object_id();
	
$page_bg = (get_post_meta ( $post->ID, 'page_bg', true))?get_post_meta ( $post->ID, 'page_bg', true):false;
$portfolio_description = (get_post_meta ( $post->ID, 'portfolio_description', true))?get_post_meta ( $post->ID, 'portfolio_description', true):false;
$portfolio_client = (get_post_meta ( $post->ID, 'portfolio_client', true))?get_post_meta ( $post->ID, 'portfolio_client', true):false;
$portfolio_images = (get_post_meta ( $post->ID, 'project_iamges', true))?get_post_meta ( $post->ID, 'project_iamges', true):false;
$contributers = (get_post_meta ( $post->ID, 'contributers_group', true))?get_post_meta ( $post->ID, 'contributers_group', true):false;
$project_share = (get_post_meta ( $post->ID, 'project_share', true))?get_post_meta ( $post->ID, 'project_share', true):false;

$social_url = esc_url( get_permalink($post->ID) );
if(is_array($category[0])):
	$portfolio_work_image = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_image', true)) ? get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_image', true) : false;
	$portfolio_work_color = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true)) ? get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true) : false;
endif;
$author_id=$post->post_author;

$tags = get_the_terms( $post->ID, 'porfolio_tag');

do_action( 'hii_before_split_portfolio' );
?>
<!--PORTFOLIO-CONTENT-SPLIT-->
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" style="<?php echo ($page_bg)?'background-color:'.$page_bg.';':'';?>">
	
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo esc_url( home_url() )?>"/>
<?php
echo '<div class="container_inner">';

echo '<div class="in_grid  align-top">';
	?>
	<span itemprop="articleSection" class="labels"><?php the_category(' '); ?></span>
	<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
	<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
	
	<!-- Gallery -->
	<div class="col-12 before-portfolio-gallery">
	    <?php
	    do_action( 'hii_before_split_portfolio_gallery' );
	    ?>
	</div>
	<div class="col-8 portfolio-gallery">
		<?php 
		do_action( 'hii_before_split_portfolio_gallery_content' );
			
		the_content();
		cmb2_output_portfolio_imgs($portfolio_images); 
		
		do_action( 'hii_after_split_portfolio_gallery_content' );	
		?>
	</div>
	<!-- Sidebar -->
	<div class="col-4 project-info">
		<?php
		echo "<dl>";
		do_action( 'hii_before_split_portfolio_sidebar_content' );	
		
		echo "	<dt>Date</dt>
				<dd><time class='time op-published' datetime='".get_the_date('c',$work_id)."'><span class='date'>".get_the_date('F jS, Y',$work_id)."</span></time></dd>";

		if($portfolio_client) {
			echo "<dt class='project-client'>Client</dt>
				<dd>{$portfolio_client}</dd>";

		}
		
		if(is_array($contributers)):
			$team = '<dt>Project Team</dt><dd>';
				foreach ( $contributers as $key => $entry ) {
				
					$role = $name = '';
				
					if ( isset( $entry['role'] ) && isset( $entry['name'] )) { 
						$team .= $entry['role'];
						$team .= ': ';
						$team .= $entry['name'];
						$team .= '<br>';
					}			
				}	
			$team .= '</dd>';
			
			echo wp_kses_post($team); // WPCS: XSS ok.
		endif;

		echo "</dl>";
		
		if($portfolio_description) {
			echo '<dt>Overview</dt>';
			echo '<dd>'.$portfolio_description.'</dd>';
			
		}
		 
		if($project_share){
			$social_share = '<dt class="project-social">'.__( 'Share', 'hiiwp' ).'</dt><dd>';
				foreach($project_share as $share) {
					if($share == 'fb') {
						$social_share .= '<a href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($social_url).'"><i class="fa fa-facebook" aria-hidden="true"></i></a>';	
					} 
					elseif($share == 'tw') {
						$social_share .= '<a href="https://twitter.com/home?status='.urlencode($social_url).'"><i class="fa fa-twitter" aria-hidden="true"></i></a>';	
					}
					elseif($share == 'gp') {
						$social_share .= '<a href="https://plus.google.com/share?url='.urlencode($social_url).'"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';	
					}
					elseif($share == 'pn') {
						$social_share .= '<a href="https://pinterest.com/pin/create/button/?url='.urlencode($social_url).'"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';	
					}
					elseif($share == 'ln') {
						$social_share .= '<a href="https://www.linkedin.com/shareArticle?mini=true&url='.urlencode(get_the_permalink(get_the_ID())).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';	
					}
				}
	
				$social_share .= '</dd>';		
			
			echo wp_kses_post($social_share); // WPCS: XSS ok.
		}
		
		 ?>
	</div>
	<div class="col-12">
		<?php
		if($hiilite_options['show_more_projects']):
		do_action( 'hii_before_split_portfolio_more_projects' );
		?>
		<div class="align-center">
			<h4>More Projects</h4>
		</div>
		<?php
		echo do_shortcode( '[portfolio portfolio_image_style="square" portfolio_show_info="true" portfolio_image_pos="image-behind" show_title="true" is_slider="true"]' );
		do_action( 'hii_after_split_portfolio_more_projects' );
		endif;
		?>
		
		<?php
		if($hiilite_options['portfolio_comments']):
		do_action( 'hii_before_split_portfolio_comments' );
		?>
			<div class="project-comments">
				<div class="container_inner">
					<?php comments_template(); ?>
				</div>
			</div>
		<?php
		do_action( 'hii_after_split_portfolio_comments' );
		endif;
		?>
	</div>

<?php		
echo '</div></div>';

echo '</article>';
do_action( 'hii_after_split_portfolio' );

