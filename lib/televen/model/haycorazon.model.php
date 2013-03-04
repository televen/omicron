<?php
include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';
include_once $GLOBALS['root'] . 'lib/mysql/mysql.class.php';
include $GLOBALS['root'] . $GLOBALS['base_URI'] . $GLOBALS['show_URI'] . 'haycorazon/configuration.php';

class haycorazon_model{

	private $db;
	private $sql;
	private $ret = array();
	
	public function __construct(){
		$this->db = new MySQL(true, "hay_corazon", $GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password']);
		if ($this->db->Error()) $this->db->Kill(); // @todo not this in production
	}
	
	public function getTheme(){
	
					 $this->sql = "SELECT theme_of_day.theme FROM program ";
		$this->sql = $this->sql . "RIGHT JOIN theme_of_day ON program.id = theme_of_day.id_program ";
		$this->sql = $this->sql . "WHERE program.air_date = DATE(NOW())";
		
		if (! $this->db->Query($this->sql)) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = array('theme_of_the_day' => $row->theme);
			}
		}else{
			$this->ret = array('theme_of_the_day' => "");
		}
		
		return $this->ret;
	}
	
	public function getSexy($args){
		$genre = (strtolower($args[0]['genre']) == 'femenina' ) ? 1 : 0;
	
					 $this->sql = "SELECT competitor.id, sign.sign, sign.html_safe, program.intern_secuence FROM competitor ";
		$this->sql = $this->sql . "RIGHT JOIN sign ON competitor.id_sign = sign.id ";
		$this->sql = $this->sql . "RIGHT OUTER JOIN program ON program.id = competitor.id_program ";
		$this->sql = $this->sql . "WHERE program.air_date = DATE(NOW()) AND competitor.sex = " . $genre;
		
		if (! $this->db->Query($this->sql)) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$temp = array();
				$temp = array(  'id' 				=> $row->id,
								'sign' 				=> $row->sign,
								'html_safe' 		=> $row->html_safe,
								'intern_secuence' 	=> $row->intern_secuence);
				array_push($this->ret, $temp);
			}
		}else{
			$this->ret = array('theme_of_the_day' => "");
		}
		
		return $this->ret;
	}
	
	public function getPolls($args){
		
		$this->ret = array();
		
		$args[0]['number'] = ($args[0]['number'] > 0 && $args[0]['number'] < $GLOBALS['max_number_polls']) ? $args[0]['number'] : 1;
		
		$result = array();
		
					 $this->sql = "SELECT poll.poll, poll.id FROM program ";
		$this->sql = $this->sql . "RIGHT JOIN poll ON program.id = poll.id_program ";
		$this->sql = $this->sql . "WHERE program.air_date = DATE(NOW())";
		
		if (! $this->db->Query($this->sql)) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				array_push($result, array($row->poll, $row->id));
			}
			$this->ret = $result[$args[0]['number'] - 1];
			
			$this->sql = "SELECT poll_option.`option` FROM poll_option WHERE poll_option.id_poll = " . $this->ret[1];
			
			if (! $this->db->Query($this->sql)) $this->db->Kill(); // @todo no kill in production
			
			if($this->db->RowCount() > 0){
				$result = array();
				$this->db->MoveFirst();
				while (! $this->db->EndOfSeek()) {
					$row = $this->db->Row();
					array_push($result, $row->option);
				}
				$this->ret[2] = $result;
			}
		}
		return $this->ret;
	}
	
	public function getLikesCount($args){
	
		$where["id_competitor"] = MySQL::SQLValue($args[0]['competitor_id'], MySQL::SQLVALUE_NUMBER);
		
					 $this->sql = "SELECT sexy_results.total_votes, sexy_results.like, sexy_results.dislike FROM sexy_results ";
		$this->sql = $this->sql . "WHERE sexy_results.id_competitor = " . $where["id_competitor"];
		
		if (! $this->db->Query($this->sql)) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				
				$this->ret = array(  'total_votes'	=> $row->total_votes,
									 'like' 		=> $row->like,
									 'dislike'		=> $row->dislike);
				
			}
		}else{
			$this->ret = array('total_votes'		=> 0,
								'like' 				=> 0,
								'dislike'			=> 0);
		}
		$update["like"] 		= MySQL::SQLValue($args[0]['likes'] + $this->ret["like"], MySQL::SQLVALUE_NUMBER);
		$update["dislike"] 		= MySQL::SQLValue($args[0]['dislikes'] + $this->ret["dislike"], MySQL::SQLVALUE_NUMBER);
		$update["total_votes"] 	= MySQL::SQLValue($update["like"] + $update["dislike"], MySQL::SQLVALUE_NUMBER);
		
		if (! $this->db->AutoInsertUpdate("sexy_results", $update, $where)) $this->db->Kill();
		
		$this->ret = array(  'total_votes'	=> $row->total_votes + $args[0]['likes'] + $args[0]['dislikes'],
							 'like' 		=> $row->like + $args[0]['likes'],
							 'dislike'		=> $row->dislike + $args[0]['dislikes'],
							 'id'			=> $args[0]['competitor_id']);
									 
		return $this->ret;
	}
}

?>

