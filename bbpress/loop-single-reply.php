<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>



<div <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-author">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php bbp_reply_author_link( array( 'sep' => '<br />', 'show_role' => true ) ); ?>

		<?php if ( bbp_is_user_keymaster() ) : ?>

			<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

			<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

			<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>
		
		<?php do_action( 'bbp_theme_after_reply_content' ); ?>
		<span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span>
	</div><!-- .bbp-reply-content -->

	<div id="post-<?php bbp_reply_id(); ?>" class="bbp-reply-header">
	
		<div class="bbp-meta">
	
			
	
			<?php if ( bbp_is_single_user_replies() ) : ?>
	
				<span class="bbp-header">
					<?php _e( 'in reply to: ', 'bbpress' ); ?>
					<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
				</span>
	
			<?php endif; ?>
	
			<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>
	
			<?php bbp_reply_admin_links(); ?>
	
			<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
	
		</div><!-- .bbp-meta -->

	</div><!-- #post-<?php bbp_reply_id(); ?> -->
</div><!-- .reply -->
