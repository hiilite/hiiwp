<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$post_id = get_the_id();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$vbg = '';
if($atts['active'] == true):

	if($atts['video_background'] == 'yes') {
		$vbg = 'has_video_background';	
	}
	
	$css = $el_class = '';
	$this->resetVariables( $atts, $content );
	
	WPBakeryShortCode_VC_Tta_Section::$self_count ++;
	WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
	
	$isPageEditable = vc_is_page_editable();
	
	$css = $atts['css'];
	$bg_img_pos = $atts['bg_img_pos'];
	$link = wp_get_attachment_image_src( $atts['image'], 'full' );
	$src = $link[0];
	$slide_width = $link[1];
	$slide_height = $link[2];
	
	$el_class = $this->getExtraClass( $el_class );
	$css_classes = array(
		$el_class,
		vc_shortcode_custom_css_class( $css ),
	);
	
	$wrapper_attributes = array();
	$wrapper_attributes[] = 'id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';
	
	if ( ! empty( $bg_img_pos )) {
		$css_classes[] = ' bg-img-pos-' . $bg_img_pos;
	}
	
	$css_classes[] = $vbg;
	$css_classes[] = 'slide';
	$css_classes[] = esc_attr( $this->getElementClasses() );
	
	
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	$output = '';
	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' style="background-image:url('.$src.');background-color:'.$atts['background_color'].'; background-size:cover;">';
	if( $vbg == 'has_video_background') {
		$output .= '<div id="player"></div>';
		
		$output .= '<script>
		
		var tag = document.createElement("script");
	
	    tag.src = "https://www.youtube.com/iframe_api";
	    var firstScriptTag = document.getElementsByTagName("script")[0];
	    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		
		var player;
	    function onYouTubePlayerAPIReady() {
	        player = new YT.Player("player", {
	          height: "315",
	          width: "560",
	          videoId: "' . $atts['video_id'] . '",
	          events: {
	            "onReady": onPlayerReady,
	            "onStateChange": onPlayerStateChange
	          },
	          playerVars: {autoplay: 1, modestbranding: 1, mute: 1, loop: 1, controls: 0, disablekb: 1, enablejsapi: 1, iv_load_policy: 3, playsinline: 1, rel: 0, showinfo: 0, ecver: 2}
	        });
	    }
	
	    function onPlayerReady(event) {
		    event.target.mute();
	        event.target.playVideo();
	    }
	
	    function onPlayerStateChange(event) {        
	        if(event.data === 0) {      
		        jQuery.noConflict();
				(function( $ ) {
				  $(function() {
				    $("#player").fadeOut();
				  });
				})(jQuery);    
	        }
	    }
		</script>';
	}
	
	$output .= '<div class="slide-text-overlay">';
	$output .= $this->getTemplateVariable( 'content' );
	$output .= '</div></div>';
	echo __hii($output); // WPCS: XSS ok.
endif;