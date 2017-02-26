<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title',
  ];
    public function times()
    {

      return $this->hasMany(Time::class , 'schedule_id');
    }
}
