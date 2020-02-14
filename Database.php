<?php

class Database {

	private static $host = 'mysql';
	private static $user = 'admin';
	private static $password = 'admin';
	private static $db = 'simpleORM';
	private static $pdo;

	public static function connect() {

		$dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";";
		self::$pdo = new PDO($dsn, self::$user, self::$password);
		self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return self::$pdo;
	}
}