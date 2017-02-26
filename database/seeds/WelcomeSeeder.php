<?php

use Illuminate\Database\Seeder;

class WelcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \droosak\Welcome::truncate();
        \droosak\Welcome::create([
          'title_arabic' => 'أفضل المواقع للكورسات و أﻻمتحانات',
          'title_english' => 'Best Online Site To Broadcast online Courses',
          'email' => 'wkasem22@gmail.com',
          'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55251.37709964616!2d31.293483867487886!3d30.05948381032293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583fa60b21beeb%3A0x79dfb296e8423bba!2z2KfZhNmC2KfZh9ix2KnYjCDZhdit2KfZgdi42Kkg2KfZhNmC2KfZh9ix2KnigKw!5e0!3m2!1sar!2seg!4v1487070582055'
        ]);
    }
}
