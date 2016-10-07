<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function add_social_share_shortcode( $atts ){
	global $qode_options_proya;

	$el_class = $width = $css = $offset = $output = $style = '';
	/*
		TODO:
		- Add &via=@twittername to twitter link 
		- Switch to amp-social-share once compatibility is back
		- Pull post title and other meta from global values
	*/
	$options = get_option('company_options');
	extract( shortcode_atts( array(
      'fa'  => false,
      'gp'  => false,
      'tw'	=> false,
      'pt'	=> false,
      'li'	=> false,
      'css'	=> ''
   ), $atts ) );
   
  
   
   $permalink = 'https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
   
   
   	$css_classes = array(
		vc_shortcode_custom_css_class( $css ), 
	);
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
   // Page Image
   $post_id = get_the_id();
	if(has_post_thumbnail($post_id)){
		$page_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
		$page_image=$page_image[0];
	} else {
		$page_image = $options['business_logo'];
	}
	
	// Page Title
	$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
	if(get_post_meta($post_id, 'page_seo_title', true) != ''){
		$page_title = get_post_meta($post_id, 'page_seo_title', true);
	}
	elseif(get_theme_mod('site_seo_title') != '' && is_front_page()) {
		$page_title = get_theme_mod('site_seo_title');
	} else {
		$page_title = wp_title('-',false,'right').$brand_title;
	}
	$page_title = preg_replace('[^A-Za-z0-9\ ]','', $page_title);
	
	//Hash tag list
	$posttags = get_the_tags();
	$hashtags = '&hashtags=';
	if ($posttags) {
		$comma = '';
		foreach($posttags as $tag) {
			$hashtags .= $comma.$tag->name;
			$comma = ',';
		}
	}
	$output = '<div '.implode( ' ', $wrapper_attributes ).'>';
	
	$output .= '<a title="Share On Facebook" target="_blank" href="http://www.facebook.com/sharer.php?u='.$permalink.'"><i class="fa fa-facebook"></i></a>  ';
	
	if($gp) $output .= '<a title="Share On Google+" target="_blank" href="https://plus.google.com/share?url='.$permalink.'"><i class="fa fa-google-plus"></i></a>  ';
	
	
	
	if($tw) $output .= '<a title="Share On Twitter" target="_blank" href="https://twitter.com/share?url='.urlencode($permalink).'&text='.$page_title.str_replace(' ','',$hashtags).'"><i class="fa fa-twitter"></i></a>  ';
	
	if($li) $output .= '<a title="Share On LinkedIn" target="_blank" href="http://www.linkedin.com/shareArticle?url='.$permalink.'"><i class="fa fa-linkedin"></i></a>  ';
	if($pt) $output .= '<a title="Share On Pinterest" target="_blank" href="https://pinterest.com/pin/create/bookmarklet/?media='.$page_image.'&url='.$permalink.'&description='.$page_title.'"><i class="fa fa-pinterest"></i></a>  ';
	
	
	/*
	if($tw) $output = '<amp-social-share type="twitter" width="50" height="50"><a title="Share On Twitter"><i class="fa fa-twitter"></i></a> </amp-social-share>';
	if($fa) $output .= '<amp-social-share type="facebook" width="50" height="50" data-attribution="1749904918576539" data-url="'.get_the_permalink().'">
				<a title="Share On Facebook"><i class="fa fa-facebook"></i></a></amp-social-share>';
	if($pt) $output .= '<amp-social-share type="pinterest" width="50" height="50"><a title="Share On Pinterest"><i class="fa fa-pinterest"></i></a></amp-social-share>';
	if($li) $output .= '<amp-social-share type="linkedin" width="50" height="50"><a title="Share On LinkedIn"><i class="fa fa-linkedin"></i></a></amp-social-share>';
	if($gp) $output .= '<amp-social-share type="gplus" width="50" height="50"><a title="Share On Google+"><i class="fa fa-google-plus"></i></a></amp-social-share>';
	if($em) $output .= '<amp-social-share type="email" width="50" height="50"><a title="Email"><i class="fa fa-envelope"></i></a></amp-social-share>';
	*/
	$output .= '</div>';
	return $output;
}
add_shortcode( 'social-share', 'add_social_share_shortcode' );




class Social_Share_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'social_share',
			'description' => 'Adds social sharing buttons',
		);
		parent::__construct( 'social_share', 'Social Share', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		$atts = '';
		foreach($instance as $key=>$val){
			$atts .= ' '.$key.'='.$val.' ';
		}
		echo do_shortcode('[social-share '.$atts.']');
		echo $args['after_widget'];
		
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Share This', 'text_domain' );
		$fa = ! empty( $instance['fa'] ) ? true : false;
		$gp = ! empty( $instance['gp'] ) ? true : false;
		$tw = ! empty( $instance['tw'] ) ? true : false;
		$pt = ! empty( $instance['pt'] ) ? true : false;
		$li = ! empty( $instance['li'] ) ? true : false;
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id( 'fa' );?>"><?php _e( 'Facebook:' );?></label> 
			<input id="<?=$this->get_field_id( 'fa' );?>" name="<?=$this->get_field_name( 'fa' );?>" type="checkbox" value="true" <?php if($fa)echo 'checked=checked';?>><br>
			<label for="<?=$this->get_field_id( 'gp' );?>"><?php _e( 'Google Plus:' );?></label> 
			<input id="<?=$this->get_field_id( 'gp' );?>" name="<?=$this->get_field_name( 'gp' );?>" type="checkbox" value="true" <?php if($gp)echo 'checked=checked';?>><br>
			<label for="<?=$this->get_field_id( 'tw' );?>"><?php _e( 'Twitter:' );?></label> 
			<input id="<?=$this->get_field_id( 'tw' );?>" name="<?=$this->get_field_name( 'tw' );?>" type="checkbox" value="true" <?php if($tw)echo 'checked=checked';?>><br>
			<label for="<?=$this->get_field_id( 'pt' );?>"><?php _e( 'Pinterest:' );?></label> 
			<input id="<?=$this->get_field_id( 'pt' );?>" name="<?=$this->get_field_name( 'pt' );?>" type="checkbox" value="true" <?php if($pt)echo 'checked=checked';?>><br>
			<label for="<?=$this->get_field_id( 'li' );?>"><?php _e( 'LinkedIn:' );?></label> 
			<input id="<?=$this->get_field_id( 'li' );?>" name="<?=$this->get_field_name( 'li' );?>" type="checkbox" value="true" <?php if($li)echo 'checked=checked';?>><br>
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['fa'] = ( ! empty( $new_instance['fa'] ) ) ? true : false;
		$instance['gp'] = ( ! empty( $new_instance['gp'] ) ) ? true : false;
		$instance['tw'] = ( ! empty( $new_instance['tw'] ) ) ? true : false;
		$instance['pt'] = ( ! empty( $new_instance['pt'] ) ) ? true : false;
		$instance['li'] = ( ! empty( $new_instance['li'] ) ) ? true : false;

		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Social_Share_Widget' );
});
	
	?>