<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
  protected $table = 'exams';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'discription',  'user_id' , 'published' , 'questions',
       'minutes' , 'points'
  ];

  protected $casts = [
    'questions' => 'array'
  ];

  public function scopePublished($q)
  {

    return $q->where('published' , 1);
  }
  public function results()
  {

    return $this->hasMany(ExamRslt::class , 'exam_id');
  }

  public function user()
  {

    return $this->hasOne(ExamRslt::class , 'exam_id')
                ->where('user_id' , auth()->user()->id);
  }

  public function getFinishedAttribute()
  {

    return (bool) $this->user->finished_at;
  }
  public function getStartedAttribute()
  {

    return (bool) $this->user->started_at;
  }

  public function getProgressColorAttribute()
  {

    return ($this->user->score >= 50) ? 'is-success' : 'is-danger';
  }

}
