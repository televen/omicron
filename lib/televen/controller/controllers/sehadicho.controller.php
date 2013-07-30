<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include $GLOBALS["root"] . "lib/televen/model/sehadicho.model.php";

class sehadicho{

	public static function form($args){
	}

	public static function downloadlaw($args){
	}

	public static function addCase($args){
		$model = new sehadicho_model();
		return $model->addCase($_POST["demandant"], $_POST["defendant"], $_POST["cases"]);
	}
}

?>