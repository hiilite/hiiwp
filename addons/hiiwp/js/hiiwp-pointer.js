jQuery(document).ready( function(jQuery) {
	
var pointerContentIndex = 0;
if( hiiwp_admin.hiiwp_tour_pointers.hiiwp_intro_tour ){//If pointers are set, show them off
var pointer = hiiwp_admin.hiiwp_tour_pointers.hiiwp_intro_tour;
/**
* Create a pointer using content defined at pointer[pointerContentIndex]
* and display it on a particular screen. The screen to display
* the pointer on is defined at pointer[pointerContentIndex].screen
* @param int pointerContentIndex
*/
generatePointer = function( pointerContentIndex ){
	//Change the active screen
	//Add your custom (jQuery) logic to change the plugin screen to the one corresponding to the content at pointerContentIndex
	////Remember, you specified the screen at pointer[pointerContentIndex].screen
	//In my case, using jQuery tabs, I used this to switch to the correct tab:
	// jQuery( "#tabs" ).tabs( "option", "active", pointer[pointerContentIndex].screen );
	 
	//Generate the pointer options
	options = jQuery.extend( pointer[pointerContentIndex].options, {
		close: function() {
			/* jQuery.post( my_plugin_admin.ajax_url, {
			pointer: 'my_plugin_intro_tour',
			action: 'dismiss-wp-pointer'
			});//Ordinarily, we'd use this to send an AJAX call to WordPress to disable our pointer
			//However, we are manually handling the display ourselves so we don't use this*/
			//Disable tour mode
			jQuery.post( hiiwp_admin.ajax_url, {
				action: 'hiiwp_disable_tour_mode' //In the PHP,there's an action to handle this AJAX callback and
				//change the setting you are using to start/stop the tour
			});
		}
	});
	//Open the pointer
	jQuery( pointer[pointerContentIndex].target ).pointer( options ).pointer('open');
	//Inject a "Next" button into the pointer
	jQuery( 'a.close' ).after('<a href="#" class="hiiwp-next button-primary">Next</a>');
};
 
generatePointer( pointerContentIndex );
//Move to the next pointer when 'Next' is clicked
//Event needs to be attached this way since the link was manually injected into the HTML
jQuery( 'body' ).on( 'click', 'a.hiiwp-next', function(e){
	e.preventDefault();
	//Manually hide the current pointer. We don't close it because if we do, the 'close' function,
	//which also disables tour mode, would be called
	jQuery(this).parents('.wp-pointer').hide();
	if( pointerContentIndex < pointer.length  ){
		++pointerContentIndex;
	}
	else{//End of the tour
		//Dismiss the pointer in the WP db
		//Disable tour mode
		jQuery.post( hiiwp_admin.ajax_url, {
			action: 'hiiwp_disable_tour_mode'
		});
		return;
	}
	//Open the next pointer
	generatePointer( pointerContentIndex );
	 
	});
}

});