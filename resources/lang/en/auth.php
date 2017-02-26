<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    "password-change" => "Change Password",
    'newPass' => "New Password",
    'oldPass' => "Old Password",
    'username' => "Username",
    "change" => "Change",


    'badges' => [
       'teacher' =>'Teacher',
        'student' => 'Student',
        'admin'  => 'Admin'
    ],

    "no-messages" => "No Messages",

    'points' => [
      'badge' => ':points Points',
      'explain' => 'Point = 1 EGP',
      'button' => 'Charge..',
      'success' => 'Thanks for purchasing',
      'fail' => 'Sorry Something Went Wrong',
      'error' =>[
        'title' => 'Sorry You Don\'t Have Enough Points',
        'subtitle' => 'You Can recharge Your Points in Payment Page'
      ]
    ],
    'exam' => [
      'fixed' => 'Fixed',
      'take' => 'Take',
      'start' => 'Start',
      'instructions' => [
        'title' => 'Simple Instructions Before Exam',
        'steps' => [
          [
            'title' => 'Be Ready',
            'subtitle' => 'Don\'t Start unless you re ready , once you have started time can\'t be stooped even if you logout or closed the browser'
          ],
          [
            'title' => 'Points',
            'subtitle' => 'Points Can\'t be refunded once you have started'
          ],
          [
            'title' => 'Results',
            'subtitle' => 'You will get your result instantly once you have finished the exam and you can get a copy of your answers Start '
          ]
        ]
      ]
    ]

];
