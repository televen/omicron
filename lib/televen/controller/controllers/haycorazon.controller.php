<?php

include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';
include $GLOBALS['root'] . 'lib/televen/model/haycorazon.model.php';

class haycorazon{
	
	public static function tdd(){
		$model = new haycorazon_model();
		return $model->getTheme();
	}
	
	public static function enc($args){
		$model = new haycorazon_model();
		$polls = $model->getPolls($args);
		$return = array();
		
		switch($polls[1]){
			case 1: $return['ordinary_number'] = 'Primera ';break;
			case 2: $return['ordinary_number'] = 'Segunda ';break;
			case 3: $return['ordinary_number'] = 'Tercera ';break;
			case 4: $return['ordinary_number'] = 'Cuarta ';break;
			case 5: $return['ordinary_number'] = 'Quinta ';break;
			default: $return['ordinary_number'] = 'Otra ';
		}
		
		$return['poll']				= $polls[0];
		$return['number']			= $polls[1];
		$return['buttons']			= "";
		
		foreach($polls[2] as $option){
			$return['buttons'] .= '<button class="btn btn-purple" onclick="_gaq.push([\'_trackEvent\', \'HC\', \'Encuesta ' . $polls[1] . '\', \'\']);">' . $option . '</button>';
		}
		return $return;
	}
	
	public static function sex($args){
	
		$model = new haycorazon_model();
		$sexys = $model->getSexy($args);
		
		$random = mt_rand(0,(count($sexys)-1));
		
		$temp = "<ul>";
		foreach($sexys as $sexy){
			$temp .= "<li class='list_element' id='" . $sexy["id"] . "' data-sign='" . $sexy["sign"] . "' data-html-safe='" . $sexy["html_safe"] . "' data-secuence='" . $sexy["intern_secuence"] . "'>";
			$temp .= "</li>";
		}
		$temp .= "</ul>";
		$return["list"] = $temp;
		$return["timer"] = $GLOBALS['sex_timer'];
		$return["ajax_url"] = $GLOBALS['ajax_URI'];
		$return["first"] = "<p class='purple' data-sign='" . $sexys[$random]["sign"] . "'>" . $sexys[$random]["html_safe"] . "</p><img class='load_img' data-id='" . $sexys[$random]["id"] . "' data-secuence='" . $sexys[$random]["intern_secuence"] . "' />";
		return $return;
	}
	
	/** Ajax calls */
	public static function getSexsLikes($args){
		print_r("hola");
		$model = new haycorazon_model();
		return $model->getLikesCount($args);
	}
}
?>