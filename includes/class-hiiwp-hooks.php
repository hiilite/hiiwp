<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HiiWP_Hooks
 */
class HiiWP_Hooks extends Hii {
	
	
	public $hii_hooks = array(
		'hii_doctype',
		'hii_meta',
		'hii_before',
		'hii_before_header',
		'hii_header',
		'hii_after_header',
		'hii_header_bottom_left',
		'hii_header_bottom_right',
		'hii_before_footer',
		'hii_footer',
		'hii_after_footer',
		'hii_body_end',
		'hii_split_portfolio_sidebar_title',
		'hii_split_portfolio_sidebar_client',
		'hii_split_portfolio_sidebar_date',
		'hii_split_portfolio_sidebar_tags',
		'hii_split_portfolio_sidebar_team',
		'hii_split_portfolio_sidebar_share',
		'hii_split_portfolio_sidebar_about',
		'hii_before_blog_loop',
		'hii_after_blog_loop',
		'hii_before_sidebar',
		'hii_after_sidebar',
		'before_page_title',
		'after_page_title'
		
	);
	/**
	 * __construct function.
	 * 
	 * @access private
	 * @return void
	 */
	public function __construct() {
		
		add_action( 'cmb2_admin_init', array($this, 'add_admin_hooks_page' ));
		
		add_action('hii_doctype', array($this,'hii_doctype'));	
		add_action('hii_title', array($this, 'hii_title'));
		add_action('hii_header_hgroup', array($this,'hii_header_hgroup'));	
		add_action('hii_header_bottom_left', array($this,'hii_header_bottom_left'));	
		add_action('hii_header_bottom_right', array($this,'hii_header_bottom_right'));	
		
		/* Portfolio */
		add_action('hii_split_portfolio_sidebar_title', array($this,'hii_split_portfolio_sidebar_title'));		
		add_action('hii_split_portfolio_sidebar_client', array($this,'hii_split_portfolio_sidebar_client'));
		add_action('hii_split_portfolio_sidebar_date', array($this,'hii_split_portfolio_sidebar_date'));
		add_action('hii_split_portfolio_sidebar_tags', array($this,'hii_split_portfolio_sidebar_tags'));
		add_action('hii_split_portfolio_sidebar_team', array($this,'hii_split_portfolio_sidebar_team'));	
		add_action('hii_split_portfolio_sidebar_share', array($this,'hii_split_portfolio_sidebar_share'));	
		add_action('hii_split_portfolio_sidebar_about', array($this,'hii_split_portfolio_sidebar_about'));	
		
		foreach($this->hii_hooks as $hook) {
			add_action($hook, function() use ( $hook ){
				$hooks = get_option('hii_hooks');
				if(! empty($hooks[$hook]))
					echo $hooks[$hook]; 
				else
					return;
			});
		}
		
	}
	
		
	public function add_admin_hooks_page(){
		$opt_key = 'hii_hooks';
		
	    $show_on = array( 'key' => 'options-page', 'value' => array( $opt_key ) );
	    
		$boxes = array();
		$tabs = array();
		
		
		$cmb = new_cmb2_box( array(
	        'id'        => 'header',
	        'title'     => __( 'Header', 'hiiwp' ),
	        'show_on'   => $show_on 
	    ));
	    	
	    	
	    foreach($this->hii_hooks as $hook) {
					
		    $cmb->add_field( array(
		        'name'       => $hook,
		        'id'         => $hook,
		        'type'       => 'text',
		        'default'	 => '',
		    ));
	    }
	    
	    
	    
	    $cmb->object_type( 'options-page' );
	    $boxes[] = $cmb;
	    
	    $tabs[] = array(
	         'id'    => 'hooks_header',
	         'title' => 'Header',
	         'desc'  => '',
	         'boxes' => array(
		         'header',
	         ),
	    );
		
		// configuration array
		$args = array(
			'key'      => $opt_key,
			'title'    => 'HiiWP Theme Hooks',
			'topmenu'  => 'hii_seo_settings',
			'cols'     => 1,
			'boxes'    => $boxes,
			'tabs'     => $tabs,
			'menuargs' => array(
				'menu_title' => 'Custom Hooks',
				'position'	=> 1,
			),
			'savetxt'    => 'Save',
		);
		
		// create the options page
		new Cmb2_Metatabs_Options( $args );
	}
	
