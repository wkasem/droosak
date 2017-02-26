<?php

use Illuminate\Database\Seeder;

class LiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        droosak\Playlist::create([
          'playlist_id' => str_random(5),
          'title' => 'live',
          'show' => false
        ]);

        droosak\Playlist::create([
          'playlist_id' => str_random(5),
          'title' => 'promotion',
          'show' => false
        ]);
    }
}
