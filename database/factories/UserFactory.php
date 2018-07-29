<?php

use App\Role;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'role_id' => function () {
            if (Role::where('name', '!=', 'admin')->exists()) {
                return Role::where('name', '!=', 'admin')->first()->id;
            }
            return factory(Role::class)->create(['id' => Role::USER, 'name' => 'user'])->id;
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => config('custom.default_user_pass'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(\App\User::class, 'admin', function () {
    return [
        'role_id' => function () {
            if (Role::where('name', 'admin')->exists()) {
                return Role::where('name', 'admin')->first()->id;
            }
            return factory(Role::class)->create(['id' => Role::ADMIN, 'name' => 'admin'])->id;
        },
        'name' => 'Admin',
        'email' => 'admin@mail.com',
    ];
});

$factory->state(\App\User::class, 'test', function () {
    return [
        'name' => 'test',
        'email' => 'test@mail.com',
    ];
});
