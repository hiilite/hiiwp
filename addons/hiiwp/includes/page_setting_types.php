<?php
	

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
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');

    $options = get_option('company_options');
    ?>
    <div class="uploader">  
		<input type="text" id="<?=$args['name']?>" name="company_options[<?=$args['name']?>]" value="<?=$options[$args['name']]?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'hiilite' ); ?>" />
		<span class="description"><?php _e('Upload an image for the logo.', 'hiilite' ); ?></span>
    </div>

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


?>