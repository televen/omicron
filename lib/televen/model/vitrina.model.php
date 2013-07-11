<?php

include '/home/televen/public_html/omicron/lib/configuration.php';
include_once $GLOBALS["root"] . "/lib/mysql/mysql.class.php";
include $GLOBALS["root"] . $GLOBALS["base_URI"] . $GLOBALS["show_URI"] . "vitrina/configuration.php";

class vitrina_model{

	private $db;
	private $sql;
	private $ret = array();

	public function __construct(){
		$this->db = new MySQL(true, "vitrina", $GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_password"]);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production
	}
}

?>