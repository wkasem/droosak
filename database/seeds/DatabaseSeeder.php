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
        $this->call(UsersTableSeeder::class);
        $this->call(UsersTypeSeeder::class);
        $this->call(ExamesSeeder::class);
        $this->call(LiveSeeder::class);
        $this->call(WelcomeSeeder::class);
    }
}
