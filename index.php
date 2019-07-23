<?php 
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage hiiwp
 * @since 1.0
 * @version 1.0
 */
get_header();
get_template_part( 'templates/title' );
if(have_posts()):
	while(have_posts()):
		the_post();
		?><section  <?php post_class('row'); ?> id="post-<?php the_ID(); ?>" >
		<div class="in_grid">
		<div class="<?php echo (!$vc_enabled)?'content-box':'container_inner';?>">
<?php 
				
			the_content();
 ?>
		</div>
	</div>
</section> <?php
		
	endwhile;
endif;

	 
get_footer(); ?>