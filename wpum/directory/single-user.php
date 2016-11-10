<?php
/**
 * WPUM Template: single user.
 * This template is usually used within a user directory.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Prepare trimmed description
$description = get_user_meta( $user->ID, 'description', true );
$trimmed_description = wp_trim_words( $description, 100, '<a href="'. wpum_get_user_profile_url( $user ) .'"> ...'.__( 'View Profile', 'wpum' ).'</a>' );
?>

<li id="wpum-single-user-<?php echo esc_attr( $user->ID ) ?>" class="wpum-single-user">

	<a href="<?php echo wpum_get_user_profile_url( $user ); ?>"><?php echo get_avatar( $user->ID, 80 ); ?></a>

	<div class="user">
		<h3><a href="<?php echo wpum_get_user_profile_url( $user ); ?>"><?php echo $user->user_lastname.', '. $user->user_firstname; ?></a></h3>
		<div class="description">
			<?php if ( $trimmed_description ) : ?>
				<small><?php echo $trimmed_description; ?></small>
			<?php else : ?>
				<small><?php _e( 'This user has not provided a description yet.', 'wpum' ); ?></small>
			<?php endif; ?>
		</div>

		<?php do_action( 'wpum_directory_single_user', $user ); ?>

	</div>

	<div class="contact-meta">
		<?php if ( $user->wpum_phone ) : 
			 echo '<a href="tel:'.esc_attr( $user->wpum_phone ).'">'.esc_attr( $user->wpum_phone ) . '</a><br>';
		endif; ?>
		<a href="mailto:<?php echo antispambot( $user->user_email );?>"><?php echo antispambot( $user->user_email );?></a>
		<?php do_action( 'wpum_directory_single_user_contact_meta', $user ); ?>
	</div>

	<ul class="meta">
		<?php //print_r($user);?>
		<?php if ( $user->user_url ) : 
			 echo '<li>'.esc_attr( $user->wpum_board_position ) . '</li>';
		endif; ?>
		<?php if ( $user->user_url ) : ?>
		<li class="website"><a href="<?php echo esc_attr( $user->user_url ); ?>" target="_blank" rel="nofollow"><?php _e( 'Visit Website', 'wpum' );?></a></li>
		<?php endif; ?>
		<!--<li class="registration-date"><strong><?php _e( 'Registered:', 'wpum' ); ?></strong> <date><?php echo date( get_option( 'date_format' ), strtotime( $user->user_registered ) ); ?></date></li>
		<?php do_action( 'wpum_directory_single_user_meta', $user ); ?>-->
	</ul>

</li>
