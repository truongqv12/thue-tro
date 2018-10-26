<?php

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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'use_email'     => $faker->unique()->safeEmail,
        'use_password'  => bcrypt('123456'),
        'use_name'      => $faker->name,
        'use_phone'     => $faker->optional($weight = 0.9)->phoneNumber,
        'use_birthdays' => $faker->optional($weight = 0.9)->dateTimeBetween('-40 years', '-18 years'),
        'use_status'    => '1'
    ];
});
