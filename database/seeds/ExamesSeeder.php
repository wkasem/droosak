<?php

use Illuminate\Database\Seeder;

class ExamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $exames = [
          [
            'title' => 'primary.1.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 1
          ],
          [
            'title' => 'primary.2.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 2
          ],
          [
            'title' => 'primary.3.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 3
          ],
          [
            'title' => 'primary.1.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 4
          ],
          [
            'title' => 'primary.2.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 5
          ],
          [
            'title' => 'primary.3.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 6
          ],
          [
            'title' => 'secondary.1.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 7
          ],
          [
            'title' => 'secondary.2.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 8
          ],
          [
            'title' => 'secondary.3.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 9
          ],
          [
            'title' => 'secondary.1.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 10
          ],
          [
            'title' => 'secondary.2.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 11
          ],
          [
            'title' => 'secondary.3.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 12
          ],
          [
            'title' => 'finearts',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 13
          ],
          [
            'title' => 'appliedarts',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 13
          ],
          [
            'title' => 'fineartsarchitecture',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 13
          ],
          [
            'title' => 'arteducation',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false,
            'stage_id' => 13
          ],

        ];

        \droosak\Exams::insert($exames);
    }
}
