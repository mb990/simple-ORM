<?php

namespace Core\Models;

use Core\Database\Database;
use \PDO;

/**
 * 
 */
class Model
{

	protected $fields = [];
	protected $values = [];
	protected $data;
	protected static $table;
	protected static $id;
	protected $singleId;
	public static $array = [];
	protected $query = [];
	public $counter = 0;

		public function __construct($data = null) {
	
		$this->query = self::$array;

		self::$array = [];  // reseting static query array for the next class instance

		$this->singleId = self::$id;

		self::$id = null; // reseting static id for the next class instance

		if($data) {
			$this->data = $data;
		}
		
	}

	public function save($data = []) {

		$this->values = $data;

		try {
			
			$sql = 'INSERT INTO ' . static::$table . ' (' . implode(", ", array_keys($this->values)) . ') VALUES (:' . implode(", :", array_keys($this->values)) . ')';
			 
			$stmt = Database::connect()->prepare($sql);

			foreach ($this->values as $field => $value) {
				$stmt->BindValue(':' . $field, $value, PDO::PARAM_STR);
			}

			$stmt->execute();

			echo 'entry added <br>';
		}
		catch(PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}

	}

	public static function find($id) {

		$sql = "SELECT * FROM " . static::$table .  " WHERE " . static::$table . ".id = '$id'";
		$stmt = Database::connect()->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		self::$id = $results[0]['id'];

		echo 'data: <br>';
		foreach ($results[0] as $key => $value) {
			echo $key . ': ' . $value . '<br>';
		}

		if (count($results) == 0) {
			return null;
		}
		
		return new static ($results[0]);
	}

	public function update($data = []) {

		$id = $this->singleId;

		$sql = "UPDATE " . static::$table . " SET " . static::$table . "." . key($data) . " = '" . $data[key($data)] . "' WHERE " . static::$table .".id = '$id' ";

		$stmt = Database::connect()->prepare($sql);

		$stmt->execute();

		echo 'data updated <br>';

		return $this;
	}

	public static function select($var) {

		self::$array['select'] = 'SELECT ' . $var . ' FROM '. static::$table;

		return new static;
	}

	public function where($field, $symbol, $value) {

	    if ($this->counter < 1) {
            $this->query['where'] = ' WHERE ' . $field . ' ' . $symbol . ' ' . $value;
            $this->counter ++;
        }
        else {
            $this->query['where'] .= ' AND ' . $field . ' ' . $symbol . ' ' . $value;
        }

        return $this;
	}

	public function join($table, $field1, $symbol, $field2) {

        $this->query['join'] = ' INNER JOIN ' . $table . ' ON ' . $field1 . $symbol . $field2;

		return $this;
	}

	public function orderBy($var, $order) {
		
		$this->query ['orderBy'] = ' ORDER BY ' . static::$table . '.' . $var . ' ' . $order . ' ';

		return $this;
	}

	public function limit($limit) {
		
		$this->query ['limit'] = ' LIMIT ' . $limit;

		return $this;
	}

	public function get() {

		echo $sql = implode(" ", $this->query);
		echo '<br>';

		try {
			
			$stmt = Database::connect()->prepare($sql);
			
			$stmt->execute();

			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $results;
		}
		catch (PDOException $e) {
			echo 'Error' . $e->getMessage() . '<br>';
		}
	}

}