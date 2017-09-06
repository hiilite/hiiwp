<?php
/**
 * The HiiWP Admin class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.1
 */

/**
 * HiiWP_Admin class.
 *
 * @since 0.4.1
 */
class HiiWP_Admin {
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		add_action( 'add_meta_boxes', array( $this, 'page_options_meta_box' ));
		add_action( 'save_post', array( $this, 'page_seo_options_meta_box_save' ), 999 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ));
		add_action( 'admin_head', array( $this, 'custom_colors' ));
	}
	
	
	
	/**
	 * hiilite_admin_styles function.
	 * 
	 * @access public
	 * @return void
	 */
	public function admin_styles() {
	    wp_register_style( 'hiilite_admin_stylesheet', get_template_directory_uri(). '/css/admin-style.css' );
	    wp_enqueue_style( 'hiilite_admin_stylesheet' );
	    
	    wp_enqueue_media();
	 
	    // Registers and enqueues the required javascript.
	    wp_register_script( 'meta_uploader', get_template_directory_uri() . '/js/meta_uploader.js', array( 'jquery' ) );
	    wp_localize_script( 'meta_uploader', 'meta_image',
	        array(
	            'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
	            'button' => __( 'Use this image', 'prfx-textdomain' ),
	        )
	    );
	    wp_enqueue_script( 'meta_uploader' );
	}
	
	
	/**
	 * custom_colors function.
	 * 
	 * @access public
	 * @return void
	 */
	public function custom_colors() {
		
		require(HIILITE_DIR . '/includes/site_variables.php');
		echo '<style>';
			require_once(HIILITE_DIR . '/css/editor-style.php');
		echo '</style>';
		add_editor_style( HIILITE_DIR.'/css/editor-style.css' ); 
	}
	

	
	/**
	 * page_options_meta_box function.
	 * 
	 * @access public
	 * @return void
	 */
	public function page_options_meta_box()
	{
	    add_meta_box(
	        'page_seo_options', // id, used as the html id att
	        __( 'HiiWP SEO Options' ), // meta box title, like "Page Attributes"
	        'page_seo_options_meta_box_cb', // callback function, spits out the content
	        array('page','post','portfolio','team','menu'), // post type or page. We'll add this to pages only
	        'normal', // context (where on the screen
	        'high' // priority, where should this go in the context?
	    );
	}
	
	/**
	 * page_seo_options_meta_box_cb function.
	 * 
	 * @access public
	 * @param mixed $post
	 * @return void
	 */
	public function page_seo_options_meta_box_cb( $post )
	{
		// $post is already set, and contains an object: the WordPress post
	    global $post;
	    $values = get_post_custom( $post->ID );
	    $page_seo_title = isset( $values['page_seo_title'][0] ) ? esc_attr( $values['page_seo_title'][0] ) : '';
	    if(isset($values['_yoast_wpseo_title'][0]) && $page_seo_title == '')$page_seo_title = $values['_yoast_wpseo_title'][0];
	    
	    $page_seo_description = isset( $values['page_seo_description'][0] ) ? esc_attr( $values['page_seo_description'][0] ) : '';
	    if(isset($values['_yoast_wpseo_title'][0]) && $page_seo_title == '')$page_seo_title = $values['_yoast_wpseo_title'][0];
	    if(isset($values['_yoast_wpseo_metadesc'][0]) && $page_seo_description == '')$page_seo_description = $values['_yoast_wpseo_metadesc'][0];
	    // We'll use this nonce field later on when saving.
	    wp_nonce_field( 'page_seo_options__meta_box_nonce', 'meta_box_nonce' );
	    ?>
	    <p>
		<label for="page_seo_title">SEO Title</label><br>
	        <input id="page_seo_title" name="page_seo_title" maxlength="65" type="text" size="70" placeholder="%%title%% %%sep%% %%sitename%%" value="<?=$page_seo_title?>" /><br>
	        <small>The title element of a web page is meant to be an accurate and concise description of a page's content. This element is critical to both user experience and search engine optimization. It creates value in three specific areas: relevancy, browsing, and in the search engine results pages. The suggested format for SEO titles is "Primary Keyword - Secondary Keyword | Brand Name". <a href="https://moz.com/learn/seo/title-tag">More on title tags here</a></small>
	    </p>
	    
	    <p>
	        <label for="page_seo_description">Meta Description</label><br>
	        <textarea id="page_seo_description" name="page_seo_description" cols="70" rows="4" maxlength="165"><?=$page_seo_description?></textarea><br>
	        <small>Google announced in September of 2009 that neither meta descriptions nor meta keywords factor into Google's ranking algorithms for web search. Google uses meta descriptions to return results when searchers use advanced search operators to match meta tag content, as well as to pull preview snippets on search result pages, but it's important to note that meta descriptions do not to influence Google's ranking algorithms for normal web search. <a href="https://moz.com/learn/seo/meta-description">More info on Meta descriptions here</a></small>
	    </p>
	    <?php    
	}
	
	/**
	 * page_seo_options_meta_box_save function.
	 * 
	 * @access public
	 * @param mixed $post_id
	 * @return void
	 */
	public function page_seo_options_meta_box_save( $post_id )
	{
	    // Bail if we're doing an auto save
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	     
	    // if our nonce isn't there, or we can't verify it, bail
	    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'page_seo_options__meta_box_nonce' ) ) return;
	    
	    $page_seo_title = isset( $_POST['page_seo_title'] )? $_POST['page_seo_title'] : '';
	    $page_seo_description = isset( $_POST['page_seo_description'] )? $_POST['page_seo_description'] : '';
	    update_post_meta( $post_id, 'page_seo_title', $page_seo_title );
	    update_post_meta( $post_id, 'page_seo_description', $page_seo_description );
	}
}

?>