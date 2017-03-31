<?php

use Illuminate\Database\Seeder;

class Stages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $stages = [
          [
            'stage_id' => 1,
            'title' => 'primary.1.arabic'
          ],
          [
            'stage_id' => 1,
            'title' => 'primary.1.english'
          ],
          [
            'stage_id' => 2,
            'title' => 'primary.2.arabic'
          ],
          [
            'stage_id' => 2,
            'title' => 'primary.2.english'
          ],
          [
            'stage_id' => 3,
            'title' => 'primary.3.arabic'
          ],
          [
            'stage_id' => 3,
            'title' => 'primary.3.english'
          ],
          [
            'stage_id' => 4,
            'title' => 'secondary.1.arabic'
          ],
          [
            'stage_id' => 4,
            'title' => 'secondary.1.english'
          ],
          [
            'stage_id' => 5,
            'title' => 'secondary.2.arabic'
          ],
          [
            'stage_id' => 5,
            'title' => 'secondary.2.english'
          ],
          [
            'stage_id' => 6,
            'title' => 'secondary.3.arabic'
          ],
          [
            'stage_id' => 6,
            'title' => 'secondary.3.english'
          ]
        ];


        \droosak\Stage::insert($stages);
    }
}
