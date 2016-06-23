<?php

require_once('database.php');

class Reply extends DB {

  	protected static $table_name = "replies";
  	protected static $db_fields = ['id', 'content', 'user_id', 'topic_id', 'created_on'];

  	public $id;
  	public $content;
  	public $user_id;
  	public $topic_id;
  	public $created_on;

	public static function make($topic_id, $user_id, $content) {
    	if(!empty($topic_id) && !empty($user_id) && !empty($content)) {
			$reply = new Reply();
		    $reply->topic_id = (int)$topic_id;
		    $reply->created_on = strftime("%Y-%m-%d %H:%M:%S", time());
		    $reply->user_id = $user_id;
		    $reply->content = $content;

		    return $reply;
		} else {
			return false;
		}
	}
	
	public static function find_replies_on($topic_id=0) {
	    global $database;
	    $sql = "SELECT * FROM " . self::$table_name;
	    $sql .= " WHERE topic_id=" .$database->escape_value($topic_id);
	    $sql .= " ORDER BY created_on ASC";
	    return self::find_by_sql($sql);
	}

}

