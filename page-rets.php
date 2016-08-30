<?php get_header(); 


	echo '<pre>';
$username = "simplyrets";
$password = "simplyrets";
$remote_url = 'https://api.simplyrets.com/properties';

$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header' => "Authorization: Basic " . base64_encode("$username:$password")
    )
);
$context = stream_context_create($opts);
$file = json_decode(file_get_contents($remote_url, false, $context));
print_r($file);
	
 get_footer(); ?>