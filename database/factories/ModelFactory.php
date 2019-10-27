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

$factory->define(App\Models\Checklist::class, function (Faker\Generator $faker) {
    return [
        'object_domain' => $faker->word,
        'object_id' => $faker->randomNumber(4),
        'task_id' => $faker->randomNumber(4),
        'description' => $faker->text,
        'is_completed' => $faker->boolean,
        'due' => $faker->date(),
        'urgency' => $faker->numberBetween(0, 9),
        'completed_at' => $faker->date(),
        'updated_by' => $faker->randomNumber(4),
        'created_by' => $faker->randomNumber(4),
        'updated_at' => $faker->date(),
        'created_at' => $faker->date()
    ];
});