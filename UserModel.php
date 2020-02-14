<?php

require_once('Model.php');

/**
 * 
 */
class UserModel extends Model
{
	public $firstName;
	public $lastName;
	public $age;
	protected $table = 'users';	
	public static $id;

	public static $query = [];

	public function save() {

		$sql = 'INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)';
		$stmt = Database::connect()->prepare($sql);
		$stmt->BindParam(':firstName', $this->firstName, PDO::PARAM_STR);
		$stmt->BindParam(':lastName', $this->lastName, PDO::PARAM_STR);
		$stmt->BindParam(':age', $this->age, PDO::PARAM_STR);

		$stmt->execute();

		echo 'added <br>';
	}

	// 	function myF($key) {
	// 		echo $key . ' ';
	// 	}

	// 	array_walk($result[0], "myF");

	public static function find($id) {

		$sql = "SELECT * FROM users WHERE users.id = '$id' ";
		$stmt = Database::connect()->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		self::$id = $results[0]["id"];

		return $results;

	}

	public function update($user = []) {

		$name = $user["name"];

		$id = self::$id;

		$sql = "UPDATE users SET users.firstName = '$name' WHERE users.id = '$id' ";

		$stmt = Database::connect()->prepare($sql);

		$stmt->execute();

		echo 'nesto';

		return $this;
	}

	public static function select($var) {
		
		self::$query[] = 'SELECT ' . $var . ' FROM users WHERE';

		return new self;
	}

	public function where($field, $symbol, $value) {

		self::$query[] = ' users.' . $field . ' ' .$symbol . ' ' . $value . ' ';
		self::$query[] = 'AND ';
	
		if ($var) {
			array_pop(self::$query);
		}

		return $this;
	}

	public function join() {

		return $this;
	}

	public function orderBy($var, $order) {
		
		self::$query[] = 'ORDER BY users.' . $var . ' ' . $order . ' '; 

		return $this;
	}

	public function limit($limit) {
		
		self::$query[] = ' LIMIT ' . $limit;

		return $this;
	}

	public function get() {
		
		$sql = implode(" ", self::$query);
		echo ($sql) . '<br>';
		$stmt = Database::connect()->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($results as $key => $value) {
			echo 'first name: ' . $value['firstName'] . '<br>';
			echo 'last name: ' . $value['lastName'] . '<br>';
			echo 'age: ' . $value['age'] . '<br>';
		}

		return $results;
	}
}