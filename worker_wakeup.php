<?php

/* your setting start */

$app = 'YOUR APP NAME';

/* get token command is $ heroku auth:token  */

$token = 'YOUR API TOKEN';

$dyno_name = 'worker'; // worker or bot

/* your setting end */

$dynos_url = 'https://api.heroku.com/apps/' . $app . '/dynos';

$headers = array('Authorization: Bearer ' . $token ,'Accept: application/vnd.heroku+json; version=3');

$ch = curl_init( );
curl_setopt( $ch, CURLOPT_URL, $dynos_url);
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch); 

$json = json_decode( $res, true);

$state = $json[0]['state'];

if ( $state and $state == 'idle') {
	$restart_url = 'https://api.heroku.com/apps/' . $app . '/dynos/' . $dyno_name;
	$ch = curl_init( );
	curl_setopt( $ch, CURLOPT_URL, $restart_url);
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch); 
}

?>