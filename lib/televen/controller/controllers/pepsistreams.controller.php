<?php

include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';
include_once $GLOBALS['root'] . 'lib/twitter/tweet.class.php';

class pepsistreams{
	
	public static function tweet_cloud($args){
	
		$tweets = new tweet();
		$info = $tweets->get();
		
		$return["count_tweets"] 	= $info["counts"]["tweets"];
		$return["count_user"] 		= $info["counts"]["user"];
		$return["count_mentions"] 	= $info["counts"]["mentions"];
		$return["count_generic_HT"] = $info["counts"]["generic_HT"];
		$return["count_main_HT"] 	= $info["counts"]["main_HT"];
		$return["count_photos"] 	= $info["counts"]["photos"];
		$return["count_replies"]	= $info["counts"]["replies"];
		
		$html = '';
		foreach($info["tweets"] as $tweet){
			$position	 = pepsistreams::setRandomPosition();
			$color		 = pepsistreams::setColor($position);
			$html .= '<div class="tweet" id="' . $tweet["id"] . '" data-tw-id="' . $tweet["tw_id"] . '" data-rt-count="' . $tweet["rt_count"] . '" data-position-x="' . $position["x"] . '" data-position-y="' . $position["y"] . '" data-color="' . $color . '" ></div>';
		}
		
		$return["tweets"] = $html;
		
		return $return;
	}
	
	public static function photo_gallery($args){
	}
	
	private static function setRandomPosition(){
		$y = mt_rand(4, 46);
		if($y > 1 || $y < 4 || $y > 44){
			$x = mt_rand(28,36);
		}elseif($y == 5  || $y == 43){
			$x = mt_rand(26,39);			
		}elseif($y == 6  || $y == 42){
			$x = mt_rand(24,41);		
		}elseif($y == 7  || $y == 41){
			$x = mt_rand(23,42);			
		}elseif($y == 8  || $y == 40){
			$x = mt_rand(21,44);			
		}elseif($y == 9  || $y == 39){
			$x = mt_rand(20,45);			
		}elseif($y == 10  || $y == 38){
			$x = mt_rand(19,45);			
		}elseif($y == 11  || $y == 37){
			$x = mt_rand(18,46);			
		}elseif($y == 12  || $y == 36){
			$x = mt_rand(18,47);			
		}elseif($y == 13 || $y == 14 || $y == 34 || $y == 35 ){
			$x = mt_rand(17,48);			
		}elseif($y == 15 || $y == 33){
			$x = mt_rand(16,48);			
		}elseif($y == 16  || $y == 17 || $y == 31  || $y == 32){
			$x = mt_rand(16,49);			
		}elseif($y == 18 || $y == 30){
			$x = mt_rand(15,49);			
		}elseif($y == 19 || $y == 20 || $y == 21 || $y == 22 || $y == 26 || $y == 27 || $y == 28 || $y == 29){
			$x = mt_rand(15,50);			
		}elseif($y == 23 || $y == 24 || $y == 25){
			$x = mt_rand(14,51);			
		}
		
		return array("x"=>$x, "y"=>$y);
	}
	
