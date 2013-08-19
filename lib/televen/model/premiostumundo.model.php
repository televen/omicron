<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include_once $GLOBALS["root"] . "/lib/mysql/mysql.class.php";
include $GLOBALS["root"] . $GLOBALS["base_URI"] . $GLOBALS["show_URI"] . "premiostumundo/configuration.php";

class premiostumundo_model{

	private $db;
	private $sql;
	private $ret = array();

	public function __construct(){
		$this->db = new MySQL(true, "premiostumundo", $GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_password"]);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production
	}
	
	public function getPeople(){
		$html = "";
		if (! $this->db->Query("SELECT * FROM bluecarpet")) $this->db->Kill();
		$this->db->MoveFirst();
		while (! $this->db->EndOfSeek()) {
			$row = $this->db->Row();
			$html .= "<li class='people' data-id='" . $row->id . "' data-name='" . $row->name . "' data-url='" . $row->url . "'></li>";
		}
		return $html;
	}
	
	public function getAwardAndNominees($award){
		$html = "";
		$this->sql = "SELECT categories.category, categories.id AS cat, bluecarpet.*, nominee.id  AS nominee_i ";
		$this->sql .= " FROM categories ";
		$this->sql .= " LEFT OUTER JOIN nominee ON categories.id = nominee.id_categories ";
		$this->sql .= " LEFT OUTER JOIN bluecarpet ON nominee.id_bluecarpet = bluecarpet.id ";
		$this->sql .= "  WHERE categories.id = '" . MySQL::SQLValue($award, MySQL::SQLVALUE_NUMBER) . "'";
		
		if (! $this->db->Query($this->sql)) $this->db->Kill();
		$this->db->MoveFirst();
		$category = "";
		while (! $this->db->EndOfSeek()) {
			$row = $this->db->Row();
			$html .= '<div class="nominee" id="' . $row->nominee_i . '" data-categories="' . $row->cat . '">';
			$html .= '<img src="templates/programs/premiostumundo/assets/pictures/' . $row->url . '.jpg" class="colorshift grayscale"/>';
			$html .= '<p class="photo_title">' . $row->name . '</p></div>';
			$category = $row->category;
		}
		$html .= '<div class="title">' . $category . '</div>';
		return $html;
	}
	
	public function addVote($yes, $no, $id){
		if (! $this->db->Query("SELECT * FROM votes WHERE id_bluecarpet = " . $id)) $this->db->Kill();
		while (! $this->db->EndOfSeek()) {
			$row = $this->db->Row();
			$yes = $yes + $row->yes;
			$no = $no + $row->no;
		}
		$update["yes"] = MySQL::SQLValue($yes, MySQL::SQLVALUE_NUMBER);
		$update["no"]  = MySQL::SQLValue($no, MySQL::SQLVALUE_NUMBER);
		if (! $this->db->UpdateRows("votes", $update, array("id_bluecarpet" => $id))) $this->db->Kill();
		return array("yes"=>$yes, "no"=>$no);
	}
	
	public function addVoteNominee($id, $cat){
		if (! $this->db->Query("SELECT * FROM nominee WHERE id = " . $id)) $this->db->Kill();
		while (! $this->db->EndOfSeek()) {
			$row = $this->db->Row();
			$votes = $row->votes + 1;
		}
		if (! $this->db->Query("SELECT * FROM categories WHERE id = " . $cat)) $this->db->Kill();
		while (! $this->db->EndOfSeek()) {
			$row = $this->db->Row();
			$total = $row->total_votes + 1;
		}
		$update["votes"] = MySQL::SQLValue($votes, MySQL::SQLVALUE_NUMBER);
		if (! $this->db->UpdateRows("nominee", $update, array("id" => $id))) $this->db->Kill();
		$updates["total_votes"] = MySQL::SQLValue($total, MySQL::SQLVALUE_NUMBER);
		if (! $this->db->UpdateRows("categories", $updates, array("id" => $cat))) $this->db->Kill();
		return array("votes"=>$votes, "total" => $total);
	}
}

?>