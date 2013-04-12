<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include_once $GLOBALS["root"] . "/lib/mysql/mysql.class.php";
include $GLOBALS["root"] . $GLOBALS["base_URI"] . $GLOBALS["show_URI"] . "chataing/configuration.php";

class chataing_model{

	private $db;
	private $sql;
	private $ret = array();

	public function __construct(){
		/*$this->db = new MySQL(true, "chataing", $GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_password"]);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production*/
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
			default: $this->ret = array('folder' => 'n1');break;
		}
		return $this->ret;
	}
	
	public function getStopMotionFoldersByBlack($black){
					 $this->sql = "SELECT stop_motion.folder, stop_motion.velocity FROM stop_motion ";
		$this->sql = $this->sql . "WHERE stop_motion.black = " . $black;
		
		if (! $this->db->Query($this->sql)) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$temp = array();
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$temp[] = array('folder' => $row->folder, "velocity" => $row->velocity);
			}
		}else{
			$temp[0] = array('folder' => '_', 'veloctiy' => 0);
		}
		
		return $temp;
	}
}

?>