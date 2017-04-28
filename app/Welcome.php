<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
  protected $guarded = [];

  protected $casts = [
    'fonts' => 'array',
    'sections' => 'array',
    'ads' => 'array',
    'home' => 'array'
  ];
}
