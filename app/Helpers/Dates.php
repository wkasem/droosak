<?php

namespace droosak\Helpers;


class Dates
{

  public static function getMonths()
  {
    $months = [];
    $currentMonth = (int)date('m');

    for ($x = 1; $x < $currentMonth + 11; $x++) {
        $months[] = date('F', mktime(0, 0, 0, $x, 1));
    }

    return $months;
  }

  public static function getYears()
  {
    $years = [];

    $currentYear = (int)date('Y');

    for ($x = $currentYear; $x > $currentYear - 7; $x--) {
        $years[] = $x;
    }

    return $years;
  }

  public static function isCurrentMonth($key)
  {

    return ((int)date('m') - 1) == $key;
  }

  public static function isCurrentYear($key)
  {

    return (int)date('Y') == $key;
  }
}
