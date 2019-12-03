/**
 * HiiWP: delight-scripts
 *
 * Delightful JS file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.1

(function($){
$(document).ready(function(){
	
	$(window).scroll( function(){
		
		var bottomObject = $(window).height() + ($(this)[0].getBoundingClientRect().top + $(this)[0].getBoundingClientRect().height*2);
		var bottomWindow = $(window).scrollTop() + $(window).height();

		$('.hiifade').each( function(i) {      
			if( bottomWindow > bottomObject ) {
				$(this).animate( {'opacity':'1'}, 750 );  
			}
		});
		
		$('ul li').each(function(i){
			if( bottomWindow > bottomObject ) {
				$(this).delay(50*i).animate( {'opacity':'1'}, 250 );
			}
		});
		
	});
	
});})(jQuery);
 */