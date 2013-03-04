<?php
include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/configuration.php';
include_once $GLOBALS['root'] . 'lib/mysql/mysql.class.php';
include $GLOBALS['root'] . 'lib/twitter/configuration.php';

class tweet{

	private $tweet = array();
	private $db;
	private $sql;
	private $ret = 0;
	
	public function __construct(){
		$this->db = new MySQL(true, $GLOBALS["db_table"], $GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password']);
		if ($this->db->Error()) $this->db->Kill();
	}
	
	public function processTweet($tw){
		$this->tweet = (object) $tw;
		
		$user_t = (object) $this->tweet->user; 
		$user  = array(	"created_at" 		=> MySQL::SQLValue($user_t->created_at),
						"description"		=> MySQL::SQLValue((isset($this->tweet->user->description) ? $this->tweet->user->description : "*")),
						"favorites_count" 	=> MySQL::SQLValue($user_t->favourites_count, MySQL::SQLVALUE_NUMBER),
						"followers_count"	=> MySQL::SQLValue($user_t->followers_count, MySQL::SQLVALUE_NUMBER),
						"friends_count"		=> MySQL::SQLValue($user_t->friends_count, MySQL::SQLVALUE_NUMBER),
						"tw_user_id"		=> MySQL::SQLValue($user_t->id, MySQL::SQLVALUE_NUMBER),
						"tw_user_id_str"	=> MySQL::SQLValue($user_t->id_str),
						"listed_count"		=> MySQL::SQLValue($user_t->listed_count, MySQL::SQLVALUE_NUMBER),
						"name"				=> MySQL::SQLValue($user_t->name),
						"screen_name"		=> MySQL::SQLValue($user_t->screen_name),
						"status_count"		=> MySQL::SQLValue($user_t->statuses_count, MySQL::SQLVALUE_NUMBER),
						"verified"			=> MySQL::SQLValue($user_t->verified, MySQL::SQLVALUE_BOOLEAN));
		$user_id = $this->insert("user", $user);

		if($user_id){
			$tweet = array( "created_at" 		=> MySQL::SQLValue($this->tweet->created_at), 
							"tw_id" 			=> MySQL::SQLValue($this->tweet->id, MySQL::SQLVALUE_NUMBER), 
							"tw_id_str" 		=> MySQL::SQLValue($this->tweet->id_str), 
							"retweeted_count" 	=> MySQL::SQLValue($this->tweet->retweet_count, MySQL::SQLVALUE_NUMBER), 
							"source" 			=> MySQL::SQLValue($this->tweet->source), 
							"text" 				=> MySQL::SQLValue($this->tweet->text), 
							"user_id" 			=> MySQL::SQLValue($user_id, MySQL::SQLVALUE_NUMBER));
			$tweet_id = $this->insert("tweet", $tweet);
			
			if(isset($this->tweet->in_reply_to_status_id_str)){
				$reply = array( "tweet_id" 			=> MySQL::SQLValue($tweet_id, MySQL::SQLVALUE_NUMBER), 
								"screen_name" 		=> MySQL::SQLValue($this->tweet->in_reply_to_screen_name), 
								"tw_status_id" 		=> MySQL::SQLValue($this->tweet->in_reply_to_status_id, MySQL::SQLVALUE_NUMBER), 
								"tw_status_id_str" 	=> MySQL::SQLValue($this->tweet->in_reply_to_status_id_str), 
								"tw_user_id" 		=> MySQL::SQLValue($this->tweet->in_reply_to_user_id, MySQL::SQLVALUE_NUMBER), 
								"tw_user_id_str" 	=> MySQL::SQLValue($this->tweet->in_reply_to_user_id_str));
				$this->insert("tweet_reply", $reply);
			}
			
			if(isset($this->tweet->entities)){
			
				if(isset($this->tweet->entities["hashtags"])){
					foreach($this->tweet->entities["hashtags"] as $hashtags){
						$hashtag = 	array(	"tweet_id" 		=> MySQL::SQLValue($tweet_id, MySQL::SQLVALUE_NUMBER), 
											"start_index" 	=> MySQL::SQLValue($hashtags["indices"]["0"], MySQL::SQLVALUE_NUMBER), 
											"end_index" 	=> MySQL::SQLValue($hashtags["indices"]["1"], MySQL::SQLVALUE_NUMBER), 
											"text" 			=> MySQL::SQLValue($hashtags["text"]));
						$this->insert("hashtag", $hashtag);
					}
				}
				
				if(isset($this->tweet->entities["url"])){
					foreach($this->tweet->entities["url"] as $urls){
						$url = array("tweet_id" 	=> MySQL::SQLValue($tweet_id, MySQL::SQLVALUE_NUMBER), 
									 "display_url" 	=> MySQL::SQLValue($urls["display_url"]), 
									 "expanded_url" => MySQL::SQLValue($urls["expanded_url"]), 
									 "url" 			=> MySQL::SQLValue($urls["url"]), 
									 "start_index" 	=> MySQL::SQLValue($urls["indices"]["0"], MySQL::SQLVALUE_NUMBER), 
									 "end_index" 	=> MySQL::SQLValue($urls["indices"]["1"], MySQL::SQLVALUE_NUMBER));
						$this->insert("url", $url);
					}
				}
				
				if(isset($this->tweet->entities["user_mentions"])){
					foreach($this->tweet->entities["user_mentions"] as $user_mentions){
						$user_mention = array("tweet_id" 		=> MySQL::SQLValue($tweet_id, MySQL::SQLVALUE_NUMBER), 
											  "tw_user_id" 		=> MySQL::SQLValue($user_mentions["id"], MySQL::SQLVALUE_NUMBER), 
											  "tw_user_id_str" 	=> MySQL::SQLValue($user_mentions["id_str"]), 
											  "start_index" 	=> MySQL::SQLValue($user_mentions["indices"]["0"], MySQL::SQLVALUE_NUMBER), 
											  "end_index" 		=> MySQL::SQLValue($user_mentions["indices"]["1"], MySQL::SQLVALUE_NUMBER), 
											  "name" 			=> MySQL::SQLValue($user_mentions["name"]), 
											  "screen_name" 	=> MySQL::SQLValue($user_mentions["screen_name"]));
						$this->insert("user_mention", $user_mention);
					}
				}
				
				if(isset($this->tweet->entities["media"])){
					foreach($this->tweet->entities["media"] as $medias){
						$media = array(	"tweet_id" 			=> MySQL::SQLValue($tweet_id, MySQL::SQLVALUE_NUMBER),
										"display_url" 		=> MySQL::SQLValue($medias["display_url"]),
										"expanded_url" 		=> MySQL::SQLValue($medias["expanded_url"]),
										"media_url"		 	=> MySQL::SQLValue($medias["media_url"]),
										"url"				=> MySQL::SQLValue($medias["url"]),
										"tw_media_id"		=> MySQL::SQLValue($medias["id"], MySQL::SQLVALUE_NUMBER),
										"tw_media_id_str"	=> MySQL::SQLValue($medias["id_str"]),
										"start_index"		=> MySQL::SQLValue($medias["indices"]["0"], MySQL::SQLVALUE_NUMBER),
										"end_index"			=> MySQL::SQLValue($medias["indices"]["1"], MySQL::SQLVALUE_NUMBER),
										"type"				=> MySQL::SQLValue($medias["type"]),
										"large_size_h"		=> MySQL::SQLValue($medias["sizes"]["large"]["h"], MySQL::SQLVALUE_NUMBER),
										"large_size_w"		=> MySQL::SQLValue($medias["sizes"]["large"]["w"], MySQL::SQLVALUE_NUMBER),
										"thumb_size_h"		=> MySQL::SQLValue($medias["sizes"]["thumb"]["h"], MySQL::SQLVALUE_NUMBER),
										"thumb_size_w"		=> MySQL::SQLValue($medias["sizes"]["thumb"]["w"], MySQL::SQLVALUE_NUMBER));
						$this->insert("media", $media);
					}
				}
			}
		}
	}
	
	private function insert($table, $values){
		$result = $this->db->InsertRow($table, $values);
		if (! $result) {
			return false;
		} else {
			return $this->db->GetLastInsertID();
		}
	}
	
	public function getTweetCount(){
		
		if (! $this->db->Query("SELECT Count(tweet.id) AS tweets FROM tweet")) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = $row->tweets;
			}
		}
		
