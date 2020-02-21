<?php


namespace Core\Database;

use Config\Config;
use \PDO;

class Database {

	private static $pdo;

	private static function setConnection() {

		try {

			$config = Config::get();

			$getConfig = $config->getConfig();

			$dsn = "mysql:host=" . $getConfig['host'] . ";dbname=" . $getConfig['dbName'] . ";";
			self::$pdo = new PDO($dsn, $getConfig['user'], $getConfig['pass']);
			self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			
			return self::$pdo;
		}
		catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public static function connect() {
	    return self::setConnection();
    }
}