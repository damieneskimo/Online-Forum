<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class Topic extends DB {
	
	protected static $table_name="topics";
	protected static $db_fields=array('id', 'title', 'content', 'user_id', 'created_on');
	public $id;
	public $title;
	public $content;
	public $user_id;
	public $created_on;
	
  	public $errors= [];

  	public static function make($title, $content, $user_id) {
    	if(!empty($title) && !empty($user_id) && !empty($content)) {
			$topic = new Topic();
		    $topic->title = $title;
		    $topic->content = $content;
		    $topic->created_on = strftime("%Y-%m-%d %H:%M:%S", time());
		    $topic->user_id = $user_id;

		    return $topic;
		} else {
			return false;
		}
	}


	public function save() {
		// A new record won't have an id yet.
		if(isset($this->id)) {
			// Really just to update the caption
			$this->update();
			return true;
		} else {
			// Can't save if there are pre-existing errors
			if(!empty($this->errors)) { return false; }
			  
				// Make sure the caption is not too long for the DB
			if(strlen($this->title) > 55) {
				$this->errors[] = "The title can only be 55 characters long.";
				return false;
			}

			if(empty($this->title)) {
				$this->errors[] = "The title cannot be empty.";
				return false;
			}

			if(empty($this->content)) {
				$this->errors[] = "The content cannot be empty.";
				return false;
			}

			$this->create();

			return true;
		}		
	}

	
	public function replies() {
		return Reply::find_replies_on($this->id);
	}
	
		
	// Common Database Methods
	public static function find_all_topics() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name. " ORDER BY created_on DESC");
  	}
  

}