		return $this->ret;
	}
	
	public function getUserCount(){
	
		if (! $this->db->Query("SELECT Count(user.id) AS users FROM user")) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = $row->users;
			}
		}
		
		return $this->ret;
	}
	
	public function getUserMentionsCount(){
	
		if (! $this->db->Query("SELECT Count(user_mention.id) AS mentions FROM user_mention")) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = $row->mentions;
			}
		}
		
		return $this->ret;
	}
	
	public function getHashtagsCount(){
	
		if (! $this->db->Query("SELECT Count(hashtag.id) AS generic_HT FROM hashtag WHERE hashtag.text <> '" . $GLOBALS["hashtag_to_track"] . "'")) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = $row->generic_HT;
			}
		}
		
		return $this->ret;
	}
	
	public function getMainHashtagCount(){
	
		if (! $this->db->Query("SELECT Count(hashtag.id) AS main_HT FROM hashtag WHERE hashtag.text = '" . $GLOBALS["hashtag_to_track"] . "'")) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = $row->main_HT;
			}
		}
		
		return $this->ret;
	}
	
	public function getMediaCount(){
	
		if (! $this->db->Query("SELECT Count(media.id) AS photos FROM media")) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = $row->photos;
			}
		}
		
		return $this->ret;
	}
	
	public function getReplyCount(){
	
		if (! $this->db->Query("SELECT Count(tweet_reply.id) AS replies FROM tweet_reply")) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$this->ret = $row->replies;
			}
		}
		
		return $this->ret;
	}
	
	public function get($id = 0){
		$where = ($id!=0) ? " WHERE tweet.id > " . $id : "";
		
		$ret = array("counts" => array(), "tweets" => array());
		$temp = array();
		$temp2 = array();
		
		if (! $this->db->Query("SELECT tweet.id, tweet.tw_id, tweet.retweeted_count FROM tweet" . $where)) $this->db->Kill(); // @todo no kill in production
		
		if($this->db->RowCount() > 0){
			$this->db->MoveFirst();
			while (! $this->db->EndOfSeek()) {
				$row = $this->db->Row();
				$temp["id"] 		= $row->id;
				$temp["tw_id"] 		= $row->tw_id;
				$temp["rt_count"] 	= $row->retweeted_count;
				array_push($temp2, $temp);
			}
		}
		$ret["tweets"] = $temp2;
		
		$temp = array();
		
		$temp["tweets"] 	= $this->getTweetCount();
		$temp["user"] 		= $this->getUserCount();
		$temp["mentions"] 	= $this->getUserMentionsCount();
		$temp["generic_HT"] = $this->getHashtagsCount();
		$temp["main_HT"] 	= $this->getMainHashtagCount();
		$temp["photos"] 	= $this->getMediaCount();
		$temp["replies"]	= $this->getReplyCount();
		
		$ret["counts"] = $temp;
		
		//print_r($ret);
		
		return $ret;
	}
	
	public function parseInfoFile(){
		
		$matrix 	= array();
		$temp_arr 	= array();
		$i = 0; $j = 0;
		
		$file = fopen($GLOBALS['root'] . 'lib/twitter/' . $GLOBALS["cloud_form_file"], "r");
		
		while(!feof($file)){
			$temp = fgetc($file);
			if($temp == "-"){
				$j++; $i = 0;
			}else{
				$matrix[$j][$i] = $temp;
				$i++;
			}
		}
		
		fclose($file);
		return $matrix;
	}
}
?>