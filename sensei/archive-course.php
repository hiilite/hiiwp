<?php

get_header(); 
get_template_part( 'templates/title' );
?>

<div class="courses-list row">
	<div class="in_grid">

		<?php learn_breadcrumbs(); ?>
        
	    <div class="container_inner">
            <aside class="col-3 sidebar">
                <?php dynamic_sidebar( 'sidebar-course' ); ?>
            </aside>
            <div class="col-9">
                <div class="container_inner">                
                <?php 

                while (have_posts()) : the_post();

                $s_date = get_post_meta(get_the_ID(),'_cmb_sd_course', true);

                if($s_date){
                  $date1 = new DateTime($s_date);
                }else{
                  $date1 = new DateTime(get_the_date('Y-m-d', get_the_ID()));        
                }
                
                $date2 = new DateTime(date('Y-m-d'));

                $diff = date_diff($date1,$date2);
                
                $terms = get_the_terms( $post->ID, 'course-category' );

                ?>
                <div class="col-4">
                  <div class="col-item">
                    <div class="photo">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"></a>
                        <div class="cat_row">
                          <?php if($terms) { ?>   
                            <?php foreach ( $terms as $term ) { ?>
                                <a href="<?php echo esc_url(get_term_link($term, 'course-category')); ?>"><?php echo esc_html($term->name); ?></a>
                          <?php } } ?>
                          <span class="pull-right"><i class=" icon-clock"></i><?php echo esc_html($diff->days) . esc_html__(' Days', 'learn'); ?></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="course_info col-12">
                                <h4 class="black-color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p><?php the_excerpt(); ?></p>
                                <div class="rating">
                                  <?php learn_get_rating_course(); ?>
                                </div>
                                <div class="price pull-right"><?php echo sensei_simple_course_price($post->ID); ?></div>
                            </div>
                        </div>
                        <div class="separator clearfix">
	                        <?php
		                        $wc_post_id = get_post_meta( $post->ID, '_course_woocommerce_product', true ); 
	                            if($wc_post_id > 0) { 
		                            $_product = wc_get_product( $wc_post_id );
		                            
									echo '<p class="btn-add"><a href="'.$_product->get_permalink() .'"><i class="fa fa-share"></i>';
									esc_html_e(' Subscribe','learn');
									echo '</a></p>';
	                            }
	                        ?>
                            <p class="btn-details"><a href="<?php the_permalink(); ?>"><i class="fa fa-list"></i><?php esc_html_e(' Details','learn'); ?></a></p>
                        </div>
                    </div>
                  </div>
                </div>

                <?php endwhile; ?>
            </div>

            <div class="text-center">
                <ul class="pagination">
                    <?php echo learn_pagination(); ?>
                </ul>
            </div>

            </div>
        </div>
	</div>
</div>
<!-- content close -->
<?php get_footer(); ?>