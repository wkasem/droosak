<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'email'
  ];
}
