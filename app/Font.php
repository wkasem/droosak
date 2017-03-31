<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name' , 'src'
  ];
}
