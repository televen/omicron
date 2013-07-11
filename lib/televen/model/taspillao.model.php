<?php

include $_SERVER["DOCUMENT_ROOT"] . "/omicron/lib/configuration.php";
include_once $GLOBALS["root"] . "/lib/mysql/mysql.class.php";
include $GLOBALS["root"] . $GLOBALS["base_URI"] . $GLOBALS["show_URI"] . "taspillao/configuration.php";

class taspillao_model{

	private $db;
	private $sql;
	private $ret = array();

	public function __construct(){
		$this->db = new MySQL(true, "taspillao", $GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_password"]);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production
	}
	
	public function addOpinion($opinion){
		$this->sql = "INSERT INTO WhatToHave (opinion, createdat) VALUES ('" . $opinion . "', NOW())";
		return $this->db->Query($this->sql);
	}
	
	public function addJoke($opinion){
		$result = explode("<>", $opinion);
		$this->sql = "INSERT INTO like_joke (joke_id, answer, createdat) VALUES (" . $result[1] . ", '" . $result[0] . "', NOW())";
		return $this->db->Query($this->sql);
	}
	
	public function getDayManual(){
		$day = date('H');
		$this->sql = "SELECT * FROM piropo WHERE day = '" . $day . "'";
		return $this->db->Query($this->sql);
	}
	
	public function getVideo($video){
		$this->sql = "SELECT * FROM video WHERE video = '" . $video . "'";
		return $this->db->Query($this->sql);
	}
	
	public function getDayPiropo(){
		$return = array(); $html="";
		$this->sql = "SELECT program.air_date, program.number, piropo.* FROM program ";
		$this->sql = $this->sql . "RIGHT JOIN piropo ON program.id = piropo.program_id WHERE program.air_date = '" . date('Y-m-d') . "'";
		$this->db->Query($this->sql);
		
		$records = $this->db->RowCount();
		
		$this->db->MoveFirst();
		
		while (! $this->db->EndOfSeek()) {
			$row = $this->db->Row();
			array_push($return,$row);
		}
		foreach($return as $piropo){
			$html = $html . '<div class="text"><img src="templates/programs/taspillao/assets/' . $piropo->number . '/piropo/' . $piropo->piropo_img_url . '" alt="' . $piropo->piropo_text . '" title="' . $piropo->piropo_text . '" /></div>';
		}
		return array("piropos" => $html);
	}
	
	public function getDayJoke(){
		$return = array(); $html="";
		$this->sql = "SELECT program.number, program.air_date, joke.* FROM program ";
		$this->sql = $this->sql . "RIGHT JOIN joke ON program.id = joke.program_id WHERE program.air_date = '" . date('Y-m-d') . "'";
		$this->db->Query($this->sql);
		
		$records = $this->db->RowCount();
		
		$this->db->MoveFirst();
		
		while (! $this->db->EndOfSeek()) {
			$row = $this->db->Row();
			array_push($return,$row);
		}
		foreach($return as $joke){
			$html = $html . '<div class="joke-wrapper">';
			$html = $html . '<div class="title"><img src="templates/programs/taspillao/assets/' . $joke->number . '/jokes/' . $joke->question_img_url . '" alt="' . $joke->question_text . '" title="' . $joke->question_text . '" data-id="' . $joke->id . '"/></div>';
			$html = $html . '<div class="text-holder"><textarea class="joke-text" data-id="' . $joke->id . '"></textarea></div>';
			$html = $html . '<div class="btn-taspillao send-joke" data-id="' . $joke->id . '"></div>';
			$html = $html . '</div>';
		}
		return array("jokes" => $html);
	}
}

?>