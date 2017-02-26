<?php

return [

  'required' => ':attribute مطلوب',

  'page' => [
    'msg' => 'يجب تأكيد حسابك قبل المتابعة',
    'button' => 'تأكيد',
    'logout' => 'خروج',
    'title' => 'تأكيد الحساب',
    'wrongcode' => 'عذرا , لقد أدخلت كود خاطىء'
  ],

  'attributes' => [
    'username' => 'أسم المستخدم',
    'password' => 'كلمة السر',
    'email'    => 'البريد اﻻلكترونى',
    'phone_number' => 'رقم الهاتف'
  ],

  'min'=> [
      'string' => ' :attribute يجب ان يكون على الاقل مكون من :min حروف',
  ],

  'confirmed'            => 'كلمة السر غير متطابقة',

];
