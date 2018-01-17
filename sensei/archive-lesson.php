<?php
/**
 * The Template for displaying lesson archives, including the lesson page template.
 * This template also handels the lesson modules taxonomy and the lessons_tag taxonomy.
 *
 * Override this template by copying it to your_theme/sensei/archive-lesson.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */

get_sensei_header();  
	
	
	get_template_part( 'templates/title' );	

        /**
         * Action before lesson archive loop. This action runs within the archive-lesson.php.
         *
         * It will be executed even if there are no posts on the archive page.
         */
        do_action( 'sensei_archive_before_lesson_loop' );

    ?>
<section class="entry fix in_grid">
    <?php if ( have_posts() ): ?>

        <?php sensei_load_template( 'loop-lesson.php' ); ?>

    <?php else: ?>

        <p><?php _e( 'No lessons found that match your selection.', 'learn' ); ?></p>

    <?php  endif; // End If Statement ?>

    <?php

        /**
         * Action after lesson archive  loop on the archive-lesson.php template file
         * It will be executed even if there are no posts on the archive page.
         *
         * @since 1.9.0
         */
        do_action( 'sensei_archive_after_lesson_loop' );
    ?>
</section>
<?php get_sensei_footer(); ?>
