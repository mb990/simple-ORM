<?php

require_once 'Model.php';

class PetModel extends Model {

	protected static $table = 'pets';
	protected $fields = ['user_id', 'name', 'breed'];
}
