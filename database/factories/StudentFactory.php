<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Student::class, function (Faker $faker) {
    return [
      'rollno' => strtoupper(str_random(6)),
      'email' => $faker->unique()->safeEmail,
      'first_name'=>$faker->firstName,
      'last_name'=>$faker->lastName,
      'avatar' => $faker->name,
    ];
});
