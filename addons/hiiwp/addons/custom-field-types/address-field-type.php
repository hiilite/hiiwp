<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
 * Author: jtsternberg
 * Author URI: http://dsgnwrks.pro
 * Version: 0.1.0
 */

/**
 * Template tag for displaying an address from the CMB2 address field type (on the front-end)
 *
 * @since  0.1.0
 *
 * @param  string  $metakey The 'id' of the 'address' field (the metakey for get_post_meta)
 * @param  integer $post_id (optional) post ID. If using in the loop, it is not necessary
 */
function jt_cmb2_address_field( $metakey, $post_id = 0 ) {
	echo jt_cmb2_get_address_field( $metakey, $post_id );
}

/**
 * Template tag for returning an address from the CMB2 address field type (on the front-end)
 *
 * @since  0.1.0
 *
 * @param  string  $metakey The 'id' of the 'address' field (the metakey for get_post_meta)
 * @param  integer $post_id (optional) post ID. If using in the loop, it is not necessary
 */
function jt_cmb2_get_address_field( $metakey, $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$address = get_post_meta( $post_id, $metakey, 1 );

	// Set default values for each address key
	$address = wp_parse_args( $address, array(
		'StreetAddress' => '',
		'AddressLine1' => '',
		'City'      => '',
		'Province'     => '',
		'PostalCode'       => '',
	) );

	$output = '<div class="cmb2-address">';
	$output .= '<p><strong>Address:</strong> ' . esc_html( $address['StreetAddress'] ) . '</p>';
	if ( $address['AddressLine1'] ) {
		$output .= '<p>' . esc_html( $address['AddressLine1'] ) . '</p>';
	}
	$output .= '<p><strong>City:</strong> ' . esc_html( $address['City'] ) . '</p>';
	$output .= '<p><strong>Province:</strong> ' . esc_html( $address['Province'] ) . '</p>';
	$output .= '<p><strong>PostalCode:</strong> ' . esc_html( $address['PostalCode'] ) . '</p>';
	$output = '</div><!-- .cmb2-address -->';

	return apply_filters( 'jt_cmb2_get_address_field', $output );
}

/**
 * Render 'address' custom field type
 *
 * @since 0.1.0
 *
 * @param array  $field              The passed in `CMB2_Field` object
 * @param mixed  $value              The value of this field escaped.
 *                                   It defaults to `sanitize_text_field`.
 *                                   If you need the unescaped value, you can access it
 *                                   via `$field->value()`
 * @param int    $object_id          The ID of the current object
 * @param string $object_type        The type of object you are working with.
 *                                   Most commonly, `post` (this applies to all post-types),
 *                                   but could also be `comment`, `user` or `options-page`.
 * @param object $field_type_object  The `CMB2_Types` object
 */
