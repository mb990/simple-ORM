<?php

require_once('Model.php');

/**
 * 
 */
class UserModel extends Model
{
	protected $fields = ['first_name', 'last_name', 'age'];
	protected static $table = 'users';
}