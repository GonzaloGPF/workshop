<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)
            ->states('admin')
            ->create();

        factory(\App\User::class)
            ->states('test')
            ->create();

        factory(\App\User::class, 50)->create();
    }
}
