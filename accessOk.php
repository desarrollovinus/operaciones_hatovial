<?php
//Acceso
$consumerKey    = 'PRxTFZZIBMiwhe3y5TzOw';
$consumerSecret = 'X1iLNQv7YieWeSjavsHbJ0cMqTJSFo9NlmhzRhLvJc';
$oAuthToken     = '1074834686-CvChgwZJ0freJeZw3EgH6f3XMiD0lqSuJybJspi';
$oAuthSecret    = 'YtVBzWkWL4qpGErg5mkBxXLVvYWbHVywhjaI0LeMMtk';

require_once('twitteroauth.php');

$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

//$statusMessage = $_POST['tweet'];
$statusMessage = 'Servidor';

$response = $tweet->post('statuses/update', array('status' => $statusMessage));

//Respuesta del envio del Tweet
if(!$response){
	echo "<p style=color:red>Lo sentimos, ha habibdo un error en la aplicación twitter</p>";
}else{
	echo "<p style=color:green>Tweet OK!</p`>";
}

?>