<?php

class Database {

	private $host = 'mysql';
	private $user = 'admin';
	private $password = 'admin';
	private $db = 'simpleORM';

	
	public function connection() {
		try {

			$dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";";
			$pdo = new PDO($dsn, $this->user, $this->password);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    		return $pdo;

  		}   
		catch(PDOException $e) {
    		die("ERROR: Could not connect. " . $e->getMessage());
  			}
	}

}