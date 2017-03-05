<?php

if( !function_exists('en'))
{
  function en(){

    return !App::getLocale() || App::isLocale('en');
  }
}


if( !function_exists('userType'))
{
  function userType(){
    
    return Auth::user()->type_id;
  }
}

if( !function_exists('teacher'))
{
  function teacher(){

    return userType() == 2;
  }
}

if( !function_exists('student'))
{
  function student(){

    return userType() == 3;
  }
}

if( !function_exists('admin'))
{
  function admin(){

    return userType() == 1;
  }
}

if( !function_exists('students'))
{
  function students(){

    return droosak\User::students()->get();
  }
}


if( !function_exists('days'))
{
  function days($i , $lang = 'rtl'){

  if($lang == 'rtl'){
    switch ($i) {
      case 1:
      return 'السبت';
      break;
      case 2:
      return 'اﻻحد';
      break;
      case 3:
      return 'الاثنين';
      break;
      case 4:
      return 'الثلاثاء';
      break;
      case 5:
      return 'اﻻربعاء';
      break;
      case 6:
      return 'الخميس';
      break;
      case 7:
      return 'الجمعة';
      break;
    }
  }

  switch ($i) {
    case 1:
    return 'Saturday';
    break;
    case 2:
    return 'Sunday';
    break;
    case 3:
    return 'Monday';
    break;
    case 4:
    return 'Tuesday';
    break;
    case 5:
    return 'Wednesday';
    break;
    case 6:
    return 'Thursday';
    break;
    case 7:
    return 'Friday';
    break;
  }

  }
}

if( !function_exists('badge'))
{
  function badge($user){

    switch ($user->type_id ) {
      case 1:
        echo '<span class="tag is-warning">'.Lang::get('auth.badges.admin').'</span>';
        break;
      case 2:
        echo '<span class="tag is-primary">'.Lang::get('auth.badges.teacher').'</span>';
        break;
      case 3:
        echo '<span class="tag is-success">'.Lang::get('auth.badges.student').'</span>';
        break;
    }
  }
}


if( !function_exists('tdir'))
{
  function tdir(){

    return en() ? 'ltr' : 'rtl';
  }
}
