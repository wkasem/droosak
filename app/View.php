<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'video_id','user_id' , 'owner_id'
  ];
}
