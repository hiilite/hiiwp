<?php
/**
* Hii Shortcodes
*/
add_filter('the_posts', 'conditionally_add_scripts_and_styles'); // the_posts gets triggered before wp_head
function conditionally_add_scripts_and_styles($posts){
	if (empty($posts)) return $posts;
 
	$shortcode_found = false; // use this flag to see if styles and scripts need to be enqueued
	foreach ($posts as $post) {
		if (stripos($post->post_content, 'hiicss') !== false) {
			// enqueue here
			add_filter('custom_css', function() use ($post){ 
				preg_match_all("/(hiicss)=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/", $post->post_content, $output_array);
				
				foreach($output_array[2] as $set){
					print_r( $set );
				}
			}, 1);
			
		}
		
		if(stripos($post->post_content, 'screen-showcase') !== false) {
			add_filter('custom_css', function() use ($post){ 
				preg_match_all("/screen-showcase\s(imac_image=[\"']?((?:.(?![\"']))+.)[\"']\s?)?(macbook_image=[\"']?((?:.(?![\"']))+.)[\"']\s?)?(ipad_image=[\"']?((?:.(?![\"']))+.)[\"']\s)?(iphone_image=[\"']?((?:.(?![\"']))+.)[\"'])?/", $post->post_content, $output_array);
				
				
				$imac 		= 	wp_get_attachment_image_src($output_array[2][0], 'large');
				$macbook 	=	wp_get_attachment_image_src($output_array[4][0], 'large');
				$ipad 		= 	wp_get_attachment_image_src($output_array[6][0], 'large');
				$iphone 	= 	wp_get_attachment_image_src($output_array[8][0], 'large');
				
				
				if(!$imac && !$ipad && !$iphone && $macbook) { 		// macbook
					$sizes = array(0,80,0,0);
					$margins = array('','auto','','');
				} elseif(!$imac && !$ipad && $macbook && $iphone) { // macbook + iphone
					$sizes = array(0,60,0,9);
					$margins = array('','auto 0 0 auto','','auto auto 0 0');
				} elseif(!$imac && $macbook && $ipad && $iphone) {  // macbook + ipad + iphone
					$sizes = array(0,60,24,9);
					$margins = array('','auto 0 0 auto','auto auto 0 3%','auto auto 0 0');
				} elseif(!$imac && !$macbook && !$ipad && $iphone) { // iphone
					$sizes = array(0,0,0,80);
					$margins = array('','','','auto');
				} elseif(!$imac && !$macbook && $ipad && !$iphone) { // ipad
					$sizes = array(0,0,80,0);
					$margins = array('','','auto','');
				} elseif($imac && !$macbook && !$ipad && !$iphone) { // imac
					$sizes = array(80,0,0,0);
					$margins = array('auto','','','');
				} else {
					$sizes = array(60,46,19,6);
					$margins = array('auto auto auto 16%','auto 0 0 auto','auto auto 0 3%','auto auto 0 0');
				}
				
				 
				$html = '.hii_scrolling_screens {position: relative;margin:auto;display: flex;align-items: baseline;}.hii_scrolling_screens img {max-width: 100%;}.hii_scrolling_screens .screen:first-child{position:relative;}';
				
				$html .= '.imac_scrolling_screen {position: absolute;width:'.$sizes[0].'%;margin:'.$margins[0].';bottom: 0;}';
				$html .= '.macbook_scrolling_screen {position: absolute;width:'.$sizes[1].'%;margin:'.$margins[1].';right: 0;bottom: 0;}';
				$html .= '.ipad_scrolling_screen {position: absolute;width:'.$sizes[2].'%;margin:'.$margins[2].';bottom: 0;left: 0;}';
				$html .= '.iphone_scrolling_screen {position: absolute;width:'.$sizes[3].'%;margin:'.$margins[3].';bottom: 0;left: 0;}';
				
				$html .= ($imac[0])?'.imac_scrolling_screen .screen_area {background: url('.$imac[0].') no-repeat;background-size: 100%;width: 92%;height: 67%;position: absolute;bottom: 28%;left: 4%;animation: imac 10s ease-in-out 1s infinite;}':'';
				$html .= ($ipad[0])?'.ipad_scrolling_screen .screen_area {background: url('.$ipad[0].') no-repeat;background-size: 100%;width: 87%;height: 80%;position: absolute;bottom: 12%;left: 7%;animation: imac 10s ease-in-out 1s infinite;}':'';
				$html .= ($iphone[0])?'.iphone_scrolling_screen .screen_area {background: url('.$iphone[0].') no-repeat;background-size: 100%;width: 87%;height: 80%;position: absolute;bottom: 12%;left: 7%;animation: imac 10s ease-in-out 1s infinite;}':'';
				$html .= ($macbook[0])?'.macbook_scrolling_screen .screen_area {background: url('.$macbook[0].') no-repeat;background-size: 100%;width: 76%;height: 80%;position: absolute;bottom: 14%;left: 12%;animation: imac 10s ease-in-out 1s infinite;}':'';
				
				$html .= '@keyframes imac {0% {background-position-y: 0%;}15% {background-position-y: 0%;}30% {background-position-y: 25%;}50% {background-position-y: 50%;}70% {background-position-y: 75%;}90% {background-position-y: 100%;}100% {background-position-y: 0%;}}';
				echo $html;
			}, 1);
		}
	}
 
	return $posts;
}



