<?php namespace droosak\Helpers;

use PointsEx;
use Payment as P;
use droosak\Revenue;

class Points
{

  public static function Buy($points)
  {

    return P::Check($points);
  }

  public static function add($points , $user = null)
  {
    $user = ($user) ? $user : auth()->user;

    $user->points += $points;

    $user->save();

    $r = Revenue::whereYear('created_at' , date('Y'))
                ->whereMonth('created_at' , date('m'))
                ->first();
    if(!$r){
      $r = Revenue::create(['points' => 0]);
    }

    $r->points += $points;
    $r->save();
  }

  public static function subtract($entity)
  {
    self::hasEnough($entity);
    
    auth()->user()->points -= $entity->points;

    auth()->user()->save();
  }

  public static function hasEnough($entity)
  {

    if(auth()->user()->points < $entity->points) throw new PointsEx;
  }


}
