<?php
////////////////////////////////////
//
// Add a new logo to the login page
//
////////////////////////////////////
function hiilite_login_logo() { ?>
    <style type="text/css">
        .login #login h1 a {
            background-image: url( <?= get_stylesheet_directory_uri().'/images/hiilite-logo-combomark.png'; ?> );
			background-size: contain;
			  width: auto;
			  background-repeat: no-repeat;
        }
		
    </style>
    <script>
	window.onload = function(){
		var hilogo = document.querySelector('#login');
		var hilink = document.querySelector('#login h1 a');
		//var node = document.createElement("a");  
		//var textnode = document.createTextNode("Water"); 
		//node.appendChild(textnode);
		document.querySelector('#login h1 a').setAttribute('href', 'http://hiilite.com');
		hilogo.insertBefore(node, hilogo.firstChild);
	};
		
	</script>
<?php }
add_action( 'login_enqueue_scripts', 'hiilite_login_logo' );

?>