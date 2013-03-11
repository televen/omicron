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
		
		return $this->ret;
	}
}

?>