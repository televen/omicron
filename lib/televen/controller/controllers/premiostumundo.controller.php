<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include $GLOBALS["root"] . "lib/televen/model/premiostumundo.model.php";

class premiostumundo{

	public static function bluecarpet($args){
		$model = new premiostumundo_model();
		$list = $model->getPeople();
		return array("list" => $list);
	}

	public static function show($args){
	}

	public static function nominees($args){
		$model = new premiostumundo_model();
		$nominees = $model->getAwardAndNominees($args[0]["award"]);
		return array("nominees" => $nominees);
	}
	
	public static function addVote($args){
		$model = new premiostumundo_model();
		return $model->addVote($_POST["yes"], $_POST["no"], $_POST["id"]);
	}
	
	public static function addVoteNominee($args){
		$model = new premiostumundo_model();
		return $model->addVoteNominee($_POST["id"], $_POST["cat"]);
	}

}

?>