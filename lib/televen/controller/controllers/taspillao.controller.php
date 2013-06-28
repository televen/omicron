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

}

?>