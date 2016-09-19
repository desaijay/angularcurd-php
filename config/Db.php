<?php

class Db{

	private $conn;
	public $username = "root";
	public $dbname = "angularphp-todo";
	public $password = "krd123";
	public $host = "localhost";

	public function getDbconnection(){
		$this->conn = null;
		try{
		$this->conn = new PDO("mysql:host=".$this->host. ";dbname=".$this->dbname, $this->username, $this->password);	
	}catch(PDOException $e){
		echo "Error Occured while connecting to db". $e->getMessage();
	}
	return $this->conn;
	}
}

// $p = new Db();
// var_dump($p->getDbconnection());