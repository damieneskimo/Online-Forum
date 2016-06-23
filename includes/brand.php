<?php

require_once('database.php');

class Brand extends DB {
	
	protected static $table_name = 'brand';
	protected static $db_fields=array('id', 'name', 'description');

	public $id;
	public $name;
	public $description;

	
	public function getBrand($id=1) {
		$brand = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($brand) ? array_shift($brand) : false;
	}
	
	public function getName() {
		$brand = $this->getBrand();
		return $brand->name;
	}

	public function getDescription() {
		$brand = $this->getBrand();
		return $brand->description;
	}
	
}