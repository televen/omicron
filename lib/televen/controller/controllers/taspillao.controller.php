<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include $GLOBALS["root"] . "lib/televen/model/taspillao.model.php";

class taspillao{

	public static function whattohave($args){
	}
	
	public static function addOpinion($opinion){
		$model = new taspillao_model();
		return $model->addOpinion($opinion);
	}
	
	public static function addJoke($joke){
		$model = new taspillao_model();
		return $model->addJoke($joke);
	}
	
	public static function getVideo($video){
		$model = new taspillao_model();
		return $model->getVideo($video);
	}
	
	public static function manual(){
		$model = new taspillao_model();
		return $model->getDayManual();
	}
	
	public static function share(){
	}
	
	public static function piropo(){
		$model = new taspillao_model();
		return $model->getDayPiropo();
	}
	
	public static function joke(){
		$model = new taspillao_model();
		return $model->getDayJoke();
		
	}

}

?>