<?php

namespace App\Models;

use Core\Models\Model;

/**
 * 
 */
class UserModel extends Model
{
	protected $fields = ['first_name', 'last_name', 'age'];
	protected static $table = 'users';
}