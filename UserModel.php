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

	public function save() {

		$db = new Database();

		$sql = 'INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)';
		$stmt = $db->connection()->prepare($sql);
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

		$db = new Database();

		$sql = "SELECT * FROM users WHERE users.id = '$id' ";
		$stmt = $db->connection()->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($results as $row) {
			echo 'first name: ' . $row['firstName'] . '<br>';
			echo 'last name: ' . $row['lastName'] . '<br>';
			echo 'age: ' . $row['age'] . '<br>';
		}
	}

	public function update($user = []) {

		$db = new Database();

	}

	public static function select($var) {
		echo $var . '<br>';
		return $this;
	}

	public function where(string $field, string $symbol, int $value) {
		return 'WHERE "$field" "$symbol" "$value"';
		echo 'where';
	}
}