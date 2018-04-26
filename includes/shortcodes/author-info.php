<?php


function add_author_info_shortcode( $atts ){
	global $post;
	$defaults = array(
		"css"  			=> "",
    );
    if($atts == '')$atts = $defaults;
	extract( shortcode_atts( $defaults, $atts ) );
	
	$css_classes = array(
		'author-info',
		vc_shortcode_custom_css_class( $css ), 
	);
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
		
    $output = '<div '.implode( ' ', $wrapper_attributes ).'>';
	
	// Detect if it is a single post with a post author
	if (isset( $post->post_author ) ) {
		// Get author's display name 
		$display_name = get_the_author_meta( 'display_name', $post->post_author );
		
		// If display name is not available then use nickname as display name
		if ( empty( $display_name ) )
			$display_name = get_the_author_meta( 'nickname', $post->post_author );
			
		
		// Get author's biographical information or description
		$user_description = get_the_author_meta( 'user_description', $post->post_author );
		
		// Get author's website URL 
		$user_website = get_the_author_meta('url', $post->post_author);
		
		// Get link to the author archive page
		$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
		 
		if ( ! empty( $display_name ) )
			$author_details = '<div class="author_name">About ' . $display_name . '</div>';
		
		$author_details .= '<div class="author_image">' . get_avatar( get_the_author_meta('user_email') , 90 ) .'</div>';
		if ( ! empty( $user_description ) )
			// Author avatar and bio
			$author_details .= '<p class="author_details">'. nl2br( $user_description ). '</p>';
		
		$author_details .= '<p class="author_links"><a href="'. $user_posts .'"> More by ' . $display_name . '</a>';  
		
		// Check if author has a website in their profile
		if ( ! empty( $user_website ) ) {
			// Display author website link
			$author_details .= ' <br> <a href="' . $user_website .'" target="_blank" rel="noopener">Website</a>';
		
		} else { 
			// if there is no author website then just close the paragraph
			$author_details .= '</p>';
		}
		
		// Pass all this info to post content  
		$output .= $author_details;
	}
	
	
	
	$output .= '</div>';
	return $output;
}
add_shortcode( 'author-info', 'add_author_info_shortcode' );




class Author_Info_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'author_info',
			'description' => 'Adds an about the author widget',
		);
		parent::__construct( 'author_info', 'Author Info', $widget_ops );
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
		echo do_shortcode('[author-info]');
		echo $args['after_widget'];
		
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'hiiwp' ); ?></label> 
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
	register_widget( 'Author_Info_Widget' );
});
	?>