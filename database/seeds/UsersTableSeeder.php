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

        $users = [
          [
            'username' => 'hassan.slama',
            'password'   => bcrypt('1234'),
            'email'      => 'admin@droosak.com',
            'phone_number' => '01099758439',
            'type_id'    => 1,
            'created_at' => \Carbon\Carbon::today(),
            'ip' => '192.168.10.1'
          ],
          [
            'username' => 'waleedk2',
            'password'   => bcrypt('1234'),
            'email'      => 'teacher@droosak.com',
            'phone_number' => '01099758439',
            'type_id'    => 2,
            'created_at' => \Carbon\Carbon::today(),
            'ip' => '192.168.10.1'
          ],
          [
            'username' => 'waleedk2',
            'password'   => bcrypt('1234'),
            'email'      => 'student@droosak.com',
            'phone_number' => '01099758439',
            'type_id'    => 3,
            'created_at' => \Carbon\Carbon::today(),
            'ip' => '192.168.10.1'
          ]

        ];



        DB::table('users')->truncate();
        DB::table('users')->insert($users);

        DB::table('conversations')->truncate();
    }
}