function jt_cmb2_render_address_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	// can override via the field options param
	$select_text = esc_html( $field_type_object->_text( 'address_select_state_text', 'Select a Province' ) );

	$canadian_states = array( 
		''	 => $select_text,
	    "BC" => "British Columbia", 
	    "ON" => "Ontario", 
	    "NL" => "Newfoundland and Labrador", 
	    "NS" => "Nova Scotia", 
	    "PE" => "Prince Edward Island", 
	    "NB" => "New Brunswick", 
	    "QC" => "Quebec", 
	    "MB" => "Manitoba", 
	    "SK" => "Saskatchewan", 
	    "AB" => "Alberta", 
	    "NT" => "Northwest Territories", 
	    "NU" => "Nunavut",
	    "YT" => "Yukon Territory"
	);

	$state_list = array( ''=>$select_text,'AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District Of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming' );

	// make sure we specify each part of the value we need.
	$value = wp_parse_args( $value, array(
		'StreetAddress' => '',
		'AddressLine1' => '',
		'City'      => '',
		'Province'     => '',
		'PostalCode'       => '',
		'country'			=> '',
	) );

	$state_options = '';
	foreach ( $canadian_states as $abrev => $state ) {
		$state_options .= '<option value="'. $abrev .'" '. selected( $value['Province'], $abrev, false ) .'>'. $state .'</option>';
	}

	?>
	<div><p><label for="<?php echo $field_type_object->_id( '_StreetAddress' ); ?>"><?php echo esc_html( $field_type_object->_text( 'address_address_1_text', 'Address 1' ) ); ?></label></p>
		<?php echo $field_type_object->input( array(
			'name'  => $field_type_object->_name( '[StreetAddress]' ),
			'id'    => $field_type_object->_id( '_StreetAddress' ),
			'value' => $value['StreetAddress'],
			'desc'  => '',
		) ); ?>
	</div>
	<div><p><label for="<?php echo $field_type_object->_id( '_address_2' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'address_address_2_text', 'Address 2' ) ); ?></label></p>
		<?php echo $field_type_object->input( array(
			'name'  => $field_type_object->_name( '[AddressLine1]' ),
			'id'    => $field_type_object->_id( '_address_2' ),
			'value' => $value['AddressLine1'],
			'desc'  => '',
		) ); ?>
	</div>
	<div><p><label for="<?php echo $field_type_object->_id( '_City' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'address_city_text', 'City' ) ); ?></label></p>
		<?php echo $field_type_object->input( array(
			'name'  => $field_type_object->_name( '[City]' ),
			'id'    => $field_type_object->_id( '_City' ),
			'value' => $value['City'],
			'desc'  => '',
		) ); ?>
	</div>
	<div><p><label for="<?php echo $field_type_object->_id( '_Province' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'address_state_text', 'Province' ) ); ?></label></p>
		<?php echo $field_type_object->select( array(
			'name'    => $field_type_object->_name( '[Province]' ),
			'id'      => $field_type_object->_id( '_Province' ),
			'options' => $state_options,
			'desc'    => '',
		) ); ?>
	</div>
	<div><p><label for="<?php echo $field_type_object->_id( '_country' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'address_country_text', 'Country' ) ); ?></label></p>
		<?php echo $field_type_object->input( array(
			'name'  => $field_type_object->_name( '[country]' ),
			'id'    => $field_type_object->_id( '_country' ),
			'value' => $value['country'],
			'desc'  => '',
		) ); ?>
	</div>
	<div><p><label for="<?php echo $field_type_object->_id( '_PostalCode' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'address_zip_text', 'PostalCode' ) ); ?></label></p>
		<?php echo $field_type_object->input( array(
			'name'  => $field_type_object->_name( '[PostalCode]' ),
			'id'    => $field_type_object->_id( '_PostalCode' ),
			'value' => $value['PostalCode'],
			'type'  => 'text',
			'desc'  => '',
		) ); ?>
	</div>
	<p class="clear">
		<?php echo $field_type_object->_desc();?>
	</p>
	<?php
}
add_filter( 'cmb2_render_address', 'jt_cmb2_render_address_field_callback', 10, 5 );

/**
 * Optionally save the Address values into separate fields
 */
function cmb2_split_address_values( $override_value, $value, $object_id, $field_args ) {
	if ( ! isset( $field_args['split_values'] ) || ! $field_args['split_values'] ) {
		// Don't do the override
		return $override_value;
	}

	$address_keys = array( 'StreetAddress', 'AddressLine1', 'City', 'Province', 'PostalCode' );

	foreach ( $address_keys as $key ) {
		if ( ! empty( $value[ $key ] ) ) {
			update_post_meta( $object_id, $field_args['id'] . 'addr_'. $key, $value[ $key ] );
		}
	}

	// Tell CMB2 we already did the update
	return true;
}
add_filter( 'cmb2_sanitize_address', 'cmb2_split_address_values', 12, 4 );

/**
 * The following snippets are required for allowing the address field
 * to work as a repeatable field, or in a repeatable group
 */

function cmb2_sanitize_address_field( $check, $meta_value, $object_id, $field_args, $sanitize_object ) {

	// if not repeatable, bail out.
	if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
		return $check;
	}

	foreach ( $meta_value as $key => $val ) {
		$meta_value[ $key ] = array_filter( array_map( 'sanitize_text_field', $val ) );
	}

	return array_filter($meta_value);
}
add_filter( 'cmb2_sanitize_address', 'cmb2_sanitize_address_field', 10, 5 );

function cmb2_types_esc_address_field( $check, $meta_value, $field_args, $field_object ) {
	// if not repeatable, bail out.
	if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
		return $check;
	}

	foreach ( $meta_value as $key => $val ) {
		$meta_value[ $key ] = array_filter( array_map( 'esc_attr', $val ) );
	}

	return array_filter($meta_value);
}
add_filter( 'cmb2_types_esc_address', 'cmb2_types_esc_address_field', 10, 4 );
