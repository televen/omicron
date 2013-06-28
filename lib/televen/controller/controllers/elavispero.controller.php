<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include $GLOBALS["root"] . "lib/televen/model/elavispero.model.php";

class elavispero{

	public static function whattohave($args){
	
	}
	
	public static function addOpinion($opinion){
		$model = new elavispero_model();
		return $model->addOpinion($opinion);
	}
}

?>