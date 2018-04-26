<?php
/*

	TODO:
	-	Make Title and feature image turn on by default in customizer	
*/
$hiilite_options = Hii::$hiiwp->get_options();
$post_meta = get_post_meta(get_the_id());
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
     
$portfolio_work_image = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_image', true))?get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_image', true):false;
$portfolio_work_color = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true))?get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true):false;

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
		
		<?php
		if($hiilite_options['show_more_projects']):
		do_action( 'hii_before_split_portfolio_more_projects' );
		?>
			<div class="project-comments">
				<div class="align-center">
					<h4>More Projects</h4>
				</div>
				<?php
				$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
				$args = array('post_type'=>$slug,'posts_per_page'=> '10','nopaging'=>true,'order'=>'ASC','orderby'=>'rand');
				$query = new WP_Query($args);
				?>
				
				<amp-carousel height="300" layout="fixed-height" type="carousel" class="carousel">
				<div class="carousel-wrapper">
			      <?php
				while($query->have_posts()):
					$query->the_post();
					if ( has_post_thumbnail() ) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
						$hratio = (300 / $image[2]);
					?>
				<a href="<?php echo get_the_permalink()?>" class="slide">
			    	<img src="<?php echo $image[0]?>" width="<?php echo $image[1]*$hratio?>" height="<?php echo $image[2]*$hratio?>" alt="<?php echo get_the_title()?>">
 				</a>
			  <?php
				  	}
				  endwhile;
				  ?>
				</div>
				</amp-carousel>
			</div>
		<?php
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
	
	<!-- Sidebar -->
	<div class="col-2 project-info">
		<?php
		do_action( 'hii_before_split_portfolio_sidebar_content' );	
		
		do_action( 'hii_split_portfolio_sidebar_title', array($page_title,$portfolio_work_image,$portfolio_work_color) );	

		if($portfolio_client) {
			do_action( 'hii_split_portfolio_sidebar_client', $portfolio_client );
		}
		
		do_action( 'hii_split_portfolio_sidebar_date', array(get_the_date('c',$work_id),get_the_date('F jS, Y',$work_id)) );
		
		do_action( 'hii_split_portfolio_sidebar_tags', $tags);
		
		do_action( 'hii_split_portfolio_sidebar_team', $contributers);
		
		
		if($project_share){
			$social_share = '<div class="row project-social">
				<div>';
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
	
				$social_share .= '</div>';
				$social_share .= '<div>'.__( 'Appreciate and Share', 'hiiwp' ).'</div>
			</div>';		
			
			echo $social_share;
		}
		
		do_action( 'hii_split_portfolio_sidebar_about', array($author_id, $portfolio_description));
		
		do_action( 'hii_after_split_portfolio_sidebar_content' ); ?>
	</div>
	
	



	
		
	
		
<?php		
echo '</div></div>';

echo '</article>';
do_action( 'hii_after_split_portfolio' );
?>
