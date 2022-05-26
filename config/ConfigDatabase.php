<?php 
include_once 'Properties.php';

class Database {
    private $prop;
	public $conn;
	
	public function getConnection(){
	    $prop = new Properties();
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host=" . $prop->property_host . ";dbname=" . $prop->property_database_name, $prop->property_username, $prop->property_password);
			$this->conn->exec("set names utf8");
		}catch(PDOException $exception){
			echo "Database could not be connected: " . $exception->getMessage();
		}
		return $this->conn;
	}
} 