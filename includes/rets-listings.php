<?php
	
//////////////////////
//
// Real Estate
//
//////////////////////

add_action( 'init', 'hiilite_listing_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function hiilite_listing_init() {
	$labels = array(
		'name'               => _x( 'Listings', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Listing', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Listings', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Listing', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Listing', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Listing', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Listing', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Listing', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Listings', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Listings', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Listings:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No listings found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No listings found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'listing' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
	);

	register_post_type( 'listing', $args );
	
	
	register_taxonomy(
		'status',
		'listing',
		array(
			'label' => __( 'Site Status' ),
			'rewrite' => array( 'slug' => 'status' ),
			'hierarchical' => true,
		)
	);
	
}

function listing_meta_box_markup($object)
{
	global $post;
	
	$gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
    <div id="dynamic_form">
 
	    <div id="field_wrap">
	    <?php 
	    if ( isset( $gallery_data['image_url'] ) ) 
	    {
	        for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ) 
	        {
	        ?>
	 
	        <div class="field_row">
	 
	          <div class="field_left">
	            <div class="form_field">
	              <label>Image URL</label>
	              <input type="text"
	                     class="meta_image_url"
	                     name="gallery[image_url][]"
	                     value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
	              />
	            </div>
	          </div>
	 
	          <div class="field_right image_wrap">
	            <img src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="48" width="48" />
	          </div>
	 
	          <div class="field_right">
	            <input class="button" type="button" value="Choose File" onclick="add_image(this)" /><br />
	            <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
	          </div>
	 
	          <div class="clear" /></div> 
	        </div>
	        <?php
	        } // endif
	    } // endforeach
	    ?>
	    </div>
	    <style type="text/css">
      .field_left {
        float:left;
      }
 
      .field_right {
        float:left;
        margin-left:10px;
      }
 
      .clear {
        clear:both;
      }
 
      #dynamic_form {
        width:580px;
      }
 
      #dynamic_form input[type=text] {
        width:300px;
      }
 
      #dynamic_form .field_row {
        border:1px solid #999;
        margin-bottom:10px;
        padding:10px;
      }
 
      #dynamic_form label {
        padding:0 6px;
      }
    </style>
 
    <script type="text/javascript">
        function add_image(obj) {
            var parent=jQuery(obj).parent().parent('div.field_row');
            var inputField = jQuery(parent).find("input.meta_image_url");
 
            tb_show('', 'media-upload.php?TB_iframe=true');
 
            window.send_to_editor = function(html) {
                var url = jQuery(html).find('img').attr('src');
                inputField.val(url);
                jQuery(parent)
                .find("div.image_wrap")
                .html('<img src="'+url+'" height="48" width="48" />');
 
                // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 
 
                tb_remove();
            };
 
            return false;  
        }
 
        function remove_field(obj) {
            var parent=jQuery(obj).parent().parent();
            //console.log(parent)
            parent.remove();
        }
 
        function add_field_row() {
            var row = jQuery('#master-row').html();
            jQuery(row).appendTo('#field_wrap');
        }
    </script>
	 
	    <div style="display:none" id="master-row">
	    <div class="field_row">
	        <div class="field_left">
	            <div class="form_field">
	                <label>Image URL</label>
	                <input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
	            </div>
	        </div>
	        <div class="field_right image_wrap">
	        </div> 
	        <div class="field_right"> 
	            <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
	            <br />
	            <input class="button" type="button" value="Remove" onclick="remove_field(this)" /> 
	        </div>
	        <div class="clear"></div>
	    </div>
	    </div>
	 
	    <div id="add_field_row">
	      <input class="button" type="button" value="Add Field" onclick="add_field_row();" />
	    </div>
	 
	</div>

        <div>
	        <p>
            	<label for="_listing[property-roof]">Roof</label>
            	<input name="_listing[property-roof]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-roof", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-cooling]">cooling</label>
            	<input name="_listing[property-cooling]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-cooling", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-style]">style</label>
            	<input name="_listing[property-style]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-style", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-area]">area</label>
            	<input name="_listing[property-area]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-area", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-bathsFull]">bathsFull</label>
            	<input name="_listing[property-bathsFull]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-bathsFull", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-bathsHalf]">bathsHalf</label>
            	<input name="_listing[property-bathsHalf]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-bathsHalf", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-stories]">stories</label>
            	<input name="_listing[property-stories]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-stories", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-fireplaces]">fireplaces</label>
            	<input name="_listing[property-fireplaces]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-fireplaces", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-flooring]">flooring</label>
            	<input name="_listing[property-flooring]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-flooring", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-heating]">heating</label>
            	<input name="_listing[property-heating]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-heating", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-bathrooms]">bathrooms</label>
            	<input name="_listing[property-bathrooms]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-bathrooms", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-foundation]">foundation</label>
            	<input name="_listing[property-foundation]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-foundation", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-laundryFeatures]">laundryFeatures</label>
            	<input name="_listing[property-laundryFeatures]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-laundryFeatures", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-occupantName]">occupantName</label>
            	<input name="_listing[property-occupantName]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-occupantName", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-lotDescription]">occupantName</label>
            	<input name="_listing[property-lotDescription]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-lotDescription", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-subType]">subType</label>
            	<input name="_listing[property-subType]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-subType", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-bedrooms]">bedrooms</label>
            	<input name="_listing[property-bedrooms]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-bedrooms", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-interiorFeatures]">interiorFeatures</label>
            	<input name="_listing[property-interiorFeatures]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-interiorFeatures", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-lotSize]">lotSize</label>
            	<input name="_listing[property-lotSize]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-lotSize", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-areaSource]">lotSize</label>
            	<input name="_listing[property-areaSource]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-areaSource", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-additionalRooms]">additionalRooms</label>
            	<input name="_listing[property-additionalRooms]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-additionalRooms", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-exteriorFeatures]">exteriorFeatures</label>
            	<input name="_listing[property-exteriorFeatures]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-exteriorFeatures", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-water]">water</label>
            	<input name="_listing[property-water]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-water", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-view]">view</label>
            	<input name="_listing[property-view]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-view", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-subdivision]">subdivision</label>
            	<input name="_listing[property-subdivision]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-subdivision", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-construction]">construction</label>
            	<input name="_listing[property-construction]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-construction", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-type]">type</label>
            	<input name="_listing[property-type]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-type", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-accessibility]">accessibility</label>
            	<input name="_listing[property-accessibility]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-accessibility", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-occupantType]">occupantType</label>
            	<input name="_listing[property-occupantType]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-occupantType", true); ?>">
	        </p>
	        
	        <p>
            	<label for="_listing[property-yearBuilt]">yearBuilt</label>
            	<input name="_listing[property-yearBuilt]" type="text" value="<?php echo get_post_meta($object->ID, "_listing-property-yearBuilt", true); ?>">
	        </p>
	        
	        
	        <p>
            	<label for="_listing[mlsId]">mlsId</label>
            	<input name="_listing[mlsId]" type="text" value="<?=get_post_meta($object->ID, "_listing-mlsId", true)?>">
	        </p>
	        
	        <p>
            	<label for="_listing[terms]">terms</label>
            	<input name="_listing[terms]" type="text" value="<?=get_post_meta($object->ID, "_listing-terms", true)?>">
	        </p>
	        
	        <p>
            	<label for="_listing[showingInstructions]">showingInstructions</label>
            	<input name="_listing[showingInstructions]" type="text" value="<?=get_post_meta($object->ID, "_listing-showingInstructions", true)?>">
	        </p>
	        
	        <p>
            	<label for="_listing[office-name]">office name</label>
            	<input name="_listing[office-name]" type="text" value="<?=get_post_meta($object->ID, "_listing-office-name", true)?>">
	        </p>
	        <p>
            	<label for="_listing[office-name]">office name</label>
            	<input name="_listing[office-name]" type="text" value="<?=get_post_meta($object->ID, "_listing-office-name", true)?>">
	        </p>
	        <p>
            	<label for="_listing[office-servingName]">office servingName</label>
            	<input name="_listing[office-servingName]" type="text" value="<?=get_post_meta($object->ID, "_listing-office-servingName", true)?>">
	        </p>
	        <p>
            	<label for="_listing[office-brokerid]">office brokerid</label>
            	<input name="_listing[office-brokerid]" type="text" value="<?=get_post_meta($object->ID, "_listing-office-brokerid", true)?>">
	        </p>
	        
	        <p>
            	<label for="_listing[leaseTerm]">leaseTerm</label>
            	<input name="_listing[leaseTerm]" type="text" value="<?=get_post_meta($object->ID, "_listing-leaseTerm", true)?>">
	        </p>
	        
	        <p>
            	<label for="_listing[disclaimer]">disclaimer</label>
            	<input name="_listing[disclaimer]" type="text" value="<?=get_post_meta($object->ID, "_listing-disclaimer", true)?>">
	        </p>
	        
	        <p>
            	<label for="_listing[address-crossStreet]">address crossStreet</label>
            	<input name="_listing[address-crossStreet]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-crossStreet", true)?>">
	        </p>
	        <p>
            	<label for="_listing[address-state]">address state</label>
            	<input name="_listing[address-state]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-state", true)?>">
	        </p>
	        <p>
            	<label for="_listing[address-country]">address country</label>
            	<input name="_listing[address-country]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-country", true)?>">
	        </p>
	        <p>
            	<label for="_listing[address-postalCode]">address postalCode</label>
            	<input name="_listing[address-postalCode]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-postalCode", true)?>">
	        </p>
	        <p>
            	<label for="_listing[address-streetName]">address streetName</label>
            	<input name="_listing[address-streetName]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-streetName", true)?>">
	        </p>	
	        <p>
            	<label for="_listing[address-city]">address city</label>
            	<input name="_listing[address-city]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-city", true)?>">
	        </p>
	        <p>
            	<label for="_listing[address-streetNumber]">address streetNumber</label>
            	<input name="_listing[address-streetNumber]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-streetNumber", true)?>">
	        </p>
	        <p>
            	<label for="_listing[address-full]">address full</label>
            	<input name="_listing[address-full]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-full", true)?>">
	        </p>
	        <p>
            	<label for="_listing[address-unit]">address unit</label>
            	<input name="_listing[address-unit]" type="text" value="<?=get_post_meta($object->ID, "_listing-address-unit", true)?>">
	        </p>
	        
	        <p>
            	<label for="_listing[listDate]">listDate</label>
            	<input name="_listing[listDate]" type="text" value="<?=get_post_meta($object->ID, "_listing-listDate", true)?>">
	        </p>
	        
	        <p><label for="_listing[agent-lastName]">agent lastName</label>
            <input name="_listing[agent-lastName]" type="text" value="<?=get_post_meta($object->ID, "_listing-agent-lastName", true)?>"></p>
            <p><label for="_listing[agent-contact]">agent contact</label>
            <input name="_listing[agent-contact]" type="text" value="<?=get_post_meta($object->ID, "_listing-agent-contact", true)?>"></p>
            <p><label for="_listing[agent-firstName]">agent firstName</label>
            <input name="_listing[agent-firstName]" type="text" value="<?=get_post_meta($object->ID, "_listing-agent-firstName", true)?>"></p>
            <p><label for="_listing[agent-id]">agent id</label>
            <input name="_listing[agent-id]" type="text" value="<?=get_post_meta($object->ID, "_listing-agent-id", true)?>"></p>
            
            <p><label for="_listing[modified]">modified</label>
            <input name="_listing[modified]" type="text" value="<?=get_post_meta($object->ID, "_listing-modified", true)?>"></p>
            
            <p><label for="_listing[school-middleSchool]">school middleSchool</label>
            <input name="_listing[school-middleSchool]" type="text" value="<?=get_post_meta($object->ID, "_listing-school-middleSchool", true)?>"></p>
            <p><label for="_listing[school-highSchool]">school highSchool</label>
            <input name="_listing[school-highSchool]" type="text" value="<?=get_post_meta($object->ID, "_listing-school-highSchool", true)?>"></p>
            <p><label for="_listing[school-elementarySchool]">school elementarySchool</label>
            <input name="_listing[school-elementarySchool]" type="text" value="<?=get_post_meta($object->ID, "_listing-school-elementarySchool", true)?>"></p>
            <p><label for="_listing[school-district]">school district</label>
            <input name="_listing[school-district]" type="text" value="<?=get_post_meta($object->ID, "_listing-school-district", true)?>"></p>
            
            <p><label for="_listing[photos]">photos</label>
            <input name="_listing[photos]" type="text" value="<?=get_post_meta($object->ID, "_listing-photos", true)?>"></p>
            
            <p><label for="_listing[listPrice]">listPrice</label>
            <input name="_listing[listPrice]" type="text" value="<?=get_post_meta($object->ID, "_listing-listPrice", true)?>"></p>
            
            <p><label for="_listing[listingId]">listingId</label>
            <input name="_listing[listingId]" type="text" value="<?=get_post_meta($object->ID, "_listing-listingId", true)?>"></p>
            
            <p><label for="_listing[mls-status]">mls status</label>
            <input name="_listing[mls-status]" type="text" value="<?=get_post_meta($object->ID, "_listing-mls-status", true)?>"></p>
            <p><label for="_listing[mls-area]">mls area</label>
            <input name="_listing[mls-area]" type="text" value="<?=get_post_meta($object->ID, "_listing-mls-area", true)?>"></p>
            <p><label for="_listing[mls-daysOnMarket]">mls daysOnMarket</label>
            <input name="_listing[mls-daysOnMarket]" type="text" value="<?=get_post_meta($object->ID, "_listing-mls-daysOnMarket", true)?>"></p>
            
            <p><label for="_listing[geo-county]">geo county</label>
            <input name="_listing[geo-county]" type="text" value="<?=get_post_meta($object->ID, "_listing-geo-county", true)?>"></p>
            <p><label for="_listing[geo-lat]">geo lat</label>
            <input name="_listing[geo-lat]" type="text" value="<?=get_post_meta($object->ID, "_listing-geo-lat", true)?>"></p>
            <p><label for="_listing[geo-lng]">geo lng</label>
            <input name="_listing[geo-lng]" type="text" value="<?=get_post_meta($object->ID, "_listing-geo-lng", true)?>"></p>
            <p><label for="_listing[geo-marketArea]">geo marketArea</label>
            <input name="_listing[geo-marketArea]" type="text" value="<?=get_post_meta($object->ID, "_listing-geo-marketArea", true)?>"></p>
            <p><label for="_listing[geo-directions]">geo directions</label>
            <input name="_listing[geo-directions]" type="text" value="<?=get_post_meta($object->ID, "_listing-geo-directions", true)?>"></p>
            
            <p><label for="_listing[tax-id]">tax id</label>
            <input name="_listing[tax-id]" type="text" value="<?=get_post_meta($object->ID, "_listing-tax-id", true)?>"></p>
            
            <p><label for="_listing[leaseType]">leaseType</label>
            <input name="_listing[leaseType]" type="text" value="<?=get_post_meta($object->ID, "_listing-leaseType", true)?>"></p>
	        
	        <p><label for="_listing[remarks]">remarks</label>
            <input name="_listing[remarks]" type="text" value="<?=get_post_meta($object->ID, "_listing-remarks", true)?>"></p>
	                
            <hr>

        </div>
    <?php  
    
}

