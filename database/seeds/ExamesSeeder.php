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
            'monthly' => false
          ],
          [
            'title' => 'primary.2.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'primary.3.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'primary.1.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'primary.2.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'primary.3.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'secondary.1.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'secondary.2.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'secondary.3.arabic',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'secondary.1.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'secondary.2.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'secondary.3.english',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'finearts',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'appliedarts',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'fineartsarchitecture',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],
          [
            'title' => 'arteducation',
            'minutes' => '30',
            'published' => false,
            'questions' => json_encode([]),
            'monthly' => false
          ],

        ];

        \droosak\Exams::insert($exames);
    }
}
