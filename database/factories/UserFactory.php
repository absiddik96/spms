<?php

use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker ) use ($factory){
    return [
		'user_id'        => User::generateUserId(),
		'name'           => 'Super Admin',
		'email'          => 'superadmin@gmail.com',
		'password'       => bcrypt(123456),
		'verified'       => 1,
		'role_id'        => 0,
		'is_active'      => 1,
		'is_super_admin' => 1,
		'status'         => 1,
    ];
});
