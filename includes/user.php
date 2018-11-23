<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class User extends DB {
	
	protected static $table_name="users";
	protected static $db_fields = ['id', 'name', 'email', 'password', 'created_on', 'contribution'];
	
	public $id;
	public $name;
	public $email;
	public $password;
	public $created_on;
	public $contribution;

	public static function make($name, $email, $password)
	{
		if(!empty($name) && !empty($email) && !empty($password)) {
			$user = new User();
		    $user->name = $name;
		    $user->email = $email;
		    $user->created_on = strftime("%Y-%m-%d %H:%M:%S", time());
		    $user->password = $password;
		    $user->contribution = 0;

			$user->create();
			return $user;
		} else {
			return false;
		}
	}


	public static function authenticate($email="", $password="") {
	    global $database;
	    $email = $database->escape_value($email);

	    $sql  = "SELECT * FROM users ";
	    $sql .= "WHERE email = '{$email}' ";
	    $sql .= "LIMIT 1";

		$result_array = self::find_by_sql($sql);
		$user = ! empty($result_array) ? array_shift($result_array) : null;

		if (hash_equals($user->password, crypt($password, $user->password))) {
			return $user;
		} else {
			return false;
		}
	}
}
