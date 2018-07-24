jQuery(document).ready(function ($) {

	/**
	 * Frontend Scripts
	 */
	var HiiWP_Admin = {

		init : function() {
			this.general();
			this.menu_controller();
		},

		// General Functions
		general : function() {

			if ( $.isFunction($.fn.select2) ) {

				jQuery("select.select2").select2({
					width: 'resolve'
				});

				jQuery(".wppf-multiselect, select.select2_multiselect").select2();

			}

		},
		// Handles menu controller functionalities.
		menu_controller : function() {

			jQuery('select.hiiwp-menu-visibility-setter option:selected').each(function() {

				var selected_status = jQuery(this).val();
				var locate_role = jQuery(this).parent().parent().next();

				if( selected_status == 'in' || selected_status == 'out' ) {
					jQuery( locate_role ).show();
					jQuery( locate_role ).find('select').select2();
				}

			});

			jQuery('#menu-to-edit').on('change', 'select.hiiwp-menu-visibility-setter', function() {

				var field          = jQuery(this);
				var id             = field.parent().prev().val();
				var roles_selector = jQuery( '#hiiwp-hiiwp_nav_menu_status_roles' + id + '-wrap' );

				jQuery( '#hiiwp-hiiwp_nav_menu_status_roles' + id + '-wrap select' ).select2({
					width: 'resolve'
				});

				if( jQuery( this ).val() === 'in' ){

					jQuery( roles_selector ).show().css( 'display', 'block' );

				} else {

					jQuery( roles_selector ).hide();

				}

			});

		}
	};
		
	HiiWP_Admin.init();
	
	
});
function tt_template_hide_admin_notice(){
	jQuery('#theme-admin-notice').slideUp();
	jQuery.post( ajaxurl, {'action':'template_hide_admin_notice'}, function(data){
		
	});
}
