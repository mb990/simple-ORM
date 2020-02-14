<?php

require_once 'UserModel.php';

$user = new UserModel();
$user->firstName = 'Snoop';
$user->lastName = 'Dogg';
$user->age = 48;
$user->save();

$user = UserModel::find(83);

$user = UserModel::select('*')->where('age', '<', 45);

// $user->update(['firstName' => 'ime']);

// // Fetching
// $people = UserModel
//     ::select('*')
//     ->where('age', '>', 40)
//     ->where('age', '<', 50)
//     ->orderBy('age', 'desc')
//     ->limit(5)
//     ->get();

// // Find by id
// $snoopDogg = UserModal::find(3);

// // Update
// $snoopDogg->update(['name' => 'Snoopy']);

// // Joining
// $usersWithPets = UserModel
//     ::select('users.name, pets.name')
//     ->join('pets', 'pets.user_id', '=', 'users.id')
//     ->get();