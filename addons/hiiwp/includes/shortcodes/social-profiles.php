<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function add_social_profiles_shortcode( $atts ){
	$options = get_option('company_options');
	$defaults = array(
	    'facebook'  	=> false,
	    'twitter'  		=> false,
	    'google-plus'	=> false,
	    'instagram'		=> false,
	    'linkedin'		=> false,
	    'pinterest'		=> false,
	    'houzz'			=> false,
	    'youtube'		=> false,
	    'tripadvisor'	=> false,
		'yelp'			=> false,
		'email'			=> false,
		"css"  			=> "",
    );
	if($atts == '')$atts = $defaults;
	extract( shortcode_atts( $defaults, $atts ) );
	
	$css_classes = array(
		'social-profiles',
		'text-block',
		vc_shortcode_custom_css_class( $css ), 
	);
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
		
    $output = '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	foreach($atts as $key=>$profile){
		$bkey = isset($options['business_'.str_replace('-','',$key)])?$options['business_'.str_replace('-','',$key)]:false;
		if($bkey) $output .= '<a href="'.$bkey.'" target="_blank"><i class="fa fa-'.$key.'"></i></a> ';
	}
	$output .= '</div>';
	return $output;
}
add_shortcode( 'social-profiles', 'add_social_profiles_shortcode' );




class Social_Profiles_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'social_profiles',
			'description' => 'Adds social profile buttons',
		);
		parent::__construct( 'social_profiles', 'Social Profiles', $widget_ops );
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
		echo do_shortcode('[social-profiles]');
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
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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
		//$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Social_Profiles_Widget' );
});
	
	?>