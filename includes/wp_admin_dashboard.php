<?php
///////////////////////////////
//
// add new dashboard widgets
//
//////////////////////////////
function hiilite_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'hiilite_dashboard_welcome', 'Welcome', 'hiilite_add_welcome_widget' );
}
function hiilite_add_welcome_widget(){ ?>
 
	<h3>This Site is Managed by Hiilite Creative Group</h3>
<p>Hiilite works with a mix of local, regional, provincial and international clients. We are equally happy working face-to-face and working remotely. We serve BC, Western Canada and beyond from a little corner of paradise - Kelowna, BC.<br><br>

115-1690 Water Street<br>
Kelowna, BC, V1Y 8T8, Canada<br>
<a href="tel:+18883033444">1.888.303.3444</a><br>
</p><div id="social-icons">
<a href="https://www.facebook.com/hiilite" target="_blank"><img src="https://hiilite.com/wp-content/uploads/2014/11/Facebook-32.png" width="32" height="32" alt="Facebook" scale="0"></a><a href="https://twitter.com/hiilite" target="_blank"><img src="https://hiilite.com/wp-content/uploads/2014/11/Twitter-Bird-32.png" width="32" height="32" alt="Twitter" scale="0"></a><a href="https://plus.google.com/u/0/b/107657092449987968512/107657092449987968512" target="_blank"><img src="https://hiilite.com/wp-content/uploads/2014/11/Google-Plus-32.png" width="32" height="32" alt="Google" scale="0"></a>
</div>
 
 
<?php }
add_action( 'wp_dashboard_setup', 'hiilite_add_dashboard_widgets' );

// remove unwanted dashboard widgets for relevant users
function hiilite_remove_dashboard_widgets() {
    $user = wp_get_current_user();
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'hiilite_remove_dashboard_widgets' );

// Move the 'Right Now' dashboard widget to the right hand side
function hiilite_move_dashboard_widget() {
    $user = wp_get_current_user();
        global $wp_meta_boxes;
        $widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
        $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] = $widget;
	
		$widget2 = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'];
        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
        $wp_meta_boxes['dashboard']['side']['core']['dashboard_activity'] = $widget2;

}
add_action( 'wp_dashboard_setup', 'hiilite_move_dashboard_widget' );	

//////////////////////////////////
//
//	Change Admin Menu Bar
//
//////////////////////////////////
add_action( 'admin_bar_menu', 'modify_admin_bar', 999 );

function modify_admin_bar( $wp_admin_bar ){
  // do something with $wp_admin_bar;
	$wp_admin_bar->remove_node( 'wporg' );
	$wp_admin_bar->remove_node( 'about' );
	$wp_admin_bar->remove_node( 'documentation' );
	$wp_admin_bar->remove_node( 'support-forums' );
	$wp_admin_bar->remove_node( 'feedback' );
	
	$wplogo = $wp_admin_bar->get_node( 'wp-logo' );
	$args = array(
		'id'    => 'hiilite_com',
		'title' => 'Hiilite.com',
		'href'  => 'http://hiilite.com',
		'meta'  => array( 'class' => 'hiilite_com' ),
		'parent' => $wplogo->id
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'hiilite_marketing',
		'title' => 'Marketing',
		'href'  => 'http://www.hiilite.com/marketing-strategy/',
		'meta'  => array( 'class' => 'hiilite_marketing' ),
		'parent' => $wplogo->id
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'hiilite_webdesign',
		'title' => 'Web Design',
		'href'  => 'http://www.hiilite.com/website-design/',
		'meta'  => array( 'class' => 'hiilite_webdesign' ),
		'parent' => $wplogo->id
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'hiilite_seo',
		'title' => 'SEO',
		'href'  => 'http://www.hiilite.com/seo-social-media/',
		'meta'  => array( 'class' => 'hiilite_seo' ),
		'parent' => $wplogo->id
	);
	$wp_admin_bar->add_node( $args );
}


?>