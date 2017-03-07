<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'playlist_id' , 'src' , 'name'
  ];

}
