<?php
if ( ! class_exists( 'HiiLottie' ) ) {

    class HiiLottie extends WPBakeryShortCode {

        //Initialize Component
        function __construct() {
            add_action( 'init', array( $this, 'create_shortcode' ), 999 );            
            add_shortcode( 'vc_lottie', array( $this, 'render_shortcode' ) );

        }        

        //Map Component
        public function create_shortcode() {
        
            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }        
        
            // Map blockquote with vc_map()
            vc_map( array(
                'name'          => __('Lottie Animation ', 'hiiwp'),
                'base'          => 'vc_lottie',
                'description'  	=> __( '', 'hiiwp' ),
                'category'      => __( 'HiiWP', 'hiiwp'),                
                'params' => array(
        
                    array(
                        "type" => "textfield",
                        "heading" => __( "Lottie SRC", 'hiiwp' ),
                        "param_name" => "lottie_src",
                        "value" => __( "", 'hiiwp' ),
                        "description" => __( "Enter the src for you Lottie animation.", 'hiiwp' )
                    ),    
                    array(
                        "type" => "textfield",
                        "heading" => __( "Width", 'hiiwp' ),
                        "param_name" => "lottie_width",
                        "value" => __( "", 'hiiwp' ),
                    ), 
                    array(
                        "type" => "textfield",
                        "heading" => __( "Max Width", 'hiiwp' ),
                        "param_name" => "lottie_max_width",
                        "value" => __( "", 'hiiwp' ),
                    ),  
                    
                    array(
                        'type'          => 'dropdown',
                        'heading'       => __( 'Play Options', 'hiiwp' ),
                        'param_name'    => 'lottie_play',
                        'value' => array( "Autoplay", "Play on Hover" ),
                    ),
        
                    array(
                        'type'          => 'checkbox',
                        'heading'       => __( 'Loop Animation', 'hiiwp' ),
                        'param_name'    => 'lottie_loop',
                        'value'         => __( '', 'hiiwp' ),
                    ),
                    
                    array(
                        'type'          => 'checkbox',
                        'heading'       => __( 'Show Controles', 'hiiwp' ),
                        'param_name'    => 'lottie_controls',
                        'value'         => __( '', 'hiiwp' ),
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => __( 'Animation Speed', 'hiiwp' ),
                        'param_name'    => 'lottie_speed',
                        'value' => array( "1x", "1.5x", "2x", "2.5x", "3x" ),
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => __( 'Align Animation', 'hiiwp' ),
                        'param_name'    => 'lottie_align',
                        'value' => array( "Left", "Center", "Right" ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __( "Custom Class", 'hiiwp' ),
                        "param_name" => "extra_class",
                        "value" => __( "", 'hiiwp' ),
                    ),  
                    array(
                        "type" => "textfield",
                        "heading" => __( "Custom ID", 'hiiwp' ),
                        "param_name" => "element_id",
                        "value" => __( "", 'hiiwp' ),
                    ),  
                    array(
            			'type' => 'css_editor',
            			'heading' => __( 'CSS box', 'hiiwp' ),
            			'param_name' => 'css',
            			'group' => __( 'Design Options', 'hiiwp' ),
            		),
            		array(
            			'type' => 'dropdown',
            			'heading' => __( 'Background Position', 'hiiwp' ),
            			'param_name' => 'bg_img_pos',
            			'value' => array(
            				__( 'Default', 'hiiwp' ) => '',
            				__( 'Left Top', 'hiiwp' ) => 'lt',
            				__( 'Left Center', 'hiiwp' ) => 'lc',
            				__( 'Left Bottom', 'hiiwp' ) => 'lb',
            				__( 'Right Top', 'hiiwp' ) => 'rt',
            				__( 'Right Center', 'hiiwp' ) => 'rc',
            				__( 'Right Bottom', 'hiiwp' ) => 'rb',
            				__( 'Center Top', 'hiiwp' ) => 'ct',
            				__( 'Center Center', 'hiiwp' ) => 'cc',
            				__( 'Center Bottom', 'hiiwp' ) => 'cb',
            			),
            			'description' => __( 'Positioning of background image.', 'hiiwp' ),
            			'group' => __( 'Design Options', 'hiiwp' ),
            		),
                ),
            ));

        }

        //Render Component
        public function render_shortcode( $atts, $content, $tag ) {
            
            // Set default attributes
            $atts = (shortcode_atts(array(
                'lottie_src'   => 'https://assets9.lottiefiles.com/packages/lf20_vgiig7fv.json',
                'lottie_loop'       => false,
                'lottie_width'      => '300px',
                'lottie_max_width'  => '',
                'lottie_play'       => 'autoplay',
                'lottie_speed'      => '1',
                'lottie_controls'   => false,
                'lottie_align'      => 'Left',
                'extra_class'       => '',
                'element_id'        => '',
                'css'               => ''
            ), $atts));
            
            //Add customizer css
            $css_classes = array(
        		'lottie-container-inner',
        		vc_shortcode_custom_css_class( esc_attr($atts['css']) ),
        	);
        	
        	if ( ! empty( $bg_img_pos )) {
        		$css_classes[] = ' bg-img-pos-' . $bg_img_pos;
        	}
        	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
        	
        	// set alignment
        	$align = '';
        	if(esc_attr($atts['lottie_align']) == 'Left') {
        	    $align = 'lottie-container-left';
        	}
        	if(esc_attr($atts['lottie_align']) == 'Center') {
        	    $align = 'lottie-container-center';
        	}
        	if(esc_attr($atts['lottie_align']) == 'Right') {
        	    $align = 'lottie-container-right';
        	}
            
            //lottie src
            $src  = esc_url( $atts['lottie_src'] );
            
            // set parameters
            $params = '';
            
            if(esc_attr($atts['lottie_play']) == 'Play on Hover') {
                $params .= 'hover ';
            } else {
                $params .= 'autoplay ';
            }
            if(esc_attr($atts['lottie_loop']) == true) {
                $params .= 'loop ';
            }
            if(esc_attr($atts['lottie_controls']) == true) {
                $params .= 'controls ';
            }
            
            $speed = str_replace("x","",esc_attr($atts['lottie_speed']));
            $width = esc_attr($atts['lottie_width']);
            $max_width = esc_attr($atts['lottie_max_width']);
            
            //Addiational classes and Id
            $extra_class        = esc_attr($atts['extra_class']);
            $element_id         = esc_attr($atts['element_id']);
        
            // Output HTML
            $output = '';
            $output .= '<div class="lottie-container '.$align.'"><div class=" '.$css_class.' ' . $extra_class . '" id="' . $element_id . '" style="width: '.$width.'; max-width: '.$max_width.'">';
            $output .= '<lottie-player
            
            '.$params.'
            mode="normal"
            speed="'.$speed.'"
            src="'.$src.'"
            >';
            $output .= '</lottie-player>';
            $output .= '</div></div>';
        
            return $output; 

        }

    }

    new HiiLottie();

}
?>