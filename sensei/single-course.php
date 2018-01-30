<?php
/**
 * The Template for displaying all single courses.
 *
 * Override this template by copying it to yourtheme/sensei/single-course.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */

  
get_header();
global $post, $woothemes_sensei; 

add_action( 'before_page_title', 'add_course_to_title');
function add_course_to_title(){
	echo  '<h4 class="white">Course<h4>';
}

get_template_part( 'templates/title' );
	  ?>

<article <?php post_class( array( 'course', 'post', 'row' ) ); ?>>

    <section class="entry fix in_grid">



            <div class="col-8">
                <?php

                /**
                 * Hook inside the single course post above the content
                 *
                 * @since 1.9.0
                 *
                 * @param integer $course_id
                 *
                 * @hooked Sensei()->frontend->sensei_course_start     -  10
                 * @hooked Sensei_Course::the_title                    -  10
                 * @hooked Sensei()->course->course_image              -  20
                 * @hooked Sensei_WC::course_in_cart_message           -  20
                 * @hooked Sensei_Course::the_course_enrolment_actions -  30
                 * @hooked Sensei()->message->send_message_link        -  35
                 * @hooked Sensei_Course::the_course_video             -  40
                 */
				
                do_action( 'sensei_single_course_content_inside_before' );
                
                
                ?>

                <article <?php post_class( array( 'course', 'post' ) ); ?>>

                    
                    <?php
	                remove_action( 'sensei_single_course_content_inside_before', array( 'Sensei_Course', 'the_progress_statement' ), 15 );
					the_content(  );
                    /**
                     * @hooked Sensei()->course->the_progress_statement - 15
                     * @hooked Sensei()->course->the_progress_meter - 16
                     */
                     ?>

                </article><!-- .post -->

                
            </div>
            <aside class="col-4 sidebar"><?php 
                $s_date = get_post_meta(get_the_ID(),'_cmb_sd_course', true); 
                if ( ! current_user_can('administrator') && $s_date < date('Y-m-d')) do_action( 'learn_course_single_btncart' );
                
                $checkout = new Sensei_Course(); $checkout->the_course_enrolment_actions(); 
	                
	                
	            
	            do_action( 'learn_course_single_meta' );
                do_action( 'sensei_single_course_content_inside_after', get_the_ID() ); 
                    
	            /*
	            // TODO: Tie into Cusomizer to toggle on/off
	            */ 
	            $show_course_sidebar = false;
	            if($show_course_sidebar):
                ?>
				
                <div class="box_style_1 widget">
                    <h4><?php esc_html_e('Lessons', 'learn'); ?> 
                        <span class="pull-right">
                            <?php if( empty( $course_id ) ){
                                global $post;
                                $course_id = $post->ID;
                            } 
                                echo count( Sensei()->course->course_lessons( $course_id ) );
                            ?>
                        </span>
                    </h4>
                    <h4><?php esc_html_e('Time', 'learn'); ?> <span class="pull-right"><?php echo learn_lesson_length(); esc_html_e(' minutes', 'learn'); ?></span></h4>
            
                    <h4><?php esc_html_e('Rates', 'learn'); ?> 
                        <span class="pull-right rating_2">
                            <?php learn_get_rating_course(); ?>
                        </span>
                    </h4>

                    <h4><?php esc_html_e('Single Purchase', 'learn'); ?> 
                        <span class="pull-right">
                            <?php 
                                $wc_post_id = get_post_meta( $post->ID, '_course_woocommerce_product', true ); 
	                            if($wc_post_id > 0) { 
		                            $_product = wc_get_product( $wc_post_id );
	                            	echo '$ '.$_product->get_price(); 
	                            }?>
                        </span>
                    </h4><br>
                    <?php 
                        $teachers = get_userdata( absint( get_post()->post_author ) );
                        if( $teachers ) {
                    ?>
                    <h4><?php esc_html_e('Speakers', 'learn'); ?></h4>
                    
                    <div class="media">      
                        <div class="pull-right">
                            <?php echo get_avatar($teachers,'68') ?>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <a href="<?php echo esc_url( home_url( '/author/' . $teachers->user_login ) ); ?>">
                                    <?php echo esc_html($teachers->display_name); ?>
                                </a>
                            </h5>
                            <p>
                                <?php echo esc_html(substr($teachers->description, 0, 90)) . '...'; ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                                             
                </div>
                <div class="box_style_1 legend widget">
                    <h4><?php esc_html_e('Legend', 'learn'); ?> </h4>
                    <ul class="legend_course">
                          <li id="tostart"><?php esc_html_e( 'Still to start', 'learn' ); ?></li>
                          <li id="completed"><?php esc_html_e( 'Completed', 'learn' ); ?></li>
                     </ul>
                </div>
                <?php
	             endif; // End show_course_sidebar
	             
	             
                    $related = new WP_Query(
                        array(
                            'post_type'           => 'course',
                            'posts_per_page'      => 5,
                            'ignore_sticky_posts' => 1,
                            'no_found_rows'       => 1,
                            'order'               => 'rand',
                            'post__not_in'        => array( $post->ID ),
                            'tax_query'           => array(
                                'relation' => 'OR',
                                array(
                                    'taxonomy' => 'course-category',
                                    'field'    => 'term_id',
                                    'terms'    => learn_get_related_terms( 'course-category', $post->ID ),
                                    'operator' => 'IN',
                                )
                            ),
                        )
                    );
                ?>
                <?php if ( $related->have_posts() ) : ?>
                <div class="box_style_1 related-course widget">
                    <h4><?php esc_html_e( 'Related Content', 'learn' ); ?></h4>
                    <ul class="list_1">
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                            
                      <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                        
                    <?php endwhile; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </aside>
       
			<?php do_action('sensei_pagination'); ?>
    </section>
	
</article><!-- .post .single-course -->

<?php get_footer(); ?>