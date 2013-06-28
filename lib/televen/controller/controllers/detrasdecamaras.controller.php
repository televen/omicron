<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include $GLOBALS["root"] . "lib/televen/model/detrasdecamaras.model.php";

class detrasdecamaras{

	public static function whattohave($args){
	
	}
	
	public static function addOpinion($opinion){
		$model = new detrasdecamaras_model();
		return $model->addOpinion($opinion);
	}

}

?>