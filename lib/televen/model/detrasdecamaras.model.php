<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include_once $GLOBALS["root"] . "/lib/mysql/mysql.class.php";
include $GLOBALS["root"] . $GLOBALS["base_URI"] . $GLOBALS["show_URI"] . "detrasdecamaras/configuration.php";

class detrasdecamaras_model{

	private $db;
	private $sql;
	private $ret = array();

	public function __construct(){
		$this->db = new MySQL(true, "detrasdecamaras", $GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_password"]);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production
	}
	
	public function addOpinion($opinion){
		$this->sql = "INSERT INTO WhatToHave (opinion, createdat) VALUES ('" . $opinion . "', NOW())";
		return $this->db->Query($this->sql);
	}
}

?>