function add_listing_meta_box()
{
    add_meta_box("listing-meta-box", "Listing Info", "listing_meta_box_markup", "listing", "normal", "high", null);
}

add_action("add_meta_boxes", "add_listing_meta_box");


function save_listing_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "listing";
    if($slug != $post->post_type)
        return $post_id;


	$_listing_meta = $_POST["_listing"];
    if(isset($_listing_meta)){
        foreach($_listing_meta as $key => $value){
	        update_post_meta($post_id, "_listing-".$key, $value);
        }
    } 
    
    if ( $_POST['gallery'] ) 
    {
        // Build array for saving post meta
        $gallery_data = array();
        for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ) 
        {
            if ( '' != $_POST['gallery']['image_url'][ $i ] ) 
            {
                $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
            }
        }
 
        if ( $gallery_data ) 
            update_post_meta( $post_id, 'gallery_data', $gallery_data );
        else 
            delete_post_meta( $post_id, 'gallery_data' );
    } 
    // Nothing received, all fields are empty, delete option
    else 
    {
        delete_post_meta( $post_id, 'gallery_data' );
    }
}

add_action("save_post", "save_listing_meta_box", 10, 3);



///////////////////////
//
//	SEARCH PAGE
//
//////////////////////

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');
 
function wpdocs_register_my_custom_submenu_page() {
    add_submenu_page(
        'edit.php?post_type=listing',
        'Search Listings',
        'Search Listings',
        'manage_options',
        'search-listings',
        'wpdocs_my_custom_submenu_page_callback' );
}