/**
 * Add Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param object $user
 */
function be_custom_avatar_field( $user ) { ?>
	<h3>Custom Avatar</h3>
	 
	<table>
	<tr>
	<th><label for="be_custom_avatar">Custom Avatar URL:</label></th>
	<td>
	<input type="text" name="be_custom_avatar" id="be_custom_avatar" value="<?php echo esc_attr( get_the_author_meta( 'be_custom_avatar', $user->ID ) ); ?>" /><br />
	<span>Type in the URL of the image you'd like to use as your avatar. This will override your default Gravatar, or show up if you don't have a Gravatar. <br /><strong>Image should be 70x70 pixels.</strong></span>
	</td>
	</tr>
	</table>
	<?php 
}
add_action( 'show_user_profile', 'be_custom_avatar_field' );
add_action( 'edit_user_profile', 'be_custom_avatar_field' );
/**
 * Save Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param int $user_id
 */
function be_save_custom_avatar_field( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
		update_usermeta( $user_id, 'be_custom_avatar', $_POST['be_custom_avatar'] );
}
add_action( 'personal_options_update', 'be_save_custom_avatar_field' );
add_action( 'edit_user_profile_update', 'be_save_custom_avatar_field' );


/**
 * Use Custom Avatar if Provided
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 */
function be_gravatar_filter($avatar, $id_or_email, $size, $default, $alt) {
	
	// If provided an email and it doesn't exist as WP user, return avatar since there can't be a custom avatar
	$email = is_object( $id_or_email ) ? $id_or_email->comment_author_email : $id_or_email;
	if( is_email( $email ) && ! email_exists( $email ) )
		return $avatar;
	
	$custom_avatar = get_the_author_meta('be_custom_avatar');
	if ($custom_avatar) 
		$return = '<img src="'.$custom_avatar.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
	elseif ($avatar) 
		$return = $avatar;
	else 
		$return = '<img src="'.$default.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
	return $return;
}
add_filter('get_avatar', 'be_gravatar_filter', 10, 5);



/*
 * This function takes the last comma or dot (if any) to make a clean float, ignoring thousand separator, currency or any other letter : 
 */
function tofloat($num) {
    $dotPos = strrpos($num, '.');
    //$commaPos = strrpos($num, ',');
    $sep = ($dotPos) ? $dotPos : false;
   
    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    } 

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}
?>