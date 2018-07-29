<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedConstants();

        if (app()->environment() !== 'prod') {
            $this->call([
                UsersTableSeeder::class,
            ]);
        }
    }

    /**
     * Seeds constants table data
     *
     * @return DatabaseSeeder
     */
    public function seedConstants()
    {
        return $this->call([
            RolesTableSeeder::class
        ]);
    }
}
