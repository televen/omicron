<?php
include 'lib/televen/televen.class.php';
include 'lib/twitter/tweet.class.php';

$televen = new televen();
if(isset($_GET["ajax"])){
	echo json_encode($televen->getAjax($televen->convertUrlQuery($_SERVER['QUERY_STRING'])));
}elseif(isset($_GET["show"])){
	switch(strtolower($_GET["show"])){
		case "haycorazon" 		: echo $televen->loadHayCorazon($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
		case "pepsistreams" 	: echo $televen->loadPepsiStreams($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
		case "pepsimusics"		: echo $televen->loadPepsiMusics($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
		case "chataing"			: echo $televen->loadChataing($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
		case "opcion2013"		: echo $televen->loadOpcion2013($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
		case "andresaragon"		: echo $televen->loadAndresAragon($televen->convertUrlQuery($_SERVER['QUERY_STRING'])); break;
		case "notfound"			: echo $televen->loadnotfound($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "games"			: echo $televen->loadgames($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "elavispero"		: echo $televen->loadelavispero($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "taspillao"		: echo $televen->loadtaspillao($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "detrasdecamaras"	: echo $televen->loaddetrasdecamaras($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "sehadicho"		: echo $televen->loadsehadicho($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "unminutoparaganar": echo $televen->loadunminutoparaganar($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "tutorials"		: echo $televen->loadtutorials($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "labomba"			: echo $televen->loadlabomba($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
		case "vitrina"			: echo $televen->loadvitrina($televen->convertUrlQuery($_SERVER["QUERY_STRING"])); break;
			/*53x*/
		default				: echo $televen->loadnotfound($televen->convertUrlQuery("show=notfound&piece=notfounds")); break;
	}
}
//$tweet = new tweet();
//$tweet->parseInfoFile();
?>