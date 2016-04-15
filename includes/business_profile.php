<?php
/////////////////////////
//
//	Add COMPANY PROFILE to Menu
//
/////////////////////////
$business_args = array(
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
		'callback'	=>'company_setting_string',
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
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_description',
		'title'		=>'Description',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_facebook',
		'title'		=>'Facebook',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_twitter',
		'title'		=>'Twitter',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_googleplus',
		'title'		=>'GooglePlus',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_instagram',
		'title'		=>'Instagram',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_linkedin',
		'title'		=>'LinkedIn',
		'callback'	=>'company_setting_string',
		'page'		=> 'company',
		'section'	=> 'company_social' ),
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
	 echo '';
}

function company_setting_string($args) {
	$options = get_option('company_options');
	echo "<input id='{$args['name']}' name='company_options[{$args['name']}]' size='40' type='text' value='{$options[$args['name']]}' />";
} 


function company_setting_logo($args) {
   $options = get_option('company_options');
    ?>
	<input type="text" id="<?=$args['name']?>" name="company_options[<?=$args['name']?>]" value="<?=$options[$args['name']]?>" />
	<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'hiilite' ); ?>" />
	<span class="description"><?php _e('Upload an image for the logo.', 'hiilite' ); ?></span>
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