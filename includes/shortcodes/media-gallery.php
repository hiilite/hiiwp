<?php


function add_media_gallery_shortcode( $atts ){
	$options = get_option('company_options');
	extract( shortcode_atts( array(
	    'media_grid_images' => false,
	    'show_post_meta'  	=> false,
	    'show_post_title'  	=> false,
	    'in_grid'			=> false,
	    'padding'			=> false,
	    
    ), $atts ) );
    $output = '';
	
	$portfolio = get_portfolio(
		array(
			'post_type'=>'attachment',
			'post_mime_type' =>'image',
			'post_status' => 'inherit',
			'posts_per_page' => -1,
			'post__in' => explode(',', $media_grid_images )
		),
		array(
		    'media_grid_images' => $media_grid_images,
		    'show_post_meta'  	=> $show_post_meta,
		    'show_post_title'  	=> $show_post_title,
		    'in_grid'			=> $in_grid,
		    'add_padding'		=> $padding,
	    ));
	echo $portfolio;

	return $output;
}
add_shortcode( 'media-gallery', 'add_media_gallery_shortcode' );




class Media_Gallery_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'media_gallery',
			'description' => 'Add the media gallery',
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
		echo do_shortcode('[media-gallery]');
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
	//register_widget( 'Social_Profiles_Widget' );
});
	
	?>