( function( $ ) {
    
    var customize = wp.customize;
 
	$( document.body ).on( 'click', '.customizer-edit', function(){
	    customize.preview.send( 'preview-edit', $( this ).data( 'control' ) );
	});
	
} )( jQuery );