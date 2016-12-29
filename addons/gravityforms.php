<?php


add_filter( 'gform_add_field_buttons', 'add_hiigf_rangeslider_field' );
function add_hiigf_rangeslider_field( $field_groups ) {
	foreach( $field_groups as &$group ){
		if( $group["name"] == "advanced_fields" ){ // to add to the Advanced Fields
			$group["fields"][] = array(
				"class" => "button",
				"data-type"	=> "rangeslider",
				"value" => __("Range Slider", "hiiwp"),
				"onclick" => "StartAddField('rangeslider');"
			);
			break;
		}
	}
	return $field_groups;
}

add_filter( 'gform_field_type_title' , 'hiigf_rangeslider_title' );
function hiigf_rangeslider_title( $type ) {
	if ( $type == 'rangeslider' )
		return __( 'Range Slider' , 'hiiwp' );
}


// Adds the input area to the external side
add_action( "gform_field_input" , "hiigf_rangeslider_field_input", 10, 5 );
function hiigf_rangeslider_field_input ( $input, $field, $value, $lead_id, $form_id ){

	if ( $field["type"] == "rangeslider" ) {
		$max_chars = "";
		if(!IS_ADMIN && !empty($field["maxLength"]) && is_numeric($field["maxLength"]))
			$max_chars = self::get_counter_script($form_id, $field_id, $field["maxLength"]);
		
		$input_name = $form_id .'_' . $field["id"];
		$tabindex = GFCommon::get_tabindex();
		$css = isset( $field['cssClass'] ) ? $field['cssClass'] : '';
		
		return sprintf("<div class='ginput_container'><textarea name='input_%s' id='%s' class='textarea gform_rangeslider %s' $tabindex rows='10' cols='50'>%s</textarea></div>{$max_chars}", $field["id"], 'rangeslider-'.$field['id'] , $field["type"] . ' ' . esc_attr( $css ) . ' ' . $field['size'] , esc_html($value));
		
	}
	
	return $input;
}



// Now we execute some javascript technicalitites for the field to load correctly
add_action( "gform_editor_js", "hiigf_gform_editor_js" );
function hiigf_gform_editor_js(){
	?>
	
	<script type=’text/javascript’>
	
	jQuery(document).ready(function($) {
		//Add all textarea settings to the "TOS" field plus custom "tos_setting"
		// fieldSettings["rangeslider"] = fieldSettings["textarea"] + ", .rangeslider_setting"; // this will show all fields that Paragraph Text field shows plus my custom setting
		
		// from forms.js; can add custom "rangeslider_setting" as well
		fieldSettings["rangeslider"] = ".label_setting, .description_setting, .admin_label_setting, .size_setting, .default_value_textarea_setting, .error_message_setting, .css_class_setting, .visibility_setting, .rangeslider_setting"; //this will show all the fields of the Paragraph Text field minus a couple that I didn’t want to appear.
		
		//binding to the load field settings event to initialize the checkbox
		$(document).bind("gform_load_field_settings", function(event, field, form){
			jQuery("#field_rangeslider").attr("checked", field["field_rangeslider"] == true);
			$("#field_rangeslider_value").val(field["rangeslider"]);
		});
	});
	
	</script>
	<?php
}


// Add a custom setting to the tos advanced field
add_action( "gform_field_advanced_settings" , "hiigf_rangeslider_settings" , 10, 2 );
function hiigf_rangeslider_settings( $position, $form_id ){

	// Create settings on position 50 (right after Field Label)
	if( $position == 50 ){ ?>
		<li class="rangeslider_setting field_setting">
		
			<input type="checkbox" id="field_rangeslider" onclick="SetFieldProperty('field_rangeslider', this.checked);" />
			<label for="field_rangeslider" class="inline">
				<?php _e("Disable Submit Button", "gravityforms"); ?>
				<?php gform_tooltip("form_field_rangeslider"); ?>
			</label>
		
		</li>
	<?php
	}
}
?>