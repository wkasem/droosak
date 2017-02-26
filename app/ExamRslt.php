<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class ExamRslt extends Model
{
  protected $table = 'exams_results';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'results', 'score' , 'started_at' , 'finished_at' , 'time'
  ];

  protected $casts = [
    'results' => 'array'
  ];

  protected $dates = ['started_at' , 'finished_at'];

}