	private static function setColor($position){		
		if($position["y"] > 17 && $position["y"] < 32 && $position["x"] > 15 && $position["x"] < 30){
			$color = "red";
		}elseif($position["y"] > 5 && $position["y"] < 18 && $position["x"] > 23 && $position["x"] < 41){
			$color = "red";			
		}elseif($position["y"] > 17 && $position["y"] < 26 && $position["x"] > 29 && $position["x"] < 36){
			$color = "red";		
		}elseif($position["y"] > 10 && $position["y"] < 18 && $position["x"] > 18 && $position["x"] < 24){
			$color = "red";			
		}elseif($position["y"] > 3 && $position["y"] < 6 && $position["x"] > 27 && $position["x"] < 37){
			$color = "red";			
		}elseif($position["y"] > 14 && $position["y"] < 18 && $position["x"] > 16 && $position["x"] < 19){
			$color = "red";			
		}elseif($position["y"] > 7 && $position["y"] < 11 && $position["x"] > 21 && $position["x"] < 24){
			$color = "red";			
		}elseif($position["y"] > 6 && $position["y"] < 13 && $position["x"] > 40 && $position["x"] < 43){
			$color = "red";			
		}elseif($position["y"] > 17 && $position["y"] < 21 && $position["x"] > 35 && $position["x"] < 39){
			$color = "red";			
		}elseif($position["y"] > 25 && $position["y"] < 29 && $position["x"] > 29 && $position["x"] < 32){
			$color = "red";		
		}elseif($position["y"] > 31 && $position["y"] < 35 && $position["x"] > 16 && $position["x"] < 26){
			$color = "red";			
		}elseif($position["y"] > 34 && $position["y"] < 37 && $position["x"] > 17 && $position["x"] < 22){
			$color = "red";			
		}elseif($position["y"] > 31 && $position["y"] < 34 && $position["x"] > 25 && $position["x"] < 28){
			$color = "red";			
		}elseif($position["y"] > 20 && $position["y"] < 23 && $position["x"] > 35 && $position["x"] < 38){
			$color = "red";			
		}elseif($position["y"] > 12 && $position["y"] < 15 && $position["x"] == 18){
			$color = "red";			
		}elseif($position["y"] > 8 && $position["y"] < 11 && $position["x"] == 21){
			$color = "red";			
		}elseif($position["y"] > 7 && $position["y"] < 10 && $position["x"] == 43){
			$color = "red";			
		}elseif($position["y"] > 12 && $position["y"] < 15 && $position["x"] == 41){
			$color = "red";			
		}elseif($position["y"] > 17 && $position["y"] < 20 && $position["x"] == 39){
			$color = "red";			
		}elseif($position["y"] > 22 && $position["y"] < 26 && $position["x"] == 15){
			$color = "red";			
		}elseif($position["y"] == 5 && $position["x"] > 25 && $position["x"] < 28){
			$color = "red";			
		}elseif($position["y"] == 5 && $position["x"] > 36 && $position["x"] < 40){
			$color = "red";			
		}elseif($position["y"] == 26 && $position["x"] > 32 && $position["x"] < 35){
			$color = "red";			
		}elseif($position["y"] == 29 && $position["x"] > 29 && $position["x"] < 32){
			$color = "red";			
		}elseif($position["y"] == 35 && $position["x"] > 21 && $position["x"] < 24){
			$color = "red";			
		}elseif($position["y"] == 10 && $position["x"] < 20){
			$color = "red";			
		}elseif($position["y"] == 7 && $position["x"] < 23){
			$color = "red";			
		}elseif($position["y"] == 6 && $position["x"] < 41){
			$color = "red";		
		}elseif($position["y"] == 21 && $position["x"] < 38){
			$color = "red";		
		}elseif($position["y"] == 23 && $position["x"] < 36){
			$color = "red";		
		}elseif($position["y"] == 27 && $position["x"] < 33){
			$color = "red";		
		}elseif($position["y"] == 30 && $position["x"] < 30){
			$color = "red";		
		}elseif($position["y"] == 32 && $position["x"] < 28){
			$color = "red";		
		}elseif($position["y"] == 37 && $position["x"] < 19){
			$color = "red";				
		}elseif($position["y"] > 35 && $position["y"] < 45 && $position["x"] > 26 && $position["x"] < 41){
			$color = "blue";				
		}elseif($position["y"] > 36 && $position["y"] < 44 && $position["x"] > 23 && $position["x"] < 27){
			$color = "blue";				
		}elseif($position["y"] > 37 && $position["y"] < 41 && $position["x"] > 20 && $position["x"] < 24){
			$color = "blue";				
		}elseif($position["y"] > 32 && $position["y"] < 36 && $position["x"] > 36 && $position["x"] < 41){
			$color = "blue";				
		}elseif($position["y"] > 30 && $position["y"] < 40 && $position["x"] > 41 && $position["x"] < 46){
			$color = "blue";				
		}elseif($position["y"] > 39 && $position["y"] < 43 && $position["x"] > 41 && $position["x"] < 44){
			$color = "blue";				
		}elseif($position["y"] > 28 && $position["y"] < 31 && $position["x"] > 43 && $position["x"] < 47){
			$color = "blue";				
		}elseif($position["y"] > 24 && $position["y"] < 33 && $position["x"] > 47 && $position["x"] < 50){
			$color = "blue";				
		}elseif($position["y"] > 33 && $position["y"] < 37 && $position["x"] > 46 && $position["x"] < 49){
			$color = "blue";				
		}elseif($position["y"] > 37 && $position["y"] < 40 && $position["x"] == 20){
			$color = "blue";				
		}elseif($position["y"] > 30 && $position["y"] < 43 && $position["x"] == 41){
			$color = "blue";				
		}elseif($position["y"] > 39 && $position["y"] < 42 && $position["x"] == 44){
			$color = "blue";				
		}elseif($position["y"] > 21 && $position["y"] < 25 && $position["x"] == 48){
			$color = "blue";				
		}elseif($position["y"] > 15 && $position["y"] < 25 && $position["x"] == 49){
			$color = "blue";				
		}elseif($position["y"] > 18 && $position["y"] < 32 && $position["x"] == 50){
			$color = "blue";				
		}elseif($position["y"] > 23 && $position["y"] < 26 && $position["x"] == 51){
			$color = "blue";				
		}elseif($position["y"] == 41 && $position["x"] > 21 && $position["x"] < 24){
			$color = "blue";				
		}elseif($position["y"] == 35 && $position["x"] > 31 && $position["x"] < 34){
			$color = "blue";				
		}elseif($position["y"] == 28 && $position["x"] > 44 && $position["x"] < 47){
			$color = "blue";				
		}elseif($position["y"] == 41 && $position["x"] == 22){
			$color = "blue";			
		}elseif($position["y"] == 44 && $position["x"] == 26){
			$color = "blue";				
		}elseif($position["y"] == 46 && $position["x"] == 33){
			$color = "blue";			
		}elseif($position["y"] == 32 && $position["x"] == 40){
			$color = "blue";				
		}elseif($position["y"] == 40 && $position["x"] == 45){
			$color = "blue";			
		}elseif($position["y"] == 27 && $position["x"] == 46){
			$color = "blue";			
		}elseif($position["y"] == 37 && $position["x"] == 47){
			$color = "blue";				
		}else{
			$color = "white";
		}
		
		return $color;
	}
	
}
?>