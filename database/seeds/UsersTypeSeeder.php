<?php

use Illuminate\Database\Seeder;

class UsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
          [
            'type_name' => 'admin'
          ],
          [
            'type_name' => 'teacher'
          ],
          [
            'type_name' => 'student'
          ]
        ];

        DB::table('user_types')->truncate();
        DB::table('user_types')->insert($types);
    }
}
