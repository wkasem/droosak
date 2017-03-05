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

    'failed' => 'البريد الالكترونى وكلمة السر لا يطابقان اى حساب',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

     "password-change" => "تغيير كلمة السر",
     'newPass' => "كلمة المرور الجديدة",
     'oldPass' => "كلمة المرور الحالية",
     'username' => "أسم المستخدم",
     "change" => "تغيير",

    "title" => "العنوان",
    "discription"=>"التفاصيل",
    'badges' => [
       'teacher' =>'مدرس',
        'student' => 'طالب',
        'admin'  => 'مدير '
    ],

    "no-messages" => "لا توجد رسائل",

    "watch" => "مشاهدة",

    'playlists' =>[
      'error' => [
        'title' => 'عذرا لا تتوافر اى كورسات الان',
        'subtitle' => 'برجاء العودة فى وقت لاحق'
      ]
    ],
    'schedules' =>[
      'error' => [
        'title' => 'عذرا لا تتوافر اى جداول مواعيد الان',
        'subtitle' => 'برجاء العودة فى وقت لاحق'
      ]
    ],
    'exams' =>[
      'error' => [
        'title' => 'عذرا لا تتوافر اى امتحانات الأن',
        'subtitle' => 'برجاء العودة فى وقت لاحق'
      ]
    ],
    'points' => [
      'badge' => 'عدد النقاط :points',
      'explain' => ' نقطة = 1 جنية',
      'button' => 'تحويل',
      'success' => 'تم شحن النقاط بنجاح',
      'fail' => 'عذرا لقد حدث خطأ فى شحن النقاط',
      'error' =>[
        'title' => 'عذرا ﻻ تملك نقاط كافية',
        'subtitle' => 'يمكنك شحن نقاطك عبر صفحة طرق الدفع'
      ]
    ],
    'exam' => [
      'fixed' => 'أمتحانات القدرات',
      'take' => 'أخذ',
      'start' => 'بدء',
      'view'  => 'عرض',
      'complete'  => 'أكمل',
      'score'  => 'النتيجة',
      'time'  => 'الوقت',
      'copy'  => 'الحصول على نسخة من ألاجابات',
      'min'   => 'دقيقة',
      'instructions' => [
        'title' => 'تعليمات قبل بدأ ألامتحان',
        'steps' => [
          [
            'title' => 'كن مستعدا',
            'subtitle' => 'لا تبدأ اﻻ و انت مستعد ﻻيمكن وقف الوقت حتى لو قمت بالخروج أو قمت بغلق المتصفح'
          ],
          [
            'title' => 'النقاط',
            'subtitle' => 'لا يمكن أسترجاع نقاطك بعد بدأ ألامتحان'
          ],
          [
            'title' => 'النتيجة',
            'subtitle' => 'سيتم أحتساب نتيجتك فورا بعد أنتهائك '
          ]
        ]
      ]
    ]

];
