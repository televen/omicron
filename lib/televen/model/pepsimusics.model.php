<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include_once $GLOBALS["root"] . "/lib/mysql/mysql.class.php";
include $GLOBALS["root"] . $GLOBALS["base_URI"] . $GLOBALS["show_URI"] . "pepsimusics/configuration.php";

class pepsimusics_model{

	private $db;
	private $sql;
	private $ret = array();

	public function __construct(){
		$this->db = new MySQL(true, "pepsi", $GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_password"]);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production
	}
	
	public function getPhotoFolderByBlack($black){
	/*
					 $this->sql = "SELECT photo_folder.folder FROM photo_folder ";
		$this->sql = $this->sql . "WHERE photo_folder.black = " . $black;
		
		if (! $this->db->Query($this->sql)) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = array('folder' => $row->folder);
			}
		}else{
			$this->ret = array('folder' => 'n1');
		}
	*/
		switch($black){
			case 0: $this->ret = array('folder' => 'n0');break;
			case 1: $this->ret = array('folder' => 'n1');break;
			case 2: $this->ret = array('folder' => 'n2');break;
			case 3: $this->ret = array('folder' => 'n3');break;
			case 4: $this->ret = array('folder' => 'n4');break;
			case 5: $this->ret = array('folder' => 'n5');break;
			case 6: $this->ret = array('folder' => 'n6');break;
			case 7: $this->ret = array('folder' => 'n7');break;
			case 8: $this->ret = array('folder' => 'n8');break;
			default: $this->ret = array('folder' => 'n0');break;
		}
		return $this->ret;
	}
}

?>