(function( $ ) {
    wp.customize.bind( 'ready', function() {
        var customize = this;
        // Codes here

        var customize = wp.customize;
 
		customize.previewer.bind( 'preview-edit', function( data ) {
			//console.log(data);
		    var control = customize.control( data.name );
		 
		    control.focus();
		} );
		
    } );
})( jQuery );