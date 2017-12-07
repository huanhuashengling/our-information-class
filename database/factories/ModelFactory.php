<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Student::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->name,
        'email' => $faker->email,
        'gender' => $faker->numberBetween(0, 1),
        'level' => 0,
        'score' => 0,
        'sclasses_id' => $faker->numberBetween(1, 3),
        'groups_id' => $faker->numberBetween(1, 2),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Admin::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->name,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Teacher::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->name,
        'email' => $faker->email,
        'schools_id' => 1,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\School::class, function (Faker\Generator $faker) {
    return [
        'title' => "燕山小学",
        'district' => "芙蓉区",
    ];
});

$factory->define(App\Models\Sclass::class, function (Faker\Generator $faker) {
    static $class_num;
    // $enter_school_year = $faker->unique()->numberBetween(2012, 2015);
    
    return [
        'schools_id' => 1,
        'enter_school_year' => $faker->unique()->numberBetween(2012, 2015),
        'class_num' => $class_num ?: $class_num = 3,
        'class_title' => "丙",//$faker->randomElement($array = array ('甲','乙','丙','丁')),
    ];
});

