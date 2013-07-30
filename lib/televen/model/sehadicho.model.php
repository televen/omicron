<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include_once $GLOBALS["root"] . "/lib/mysql/mysql.class.php";
include $GLOBALS["root"] . $GLOBALS["base_URI"] . $GLOBALS["show_URI"] . "sehadicho/configuration.php";

class sehadicho_model{

	private $db;
	private $sql;
	private $ret = array();
	private $values = array();

	public function __construct(){
		$this->db = new MySQL(true, "sehadicho", $GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_password"]);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production
	}
	
	public function addCase($demandant, $defendant, $case){
		if($this->validateCase($demandant, $defendant, $case)){
			if (!$this->db->TransactionBegin()) $this->db->Kill();
			$success = true;
			
			$phone1 = ($this->values["demandant"]["phone"]=="NULL") ? "'-'" : $this->values["demandant"]["phone"];
			$phone2 = ($this->values["defendant"]["phone"]=="NULL") ? "'-'" : $this->values["defendant"]["phone"];

			$this->sql = "INSERT INTO demandant (name, lastname, email, phone) VALUES (".$this->values["demandant"]["name"].",".$this->values["demandant"]["lastname"].",".$this->values["demandant"]["email"].",".$phone1.")";
			if (!$this->db->Query($this->sql)){
				$success = false;
			}else{
				$demandant_id = $this->db->GetLastInsertID();
			}
			$this->sql = "INSERT INTO defendant (name, lastname, email, phone) VALUES (".$this->values["defendant"]["name"].",".$this->values["defendant"]["lastname"].",".$this->values["defendant"]["email"].",".$phone2.")";
			if (!$this->db->Query($this->sql)){
				$success = false;
			}else{
				$defendant_id = $this->db->GetLastInsertID();
			}
			
			$this->sql = "INSERT INTO cases (demandant_id, defendant_id, cases, createdat) VALUES (".MySQL::SQLValue($demandant_id, MySQL::SQLVALUE_NUMBER).", ".MySQL::SQLValue($defendant_id, MySQL::SQLVALUE_NUMBER).", ".$this->values["case"]["description"].", NOW())";

			if (!$this->db->Query($this->sql)) $success = false;

			if($success){
				if (!$this->db->TransactionEnd()) $this->db->Kill();
			}else{
				if (!$this->db->TransactionRollback()) $this->db->Kill();
			}
			
			return $success;
		}else{
			return false;
		}
	}

	public function validateCase($demandant, $defendant, $case){
		if($demandant["name"]!="" && $demandant["lastname"]!= "" && $demandant["email"]!=""){
			$this->values["demandant"]["name"] 		= MySQL::SQLValue($demandant["name"]);
			$this->values["demandant"]["lastname"] 	= MySQL::SQLValue($demandant["lastname"]);
			$this->values["demandant"]["email"] 		= MySQL::SQLValue($demandant["email"]);
			$this->values["demandant"]["phone"] 		= MySQL::SQLValue($demandant["phone"]);
		}else{
			return false;
		}
		
		if($defendant["name"]!="" && $defendant["lastname"]!= "" && $defendant["email"]!=""){
			$this->values["defendant"]["name"] 		= MySQL::SQLValue($defendant["name"]);
			$this->values["defendant"]["lastname"] 	= MySQL::SQLValue($defendant["lastname"]);
			$this->values["defendant"]["email"] 		= MySQL::SQLValue($defendant["email"]);
			$this->values["defendant"]["phone"] 		= MySQL::SQLValue($defendant["phone"]);
		}else{
			return false;
		}
		
		if($case["description"]!=""){
			$this->values["case"]["description"] 		= MySQL::SQLValue($case["description"]);
		}else{
			return false;
		}
		return true;
	}
}

?>