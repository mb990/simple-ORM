<?php

require_once('Database.php');


class QueryBuilder {



	public function saveQuery() {

		$db = new Database();
		if ($db) {
			$sql = 'INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)';

			$stmt = $db->connection()->prepare($sql);
			$stmt->BindParam(':firstName', $this->firstName, PDO::PARAM_STR);
			$stmt->BindParam(':lastName', $this->lastName, PDO::PARAM_STR);
			$stmt->BindParam(':age', $this->age, PDO::PARAM_STR);

			$stmt->execute();

			// $sql = "INSERT INTO users (firstName, lastName, age) VALUES (?,?,?)";
			// $stmt = $db->connection()->prepare($sql);
			// $stmt->execute([$this->firstName, $this->lastName, $this->age]);

			echo 'User is created. <br>';
		}	
		else
			echo 'User is not created. <br>';
	}	
		


	public function findByIdQuery($id) {

		$sql = "SELECT * FROM users WHERE users.id = '$id' ";
		$db = new Database();
		$stmt = $db->connection()->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}