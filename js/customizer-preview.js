jQuery.noConflict();
(function( $ ) {
	$(function() {
		
		var node = document.createElement('style');
		node.setAttribute("id", "customizerStyle");
		document.body.appendChild(node);
		
		wp.customize( 'custom_css', function( value ) {	
		// When the value changes.
			value.bind( function( newval ) {
				console.log(newval);
				
				function addStyleString(str) {
					$('#customizerStyle').empty();
				    node.innerHTML = str;
				}
				addStyleString(newval);

			}); 
		});
	});
})(jQuery);