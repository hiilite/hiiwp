<?php
/////////////////////////
//
//	Add COMPANY PROFILE to Menu
//
/////////////////////////
$business_args = array(
	
	/*	
	*	COMPANY MAIN	
	*/
	array(
		'id'		=>'business_type',
		'title'		=>'Business Type',
		'callback'	=>'company_setting_schema',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_name',
		'title'		=>'Business Name',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_telephone',
		'title'		=>'Phone Number',
		'callback'	=>'company_setting_phone',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_contactType',
		'title'		=>'Contact Type',
		'callback'	=>'company_setting_contactType',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_faxNumber',
		'title'		=>'Fax Number',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_email',
		'title'		=>'Email',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_logo',
		'title'		=>'Logo',
		'callback'	=>'company_setting_logo',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_url',
		'title'		=>'Website',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_description',
		'title'		=>'Description',
		'callback'	=>'company_setting_textarea',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
		
	/*	
	*	COMPANY STORE SETTINGS	
	*/
	
	array(
		'id'		=>'business_openingHoursSpecification',
		'title'		=>'Open Hours',
		'callback'	=>'company_setting_hours',
		'page'		=> 'company',
		'section'	=> 'company_store' ),
	array(
		'id'		=>'business_acceptsReservations',
		'title'		=>'Accepts Reservations',
		'callback'	=>'company_setting_trueFalse',
		'page'		=> 'company',
		'section'	=> 'company_store' ),
	
	array(
		'id'		=>'business_menu',
		'title'		=>'Menu URL',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_store' ),
		
	/*	
	*	COMPANY SOCIAL	
	*/
	array(
		'id'		=>'business_facebook',
		'title'		=>'Facebook',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_twitter',
		'title'		=>'Twitter',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_googleplus',
		'title'		=>'GooglePlus',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_instagram',
		'title'		=>'Instagram',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_linkedin',
		'title'		=>'LinkedIn',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_pinterest',
		'title'		=>'Pinterest',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_houzz',
		'title'		=>'Houzz',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_tripadvisor',
		'title'		=>'TripAdvisor',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_yelp',
		'title'		=>'Yelp',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_youtube',
		'title'		=>'YouTube',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_social' ),	
	
	/*	
	*	COMPANY ADDRESS	
	*/
	array(
		'id'		=>'business_streetAddress',
		'title'		=>'Street Address',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_addressLocality',
		'title'		=>'City',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_addressRegion',
		'title'		=>'Province',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_addressCountry',
		'title'		=>'Country',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_postalCode',
		'title'		=>'Postal Code',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_address' ),
		
	/*	
	*	COMPANY GEO	
	*/
	array(
		'id'		=>'business_geo_latitude',
		'title'		=>'Latitude',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_geo' ),
	array(
		'id'		=>'business_geo_longitude',
		'title'		=>'Longitude',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_geo' ),
	
	/*	
	*	COMPANY POTENTIAL ACTION	
	*/
	array(
		'id'		=>'business_potentialAction',
		'title'		=>'Activate',
		'callback'	=>'company_setting_trueFalse',
		'page'		=> 'company',
		'section'	=> 'company_action' ),
	array(
		'id'		=>'business_potentialAction_urlTemplate',
		'title'		=>'Action URL',
		'callback'	=>'company_setting_url',
		'page'		=> 'company',
		'section'	=> 'company_action' ),
	array(
		'id'		=>'business_potentialAction_resultType',
		'title'		=>'Action Type',
		'callback'	=>'company_setting_potentialAction_resultType',
		'page'		=> 'company',
		'section'	=> 'company_action' ),
	array(
		'id'		=>'business_potentialAction_name',
		'title'		=>'Action Name',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_action' ),
	/*
	*	PAGE VALIDATION
	*/
	array(
		'id'		=>'business_fb_article_claim',
		'title'		=>'Facebook Instant Articles ID',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'page_validation' ),
		
		
);

// create custom plugin settings menu
add_action('admin_menu', 'company_admin_add_page');

function company_admin_add_page() {
	$company_page = add_menu_page ( 'Company Profile', 'Company Profile', 'manage_options', 'company', 'company_options_page', 'dashicons-id-alt', 2 );
	
	//call register settings function
	add_action( 'admin_init', 'company_admin_init' );
	add_action('load-'.$company_page, 'company_page_help_tab');
}
function company_page_help_tab(){
	global $business_args;
	$shortcode_text = '<h1>Shortcodes</h1>
						<p>Use these to display the company info throughout the site</p>';
	foreach($business_args as $business){
		$shortcode_text .= $business['title'].' = ['.$business['id'].']<br>';
	}
	$screen = get_current_screen();
	$screen->add_help_tab( array(
		'id' => $screen->id,
		'title' => __('Shortcodes'),
		'content' => $shortcode_text,
	)
						 );
}


/*
*
*	Register all our business fields with the WordPress Setting API
*
*/
function company_admin_init() {
	global $business_args;
	//register our settings
	register_setting( 'company_options', 'company_options');
	add_settings_section('company_main', 'Main Settings', 'company_section_text', 'company');
	add_settings_section('company_social', 'Social Settings', 'company_section_text', 'company');
	add_settings_section('company_address', 'Address', 'company_section_text', 'company');
	add_settings_section('company_geo', 'Geo', 'company_section_text', 'company');
	add_settings_section('company_store', 'Store Settings', 'company_section_text', 'company');
	add_settings_section('company_action', 'Potential Action', 'company_section_text', 'company');	
	add_settings_section('page_validation', 'Site Validation', 'company_section_text', 'company');	
	
	foreach($business_args as $business){
		add_settings_field($business['id'], $business['title'], $business['callback'], $business['page'], $business['section'], array('name'=>$business['id']));
	}

}


/*
*
*	Loop through all business fields and add_shortcode for each
*
*/
foreach($business_args as $business){
	add_shortcode( $business['id'], 'generate_shortcodes');
}
function generate_shortcodes($atts, $content = '', $shortcode = ''){
 	$options = get_option('company_options');	
    return $options[$shortcode];
}



function company_section_text() {
	 echo '<hr>';
}

function company_setting_string($args) {
	$options = get_option('company_options');
	$value = isset($options[$args['name']])?$options[$args['name']]:'';
	echo "<input id='{$args['name']}' name='company_options[{$args['name']}]' size='40' type='text' value='{$value}' />";
} 

function company_setting_textarea($args) {
	$options = get_option('company_options');
	$value = isset($options[$args['name']])?$options[$args['name']]:'';
	echo "<textarea id='{$args['name']}' name='company_options[{$args['name']}]' cols='40' rows='3' maxlength='165'>{$value}</textarea>";
} 

function company_setting_url($args) {
	$options = get_option('company_options');
	$value = isset($options[$args['name']])?$options[$args['name']]:'';
	echo "<input id='{$args['name']}' name='company_options[{$args['name']}]' size='40' type='url' placeholder='ex: http://example.com/page_example' value='{$value}' />";
} 

function company_setting_phone($args) {
	$options = get_option('company_options');
	echo "<input id='{$args['name']}' name='company_options[{$args['name']}]' size='40' type='tel' placeholder='ex: +1-800-555-1212' value='{$options[$args['name']]}' />";
} 

function company_setting_trueFalse($args) {
	$options = get_option('company_options');

	$checked = (isset($options[$args['name']]) && $options[$args['name']] == 'True')?'checked=checked':'';
	echo "<input id='{$args['name']}' name='company_options[{$args['name']}]'  type='checkbox' value='True' {$checked} />";
} 

function company_setting_logo($args) {
   $options = get_option('company_options');
    ?>
	<input type="text" id="<?=$args['name']?>" name="company_options[<?=$args['name']?>]" value="<?=$options[$args['name']]?>" />
	<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'hiilite' ); ?>" />
	<span class="description"><?php _e('Upload an image for the logo.', 'hiilite' ); ?></span>
    <?php
}

function company_setting_hours($args){
	$options = get_option('company_options');
	
	$sets = isset($options['hoursets'])?$options['hoursets']:count($options[$args['name']]);
	?>
	
	<?php 

	for($i=0;$i < $sets;$i++):
	?>
	<div class="hii_company_setting_hours">
		
		<div class="hii_dayOfWeek" id="dayOfWeek<?=$i?>">
			<input type="checkbox" id="<?=$args['name']?>_<?=$i?>_sun" name="company_options[<?=$args['name']?>][<?=$i?>][dayOfWeek][]" value="Sunday">
				<label for="<?=$args['name']?>_<?=$i?>_sun">Sun</label>&nbsp;
			<input type="checkbox" id="<?=$args['name']?>_<?=$i?>_mon" name="company_options[<?=$args['name']?>][<?=$i?>][dayOfWeek][]" value="Monday">
				<label for="<?=$args['name']?>_<?=$i?>_mon">Mon</label>&nbsp;
			<input type="checkbox" id="<?=$args['name']?>_<?=$i?>_tue" name="company_options[<?=$args['name']?>][<?=$i?>][dayOfWeek][]" value="Tuesday">
				<label for="<?=$args['name']?>_<?=$i?>_tue">Tue</label>&nbsp;
			<input type="checkbox" id="<?=$args['name']?>_<?=$i?>_wed" name="company_options[<?=$args['name']?>][<?=$i?>][dayOfWeek][]" value="Wednesday">
				<label for="<?=$args['name']?>_<?=$i?>_wed">Wed</label>&nbsp;
			<input type="checkbox" id="<?=$args['name']?>_<?=$i?>_thu" name="company_options[<?=$args['name']?>][<?=$i?>][dayOfWeek][]" value="Thursday">
				<label for="<?=$args['name']?>_<?=$i?>_thu">Thu</label>&nbsp;
			<input type="checkbox" id="<?=$args['name']?>_<?=$i?>_fri" name="company_options[<?=$args['name']?>][<?=$i?>][dayOfWeek][]" value="Friday">
				<label for="<?=$args['name']?>_<?=$i?>_fri">Fri</label>&nbsp;
			<input type="checkbox" id="<?=$args['name']?>_<?=$i?>_sat" name="company_options[<?=$args['name']?>][<?=$i?>][dayOfWeek][]" value="Saturday">
				<label for="<?=$args['name']?>_<?=$i?>_sat">Sat</label>&nbsp;
		</div>
		<div class="hii_openingHours">
			<label for="<?=$args['name']?>_<?=$i?>_opens">Opens</label>
			<select name="company_options[<?=$args['name'];?>][<?=$i?>][opens]" id="<?=$args['name'];?>_<?=$i?>_opens">
				<option value=""></option>
				<option value="01:00">01:00</option>
				<option value="01:30">01:30</option>
				<option value="02:00">02:00</option>
				<option value="02:30">02:30</option>
				<option value="03:00">03:00</option>
				<option value="03:30">03:30</option>
				<option value="04:00">04:00</option>
				<option value="04:30">04:30</option>
				<option value="05:00">05:00</option>
				<option value="05:30">05:30</option>
				<option value="06:00">06:00</option>
				<option value="06:30">06:30</option>
				<option value="07:00">07:00</option>
				<option value="07:30">07:30</option>
				<option value="08:00">08:00</option>
				<option value="08:30">08:30</option>
				<option value="09:00">09:00</option>
				<option value="09:30">09:30</option>
				<option value="10:00">10:00</option>
				<option value="10:30">10:30</option>
				<option value="11:00">11:00</option>
				<option value="11:30">11:30</option>
				<option value="12:00">12:00</option>
				<option value="12:30">12:30</option>
				<option value="13:00">13:00</option>
				<option value="13:30">13:30</option>
				<option value="14:00">14:00</option>
				<option value="14:30">14:30</option>
				<option value="15:00">15:00</option>
				<option value="15:30">15:30</option>
				<option value="16:00">16:00</option>
				<option value="16:30">16:30</option>
				<option value="17:00">17:00</option>
				<option value="17:30">17:30</option>
				<option value="18:00">18:00</option>
				<option value="18:30">18:30</option>
				<option value="19:00">19:00</option>
				<option value="19:30">19:30</option>
				<option value="20:00">20:00</option>
				<option value="20:30">20:30</option>
				<option value="21:00">21:00</option>
				<option value="21:30">21:30</option>
				<option value="22:00">22:00</option>
				<option value="22:30">22:30</option>
				<option value="23:00">23:00</option>
				<option value="23:30">23:30</option>
				<option value="24:00">24:00</option>
				<option value="24:30">24:30</option>
			</select>&nbsp;
			<label for="<?=$args['name']?>_<?=$i?>_closes">Closes</label>
			<select name="company_options[<?=$args['name'];?>][<?=$i?>][closes]" id="<?=$args['name'];?>_<?=$i?>_closes">
				<option value=""></option>
				<option value="01:00">01:00</option>
				<option value="01:30">01:30</option>
				<option value="02:00">02:00</option>
				<option value="02:30">02:30</option>
				<option value="03:00">03:00</option>
				<option value="03:30">03:30</option>
				<option value="04:00">04:00</option>
				<option value="04:30">04:30</option>
				<option value="05:00">05:00</option>
				<option value="05:30">05:30</option>
				<option value="06:00">06:00</option>
				<option value="06:30">06:30</option>
				<option value="07:00">07:00</option>
				<option value="07:30">07:30</option>
				<option value="08:00">08:00</option>
				<option value="08:30">08:30</option>
				<option value="09:00">09:00</option>
				<option value="09:30">09:30</option>
				<option value="10:00">10:00</option>
				<option value="10:30">10:30</option>
				<option value="11:00">11:00</option>
				<option value="11:30">11:30</option>
				<option value="12:00">12:00</option>
				<option value="12:30">12:30</option>
				<option value="13:00">13:00</option>
				<option value="13:30">13:30</option>
				<option value="14:00">14:00</option>
				<option value="14:30">14:30</option>
				<option value="15:00">15:00</option>
				<option value="15:30">15:30</option>
				<option value="16:00">16:00</option>
				<option value="16:30">16:30</option>
				<option value="17:00">17:00</option>
				<option value="17:30">17:30</option>
				<option value="18:00">18:00</option>
				<option value="18:30">18:30</option>
				<option value="19:00">19:00</option>
				<option value="19:30">19:30</option>
				<option value="20:00">20:00</option>
				<option value="20:30">20:30</option>
				<option value="21:00">21:00</option>
				<option value="21:30">21:30</option>
				<option value="22:00">22:00</option>
				<option value="22:30">22:30</option>
				<option value="23:00">23:00</option>
				<option value="23:30">23:30</option>
				<option value="24:00">24:00</option>
				<option value="24:30">24:30</option>
			</select>
		</div>
	</div>
	
	<script>
		(function($){
			$(document).ready(function(){
				$('#<?=$args['name'];?>_<?=$i?>_opens option[value="<?=$options[$args['name']][$i]['opens'];?>"]').attr('selected', 'selected');
				$('#<?=$args['name'];?>_<?=$i?>_closes option[value="<?=$options[$args['name']][$i]['closes'];?>"]').attr('selected', 'selected');
				
				<?php
				foreach($options[$args['name']][$i]['dayOfWeek'] as $key=>$day){
					?>$('#dayOfWeek<?=$i?> input[value="<?=$day?>"]').attr('checked', 'checked');<?php
				}	
				?>
			});
		})(jQuery);
	</script><hr>
	<?php
	endfor;
	
	?>
	<label>Hour Sets</label><br>
	<input type="number" name="company_options[hoursets]" size="2" value="<?=$sets;?>"><br>
	<small>Save Settings to update</small><br><br>

	<?php
}

function company_setting_schema($args) {
	
	$options = get_option('company_options');
	?>
	<select name="company_options[<?=$args['name'];?>]" id="<?=$args['name'];?>">
		<option value="Organization">Organization</option>
		<option value="Corporation">-Corporation</option>
		<option value="EducationalOrganization">-EducationalOrganization</option>
		<option value="GovernmentOrganization">-GovernmentOrganization</option>
		<option value="LocalBusiness">-LocalBusiness</option>
			<option value="FinancialService">--FinancialService</option>
				<option value="AccountingService">--AccountingService</option>

			<option value="FoodEstablishment">--FoodEstablishment</option>
				<option value="Bakery">---Bakery</option>
				<option value="BarOrPub">---BarOrPub</option>
				<option value="Brewery">---Brewery</option>
				<option value="CafeOrCoffeeShop">---CafeOrCoffeeShop</option>
				<option value="FastFoodRestaurant">---FastFoodRestaurant</option>
				<option value="IceCreamShop">---IceCreamShop</option>
				<option value="Restaurant">---Restaurant</option>
				<option value="Winery">---Winery</option>

			<option value="GovernmentOffice">--GovernmentOffice</option>
			<option value="HealthAndBeautyBusiness">--HealthAndBeautyBusiness</option>
				<option value="BeautySalon">---BeautySalon</option>
				<option value="DaySpa">---DaySpa</option>
				<option value="HairSalon">---HairSalon</option>
				<option value="HealthClub">---HealthClub</option>
				<option value="NailSalon">---NailSalon</option>
				<option value="TattooParlor">---TattooParlor</option>

			<option value="HomeAndConstructionBusiness">--HomeAndConstructionBusiness</option>
				<option value="Electrician">---Electrician</option>
				<option value="GeneralContractor">---GeneralContractor</option>
				<option value="HVACBusiness">---HVACBusiness</option>
				<option value="HousePainter">---HousePainter</option>
				<option value="Locksmith">---Locksmith</option>
				<option value="MovingCompany">---MovingCompany</option>
				<option value="Plumber">---Plumber</option>
				<option value="RoofingContractor">---RoofingContractor</option>

			<option value="LegalService">--LegalService</option>
				<option value="Attorney">---Attorney</option>
				<option value="Notary">---Notary</option>

			<option value="MedicalOrganization">--MedicalOrganization</option>
				<option value="Dentist">---Dentist</option>
				<option value="DiagnosticLab">---DiagnosticLab</option>
				<option value="Hospital">---Hospital</option>
				<option value="MedicalClinic">---MedicalClinic</option>
				<option value="Optician">---Optician</option>
				<option value="Pharmacy">---Pharmacy</option>
				<option value="Physician">---Physician</option>
				<option value="VeterinaryCare">---VeterinaryCare</option>

			<option value="ProfessionalService">--ProfessionalService</option>
			<option value="RealEstateAgent">--RealEstateAgent</option>
			<option value="Store">--Store</option>
				<option value="ClothingStore">---ClothingStore</option>
				<option value="ElectronicsStore">---ElectronicsStore</option>
				<option value="Florist">---Florist</option>
				<option value="FurnitureStore">---FurnitureStore</option>
				<option value="GardenStore">---GardenStore</option>
				<option value="HobbyShop">---HobbyShop</option>
				<option value="JewelryStore">---JewelryStore</option>
				<option value="LiquorStore">---LiquorStore</option>
				<option value="MensClothingStore">---MensClothingStore</option>
				<option value="MobilePhoneStore">---MobilePhoneStore</option>
				<option value="OutletStore">---OutletStore</option>
				<option value="WholesaleStore">---WholesaleStore</option>

	</select>
	<script>
		(function($){
			$(document).ready(function(){
			$('option[value=<?=$options[$args['name']];?>]').attr('selected', 'selected');
				});
		})(jQuery);
	</script>
	<?php
	add_shortcode( $args['name'], $options[$args['name']] );
} 


function company_setting_contactType($args) {
	
	$options = get_option('company_options');
	?>
	<select name="company_options[<?=$args['name'];?>]" id="<?=$args['name'];?>">
		<option value="customer support">customer support</option>
		<option value="technical support">technical support</option>
		<option value="billing support">billing support</option>
		<option value="bill payment">bill payment</option>
		<option value="sales">sales</option>
		<option value="reservations">reservations</option>
		<option value="credit card support">credit card support</option>
		<option value="emergency">emergency</option>
		<option value="baggage tracking">baggage tracking</option>
		<option value="roadside assistance">roadside assistance</option>
		<option value="package tracking">package tracking</option>
	</select>
	
	<script>
		(function($){
			$(document).ready(function(){
			$('#<?=$args['name'];?> option[value="<?=$options[$args['name']];?>"]').attr('selected', 'selected');
				});
		})(jQuery);
	</script>
	<?php	
} 


function company_setting_potentialAction_resultType($args) {
	
	$options = get_option('company_options');
	?>
	<select name="company_options[<?=$args['name'];?>]" id="<?=$args['name'];?>">
		<option value="FoodEstablishmentReservation">FoodEstablishmentReservation</option>
		<option value="EventReservation">EventReservation</option>
		<option value="BusReservation">BusReservation</option>
		<option value="FlightReservation">FlightReservation</option>
		<option value="LodgingReservation">LodgingReservation</option>
		<option value="RentalCarReservation">RentalCarReservation</option>
		<option value="ReservationPackage">ReservationPackage</option>
		<option value="TaxiReservation">TaxiReservation</option>
		<option value="TrainReservation">TrainReservation</option>
	</select>
	
	<script>
		(function($){
			$(document).ready(function(){
			$('#<?=$args['name'];?> option[value="<?=$options[$args['name']];?>"]').attr('selected', 'selected');
				});
		})(jQuery);
	</script>
	<?php	
} 
										

function company_options_validate($input) {
	$newinput['business_name'] = trim($input['business_name']);
	return $newinput;
}

function company_options_page(){
	?>
	<div class="wrap">
		<h2>Company Profile</h2>
		<form method="post" action="options.php"> 
		<?php settings_fields( 'company_options' ); ?>
    	<?php do_settings_sections( 'company' ); ?>
    	
		<?php submit_button(); ?>
		</form>
	</div>
	
	<?php
}
	
?>