<?php
include 'lib/televen/televen.class.php';
include 'lib/twitter/tweet.class.php';

$televen = new televen();
if(isset($_GET["ajax"])){
	//print_r($televen->getAjax($televen->convertUrlQuery($_SERVER['QUERY_STRING'])));
	echo json_encode($televen->getAjax($televen->convertUrlQuery($_SERVER['QUERY_STRING'])));
}else{
	if(isset($_GET["show"])){
		switch(strtolower($_GET["show"])){
			case "haycorazon" 	: echo $televen->loadHayCorazon($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
			case "pepsistreams" : echo $televen->loadPepsiStreams($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
			//case "ajax"			: echo json_enconde($televen->getAjax($televen->convertUrlQuery($_SERVER['QUERY_STRING']))); break;
			default				: // @todo
		}
	}
}
//$tweet = new tweet();
//$tweet->parseInfoFile();
?>