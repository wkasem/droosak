<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'schedule_id',
    "day",
    "from",
    "to"
  ];

  protected $hidden = ['schedule_id' , 'id' , 'created_at' , 'updated_at'];
}
