<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'stream_id',
    "stream_name",
    "login",
    "password",
    'src',
    'video_id'
  ];

  protected $casts = [ 'video_id' => 'string' ];

}
