<?php


function add_media_gallery_shortcode( $atts ){
	extract( shortcode_atts( array(
	    'show_post_meta'  	=> get_theme_mod( 'portfolio_show_post_meta', false ),
	    'show_post_title'  	=> get_theme_mod( 'portfolio_show_post_title', false ),
	    'in_grid'			=> get_theme_mod( 'portfolio_in_grid', false ),
	    'add_padding'		=> get_theme_mod( 'portfolio_add_padding', '0px' ),
	    'portfolio_layout'	=> get_theme_mod( 'portfolio_layout', false ),
	    'portfolio_columns'	=> get_theme_mod( 'portfolio_columns', '1' ),
		'portfolio_image_pos'=> get_theme_mod( 'portfolio_image_pos', 'image-left' ),
		'portfolio_title_pos'=> get_theme_mod( 'portfolio_title_pos', 'title-below' ),
		'portfolio_heading_size'=> get_theme_mod( 'portfolio_heading_size', 'h2' ),
		'portfolio_excerpt_on'=> get_theme_mod( 'portfolio_excerpt_on', false ),
		'portfolio_more_on'	=> get_theme_mod( 'portfolio_more_on', false ),
		'media_grid_images' => false,
		'css'				=> '',
    ), $atts ) );
    $output = '';
    
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'media-gallery', $atts );
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
		    'add_padding'		=> $add_padding,
		    'css_class'			=> $css_class,			
		    'portfolio_layout'	=> $portfolio_layout,
		    'portfolio_columns' => $portfolio_columns,
	    ));
	$output .= $portfolio;

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
		$output = $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		$output .= do_shortcode('[media-gallery]');
		$output .= $args['after_widget'];
		echo  $output ; // WPCS: XSS ok.
		
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Share This', 'hiiwp' );
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'hiiwp' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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