function wpdocs_my_custom_submenu_page_callback() {
	$postTitleError = '';
 
	if ( isset( $_POST['submitted'] ) ) {
		//echo '<pre>';
		//print_r($_POST);
	 
	    if ( trim( $_POST['postTitle'] ) === '' ) {
	        $postTitleError = 'Please enter a title.';
	        $hasError = true;
	    }
	    
	    $_listing_arrs = null;
	    $_listing_meta = $_POST["_listing"];
	    
	    if(isset($_listing_meta)){
	        foreach($_listing_meta as $key => $value){
		        $_listing_arrs["_listing-".$key] = $value;
	        }
	    }
	    
	    if($hasError){
		    print_r('error');
	    }
	    $post_information = array(
	        'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
	        'post_content' => $_POST['postContent'],
	        'post_type' => 'listing',
	        'post_status' => 'pending',
	        'meta_input' => $_listing_arrs
	        );
	        
	    
        
        
        if($post_id = wp_insert_post( $post_information )) {
	        
	        
	        ///////////////////////////////
	        //
	        // Add Featured Image to Post
	        //
	        ///////////////////////////////
			$image_url  = $_POST['featuredImage']; // Define the image URL here
			$upload_dir = wp_upload_dir(); // Set upload folder
			$image_data = file_get_contents($image_url); // Get image data
			$filename   = basename($image_url); // Create image file name
			
			// Check folder permission and define file location
			if( wp_mkdir_p( $upload_dir['path'] ) ) {
			    $file = $upload_dir['path'] . '/' . $filename;
			} else {
			    $file = $upload_dir['basedir'] . '/' . $filename;
			}
			
			// Create the image  file on the server
			file_put_contents( $file, $image_data );
			
			// Check image file type
			$wp_filetype = wp_check_filetype( $filename, null );
			
			// Set attachment data
			$attachment = array(
			    'post_mime_type' => $wp_filetype['type'],
			    'post_title'     => sanitize_file_name( $filename ),
			    'post_content'   => '',
			    'post_status'    => 'inherit'
			);
			
			// Create the attachment
			$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
			
			// Include image.php
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			
			// Define attachment metadata
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			
			// Assign metadata to attachment
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			// And finally assign featured image to post
			set_post_thumbnail( $post_id, $attach_id );
		}
	} 
	if(isset($_GET['mlsId']) && isset($_GET['mlsId']) && $_GET['mlsId'] != ''){
		$mlsid = $_GET['mlsId'];
		$remote_url = 'https://api.simplyrets.com/properties?q='.$mlsid.'&limit=50';
	} else {
		if(isset($_GET['offset'])) $offset = $_GET['offset']; else $offset = 0;
		$remote_url = 'https://api.simplyrets.com/properties?limit=50&include=rooms&offset='.$offset;
	}
	
	
	
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Search Your MLS</h2>';
        
    $username = "peter_v5313125";
	$password = "28963z4044684801";
	
	
	$opts = array(
	    'http'=>array(
	        'method'=>"GET",
	        'header' => "Authorization: Basic " . base64_encode("$username:$password")
	    )
	);
	$context = stream_context_create($opts);
	$file = json_decode(file_get_contents($remote_url, false, $context));
	?>
	<form action="">
		<input type="hidden" value="listing" name="post_type">
		<input  type="hidden" value="search-listings" name="page">
		<input type="search" name="mlsId">
		<input type="submit" value="Search" name="search">
	</form><?php
	//if(count($file) > 1){
	foreach($file as $property):
	
		echo '<div>';
		?>
		<form action="" id="primaryPostForm" method="POST">
		 	<table>
			 	<tr>
				 	<td><?='<img src="'.$property->photos[0].'" width=100 height=100>';?></td>
				 	<td><?='<span class="">'.$property->mlsId.'</span>';?><br>
					 	<?='<span class="property_mlsId">'.$property->listingId.'</span>';?><br>
				 		<input type="text" name="postTitle" id="postTitle" value="<?=$property->address->full?>" readonly="readonly" />
				 	</td>
				 	<td>
					 	<?php if(!post_exists($property->address->full)){ ?>
					 	<button type="submit"><?php _e('Add as own', 'framework') ?></button>
					 	<?php } ?>
				 	</td>
			 	</tr>
		 	</table>
		 	<details>
			 	<summary>See Data</summary>
		 		<pre><?php print_r($property); ?></pre>
		 	</details>
			<input type="hidden" value="<?=$property->photos[0]?>" name="featuredImage" id="featuredImage" >
			<input type="hidden" value="<?=$property->remarks?>" name="postContent" id="postContent" >
	        
	        <?php 
	        foreach($property as $key => $value){
		        if(!is_array($value) && !is_object($value)) {
			        ?><input type="hidden" value="<?=$value?>" name="<?='_listing['.$key?>]"><?php
		        } elseif(is_object($value) || is_array($value)) {
			        foreach($value as $ok => $ov){
				        if(!is_array($ov) && !is_object($ov)) {
				        	?><input type="hidden" value="<?=$ov;?>" name="<?='_listing['.$key.'-'.$ok;?>]"><?php
					    }
			        }
		        }
	        }   
	        ?>
		    <input type="hidden" name="submitted" id="submitted" value="true" />
		 
		</form>
	
		<?php
		echo '</div><hr>';
	endforeach;
	/*} else {
		$property = $file;
		echo '<div>';
		?>
		<form action="" id="primaryPostForm" method="POST">
		 	<table>
			 	<tr>
				 	<td><?='<img src="'.$property->photos[0].'" width=100 height=100>';?></td>
				 	<td><?='<span class="">'.$property->mlsId.'</span>';?><br>
					 	<?='<span class="property_mlsId">'.$property->listingId.'</span>';?><br>
				 		<input type="text" name="postTitle" id="postTitle" value="<?=$property->address->full?>" readonly="readonly" />
				 	</td>
				 	<td>
					 	<?php if(!post_exists($property->address->full)){ ?>
					 	<button type="submit"><?php _e('Add as own', 'framework') ?></button>
					 	<?php } ?>
				 	</td>
			 	</tr>
		 	</table>
		 	<details>
			 	<summary>See Data</summary>
		 		<pre><?php print_r($property); ?></pre>
		 	</details>
			<input type="hidden" value="<?=$property->photos[0]?>" name="featuredImage" id="featuredImage" >
			<input type="hidden" value="<?=$property->remarks?>" name="postContent" id="postContent" >
	        
	        <?php 
	        foreach($property as $key => $value){
		        if(!is_array($value) && !is_object($value)) {
			        ?><input type="hidden" value="<?=$value?>" name="<?='_listing['.$key?>]"><?php
		        } elseif(is_object($value) || is_array($value)) {
			        foreach($value as $ok => $ov){
				        if(!is_array($ov) && !is_object($ov)) {
				        	?><input type="hidden" value="<?=$ov;?>" name="<?='_listing['.$key.'-'.$ok;?>]"><?php
					    }
			        }
		        }
	        }   
	        ?>
		    <input type="hidden" name="submitted" id="submitted" value="true" />
		 
		</form>
	
		<?php
		echo '</div><hr>';
	}*/
	?><a href="?post_type=listing&page=search-listings&offset=<?=($offset - 50);?>">Prev</a> | <a href="?post_type=listing&page=search-listings&offset=<?=$offset += 50;?>">Next</a><?php
    echo '</div>';
}