<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
  protected $table = 'messages';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'body', 'conversation_id', 'user_id' , 'voiceNote' , 'voiceNote_src' , 'seen'
  ];
}
