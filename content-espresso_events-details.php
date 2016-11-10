<?php
//echo '<br/><h6 style="color:#2EA2CC;">'. __FILE__ . ' &nbsp; <span style="font-weight:normal;color:#E76700"> Line #: ' . __LINE__ . '</span></h6>';
global $post;
?>
<div class="event-content">
<?php
	if ( apply_filters( 'FHEE__content_espresso_events_details_template__display_the_content', true ) ) {
		do_action( 'AHEE_event_details_before_the_content', $post );
		apply_filters( 'FHEE__content_espresso_events_details_template__the_content', espresso_event_content_or_excerpt() );
		do_action( 'AHEE_event_details_after_the_content', $post );
	}
 ?>
 <?php if ( apply_filters( 'FHEE__content_espresso_events_details_template__display_entry_meta', TRUE )): ?>
	<div class="entry-meta">
		<span class="tags-links"><?php espresso_event_categories( $post->ID, TRUE, TRUE ); ?></span>
	<?php
		edit_post_link( __( 'Edit', 'event_espresso' ), '<span class="edit-link">', '</span>' );
	?>
	</div>
<?php endif;
	$event_phone = espresso_event_phone( $post->ID, FALSE );
	if ( $event_phone != '' ) : ?>
	<p>
		<span class="small-text"><strong><?php _e( 'Event Phone:', 'event_espresso' ); ?> </strong></span> <?php echo $event_phone; ?>
	</p>
<?php endif;  ?>
</div>
<!-- .event-content -->
