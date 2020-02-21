<?php

namespace App\Models;

use Core\Models\Model;

class PetModel extends Model {

	protected static $table = 'pets';
	protected $fields = ['user_id', 'name', 'breed'];
}