	/**
	 * hii_doctype function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_doctype(){
		$doctype = '<!doctype html>';
		$html_tag = '<html '. get_language_attributes() .'>';
		echo $doctype.$html_tag;
	}
	
	/**
	 * hii_doctype function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_header_hgroup(){
		$page_title = hii_get_the_title();
		$hgroup = "<h1 style='display: none;'>$page_title</h1>";
		echo $hgroup;
	}
	
	/**
	 * hii_header_bottom_left function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_header_bottom_left(){
		if ( is_active_sidebar( 'header_bottom_left' ) ) :
			dynamic_sidebar( 'header_bottom_left' );
		endif;
	}
	
	/**
	 * hii_header_bottom_right function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_header_bottom_right(){
		if ( is_active_sidebar( 'header_bottom_right' ) ) :
			dynamic_sidebar( 'header_bottom_right' );
		endif;
	}
	
	/**
	 * hii_split_portfolio_sidebar_title function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_split_portfolio_sidebar_title($args){
		$title = '<div class="row project-title">
			<div class="col-11">
				<div class="col-12">
				<h1 itemprop="headline">'.$args[0].'</h1>
			</div>
			</div>
			<div class="col-1 project-icon cat-icon">
				<img src="'.$args[1].'">
			</div>
		</div>

		<hr style="color:'.$args[2].';border-color: '.$args[2].';background: '.$args[2].';height: 2px;border: none;">';
		
		echo $title;
	}
	
	/**
	 * hii_split_portfolio_sidebar_client function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_split_portfolio_sidebar_client($portfolio_client){
		$client = '<div>
			<div class="col-12 project-client">
				<h3>CLIENT</h3>
				<h2>
					'.$portfolio_client.'
				</h2>
			</div>
		</div>';
		
		echo $client;
	}
	
	/**
	 * hii_split_portfolio_sidebar_date function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_split_portfolio_sidebar_date($args){
		$date = '<div class="row">
			<small><time class="time op-published" datetime="'.$args[0].'"><span class="date">'.$args[1].'</span></time></small>
		</div>';
		
		echo $date;
	}
	
	/**
	 * hii_split_portfolio_sidebar_tags function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_split_portfolio_sidebar_tags($tags){
		if($tags) { 
			$portfolio_tags = '<div class="row">
	        	<div class="tags_text">
					<span itemprop="keywords" class="labels">
						<small>';
							if(is_array($tags)) {
								foreach($tags as $tag) {
									$tad_id = get_tag_link($tag->term_id);
									$portfolio_tags .= '<a href="'.$tad_id.'">#'.$tag->name.'</a> ';
								}
							}
							else {
								$tad_id = get_tag_link($tags->term_id);
								$portfolio_tags .= '<a href="'.$tad_id.'">#'.$tags->name.'</a> ';
							}
						$portfolio_tags .= '</small>
						</span>
				</div>
			</div>';
			echo $portfolio_tags;
		}
	}
	
	/**
	 * hii_split_portfolio_sidebar_team function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_split_portfolio_sidebar_team($contributers){
		if(is_array($contributers)):
			$team = '<div class="row project-group">';
				foreach ( $contributers as $key => $entry ) {
				
					$role = $name = '';
				
					if ( isset( $entry['role'] ) && isset( $entry['name'] )) { 
						$team .= '<div class="row"><div class="col-6"><strong>';
						$team .= $entry['role'];
						$team .= ': </strong>';
						$team .= $entry['name'];
						$team .= '</div></div>';
					}			
				}	
			$team .= '</div>';
			
			echo $team;
		endif;
	}
	
	/**
	 * hii_split_portfolio_sidebar_share function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_split_portfolio_sidebar_share($project_share){
		
		$social_share = '<div class="row project-social">
			<div>';
			foreach($project_share as $share) {
				if($share == 'fb') {
					$social_share .= '<a href="https://www.facebook.com/sharer/sharer.php?u='.$social_url.'"><i class="fa fa-facebook" aria-hidden="true"></i></a>';	
				}
				if($share == 'tw') {
					$social_share .= '<a href="https://twitter.com/home?status='.$social_url.'"><i class="fa fa-twitter" aria-hidden="true"></i></a>';	
				}
				if($share == 'gp') {
					$social_share .= '<a href="https://plus.google.com/share?url='.$social_url.'"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';	
				}
				if($share == 'pn') {
					$social_share .= '<a href="https://pinterest.com/pin/create/button/?url='.$social_url.'"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';	
				}
				if($share == 'ln') {
					$social_share .= '<a href="https://www.linkedin.com/shareArticle?mini=true&url='.$social_url.'"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';	
				}
			}

			$social_share .= '</div>';
			$social_share .= '<div>'.__( 'Appreciate and Share', 'hiiwp' ).'</div>
		</div>';		
		
		echo $social_share;
	}
	
	/**
	 * hii_split_portfolio_sidebar_about function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hii_split_portfolio_sidebar_about($args){
		
		$author = get_the_author_meta( 'display_name' , $args[0] );
		$author_url = get_author_posts_url( $args[0] );
		
		$about = '<div class="row project-author">
			<div class="col-2 author-icon project-icon">
				<a href="'.$author_url.'">
					<img src="'.get_avatar_url( $args[0] ).'" width="50" height="50" class="avatar" alt="'.$author.'" />
				</a>
			</div>
			<div class="col-10">
				<a href="'.$author_url.'"><h4>'.$author.'</h4></a>
				<small>'.__( 'Author', 'hiiwp' ).'</small>
				
				<div class="project-description">';
					if($args[1] != '') {
						$about .= $args[1];	 
					}
				$about .= '</div>
			</div>
		</div>';
		
		echo $about;
	}

	
}