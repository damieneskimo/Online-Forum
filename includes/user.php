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

		    return $user->create();
		} else {
			return false;
		}
	}


	public static function authenticate($email="", $password="") {
	    global $database;
	    $email = $database->escape_value($email);
	    $password = $database->escape_value($password);

	    $sql  = "SELECT * FROM users ";
	    $sql .= "WHERE email = '{$email}' ";
	    $sql .= "AND password = '{$password}' ";
	    $sql .= "LIMIT 1";

	 //    /* create a prepared statement */
		// if ($stmt = $database->connection->prepare($sql)) {

		//     /* bind parameters for markers */
		//     $stmt->bind_param("ss", $email, $password);

		//     /* execute query */
		//     $stmt->execute();

		//     $result = $stmt->get_result();
	 //        while ($row = $result->fetch_array(MYSQLI_NUM))
	 //        {
	 //            foreach ($row as $r)
	 //            {
	 //                $result_array[] = $r;
	 //            }
	 //        }
		    
		// }

	    $result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

}

