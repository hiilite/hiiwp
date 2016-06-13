<?php
////////////////////////////////////
//
// Add a new logo to the login page
//
////////////////////////////////////
function hiilite_login_logo() { 
	$hiilite_options['main_logo'] = get_theme_mod('main_logo', get_template_directory_uri().'/images/logoNormal@2x.png');
$image_id = attachment_url_to_postid( $hiilite_options['main_logo'] );
if( isset( $image_id ) ) {
  $image_url  = wp_get_attachment_metadata($image_id); 
}
?>
    <style type="text/css">
        .login #login h1 a {
            background-image: url( <?= $hiilite_options['main_logo']; ?> );
			background-size: contain;
			  width: auto;
			  background-repeat: no-repeat;
        }
        .button, .wp-core-ui .button-primary.button  {
	            box-shadow: none;
	            text-shadow:none;
			<?php echo preg_replace('/[{}]/','',get_theme_mod('typography_button_custom_css')); ?>
		}
		
		<?php
		echo get_theme_mod('admin_custom_css');
		?>
    </style>
    <script>
	window.onload = function(){
		var hilogo = document.querySelector('#login');
		var hilink = document.querySelector('#login h1 a'); 

		document.querySelector('#login h1 a').setAttribute('href', '<?=get_bloginfo('url');?>');
	};
		
	</script>
<?php }
add_action( 'login_enqueue_scripts', 'hiilite_login_logo' );

?>