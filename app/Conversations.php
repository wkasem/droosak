<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
  protected $table = 'conversations';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'other_id'
  ];


  protected $casts = [ 'id' => 'string' ];


  public function messages()
  {

    return $this->hasMany(Messages::class , 'conversation_id')
                ->latest();
  }

  public function otherUser()
  {

    return $this->belongsTo(User::class , 'other_id');
  }
}
