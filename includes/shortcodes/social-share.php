<?php
function add_social_share_shortcode( $atts ){
	extract( shortcode_atts( array(
      'fa'  => true,
      'gp'  => true,
      'tw'	=> true,
      'pt'	=> true,
      'li'	=> true,
      'em'	=> true,
   ), $atts ) );
  
  $output = '<amp-social-share type="twitter" width="50" height="50"><a title="Share On Twitter"><i class="fa fa-twitter"></i></a> </amp-social-share>
		<amp-social-share type="facebook" width="50" height="50" data-attribution="1749904918576539" data-url="'.get_the_permalink().'">
			<a title="Share On Facebook"><i class="fa fa-facebook"></i></a></amp-social-share>
		<amp-social-share type="pinterest" width="50" height="50"><a title="Share On Pinterest"><i class="fa fa-pinterest"></i></a></amp-social-share>
		<amp-social-share type="linkedin" width="50" height="50"><a title="Share On LinkedIn"><i class="fa fa-linkedin"></i></a></amp-social-share>
		<amp-social-share type="gplus" width="50" height="50"><a title="Share On Google+"><i class="fa fa-google-plus"></i></a></amp-social-share>
		<amp-social-share type="email" width="50" height="50"><a title="Email"><i class="fa fa-envelope"></i></a></amp-social-share>';
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
		echo do_shortcode('[social-share]');
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

		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Social_Share_Widget' );
});
	
	?>