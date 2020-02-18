<?php

require_once('Model.php');

/**
 * 
 */
class UserModel extends Model
{
	private $firstName;
	private $lastName;
	private $age;
	protected static $table = 'users';
	private static $id;

	public static $query = [];

	public $counter = 0;

	public $field;
	public $value;

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

	public function save() {

		$sql = 'INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)';
		$stmt = Database::connect()->prepare($sql);
		$stmt->BindParam(':firstName', $this->getFirstName(), PDO::PARAM_STR);
		$stmt->BindParam(':lastName', $this->getLastName(), PDO::PARAM_STR);
		$stmt->BindParam(':age', $this->getAge(), PDO::PARAM_STR);

		$stmt->execute();

		echo 'added <br>';
	}

	// 	function myF($key) {
	// 		echo $key . ' ';
	// 	}

	// 	array_walk($result[0], "myF");

	public static function find($id) {

		$sql = "SELECT * FROM " . self::$table .  " WHERE users.id = '$id'";
		$stmt = Database::connect()->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		self::$id = $results[0]["id"];

		echo 'Data for id: <strong>' . self::$id . '</strong><br>';

		foreach ($results as $row) {
		    echo 'First name: ' . $row['firstName'] . '<br>';
		    echo 'Last name: ' . $row['lastName'] . '<br>';
		    echo 'Age: ' . $row['age'] . '<br>';
        }

//		return $results;
	}

	public function update($data = []) {

		$id = self::$id;

		echo $sql = "UPDATE " . self::$table . " SET " . self::$table . "." . key($data) . " = '" . $data[key($data)] . "' WHERE " . self::$table .".id = '$id' ";

		$stmt = Database::connect()->prepare($sql);

		$stmt->execute();

		return $this;
	}

	public static function select($var) {
		
		self::$query[] = 'SELECT ' . $var . ' FROM '. self::$table;

		return new self;
	}

	public function where($field, $symbol, $value) {

	    if ($this->counter < 1) {
            self::$query[] = ' WHERE ' . self::$table . '.' . $field . ' ' . $symbol . ' ' . $value;
            $this->counter ++;
        }
        else {
            self::$query[] = 'AND ' . self::$table . '.' . $field . ' ' . $symbol . ' ' . $value;
        }

        return $this;
	}

	public function join($table, $field1, $symbol, $field2) {

        self::$query [] = ' INNER JOIN ' . "$table" . ' ON ' . "$field1" . "$symbol" . "$field2" . '<br>';

		return $this;
	}

	public function orderBy($var, $order) {
		
		self::$query[] = 'ORDER BY ' . self::$table . '.' . $var . ' ' . $order . ' ';

		return $this;
	}

	public function limit($limit) {
		
		self::$query[] = ' LIMIT ' . $limit;

		return $this;
	}

	public function get() {
		
		echo $sql = implode(" ", self::$query);
		echo '<br>';
		try {
				
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			for ($i = 0; $i < count($results); $i++) {

	            if (key($results) == 'firstName') {
	                echo 'First name: ' . $results[$i]['firstName'] . '<br>';
	            }
	            if (key($results) == 'lastName') {
	                echo 'Last name: ' . $results[$i]['lastName'] . '<br>';
	            }
	            if (key($results) == 'age') {
	                echo 'Age: ' . $results[$i]['age'] . '<br>';
	            }
	        }
	        echo 123;
	        var_dump($results);

			return $results;
		}
		catch (Exception $e) {
			echo 'Error';
			var_dump($e);
		}
	}
}