<?php

require_once 'UserModel.php';

//$user = new UserModel();
//$user->setFirstName('Snoop');
//$user->setLastName('Dogg');
//$user->setAge(48);
//$user->save();

//$snoopDogg = UserModel::find(5);
//
//$snoopDogg = new UserModel();
//
//$snoopDogg->update(['lastName' => 'New last name']);

// // Fetching
// $people = new UserModel();

// $people = UserModel
//    ::select('*')
//    ->where('age', '>', 40)
//    ->where('age', '<', 50)
// //    ->where('lastName', '=', 'Dogg')
//    ->orderBy('age', 'desc')
//    ->limit(5)
//    ->get();
// echo '<br>';

// // Find by id
// $snoopDogg = UserModel::find(3);

// // Update
// $snoopDogg->update(['name' => 'Snoopy']);

 // Joining
 $usersWithPets = UserModel
 	 ::select('users.firstName, pets.name')
     ->join('pets', 'pets.user_id', '=', 'users.id')
     ->get();