<?php

require_once 'UserModel.php';
require_once 'PetModel.php';

// $user = new UserModel();
// $user->firstName('Snoop');
// $user->lastName('Dogg');
// $user->age(48);
// $user->save(['first_name' => 'Savo', 'last_name' => 'Savoic', 'age' =>23]);

// Fetching

// $people = UserModel
//    ::select('*')
//    ->where('age', '>', 40)
//    ->where('age', '<', 50)
// //    ->where('last_name', '=', 'Dogg')
//    ->orderBy('age', 'desc')
//    ->limit(5)
//    ->get();
// echo '<br>';

// // Find by id
// $snoopDogg = UserModel::find(108);
// // Update
// $snoopDogg->update(['first_name' => 'Snoopy']);

// $snoop = UserModel::find(110);
// $snoop->update(['first_name' => 'Novo ime2']);

//  // Joining
 // $usersWithPets = UserModel
 // 	 ::select('users.first_name, pets.name')
 //     ->join('pets', 'pets.user_id', '=', 'users.id')
 //     ->get();

// $user1 = new UserModel();
// $user2 = new UserModel();

// $q1 = $user1::select('*');
// echo '<br>';
// $q2 = $user2::select('*');

// $q1->where('age', '>', 40)->get();
// echo '<br>';
// $q2->where('age', '<', 50)->get();


// TESTING FOR PET MODEL

// Saving

// $pet = new PetModel();
// $pet->save(['user_id' => '100', 'name' => 'ljubimac', 'breed' => 'macka']);

// Fetching

// $pets = PetModel
// 	::select('*')
// 	->where('user_id', '>', 1)
// 	->where('user_id', '<', 10)
// 	->orderBy('user_id', 'desc')
// 	->limit(5)
// 	->get();
// echo "<br>";

// Find by ID

// $somePet = PetModel::find(1);

// Update

// $somePet->update(['breed' => 'Changed breed']);

// $somePet2 = PetModel::find(2);

// $somePet2->update(['breed' => 'Another changed breed']);

// Joining

$petsWithUsers = PetModel
	::select('pets.name, users.first_name')
	->join('users', 'pets.user_id', '=', 'users.id')
	->get();

// $pet1 = new PetModel();
// $pet2 = new PetModel();

// $q1 = $pet1::select('*');
// echo '<br>';
// $q2 = $pet2::select('*');

// $q1->where('user_id', '>', 1)->get();
// $q2->where('user_id', '>', 3)->get();