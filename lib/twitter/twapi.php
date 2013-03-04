<?php

include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';
include $GLOBALS['root'] . 'lib/twitter/tweet.class.php';
include $GLOBALS['root'] . 'lib/twitter/configuration.php';

set_time_limit(0);
$var_index = 0;
		
if($socket = fsockopen($GLOBALS["twitter_stream_url"], $GLOBALS["twitter_stream_port"], $errno, $errstr, 30)){
	
	$tweet = new tweet();
	$GLOBALS["socket"] = $socket;
	
	$request = $GLOBALS["twitter_stream_api_protocol"] . " " . $GLOBALS["twitter_call"] . http_build_query(array('track' => $GLOBALS["hashtag_to_track"])) . " HTTP/1.1\r\n";
	$request .= "Host: " . $GLOBALS["twitter_api_host"] . "\r\n";
	$request .= "Authorization: Basic " . base64_encode($GLOBALS["twitter_username"] . ':' . $GLOBALS["twitter_password"]) . "\r\n\r\n";
	
	fwrite($socket, $request);
	
	while(!feof($socket)){
		$data = json_decode(fgets($socket), true);
		if($data){
			$tweet->processTweet($data);
			$var_index++;
			print_r($data);
		}
	
	}
	
	fclose($socket);
	
}else{
	print_r("[" . microtime() . "] An error occured trying to contact Twitter stream server ( *" . $errno . "*: " . $errstr . ")" . "\n");
}
?>