<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

    protected $table = 'video_comments';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id' , 'video_id', 'user_id', 'body','voiceNote' , 'voiceNote_src' , 'parent'
    ];

    protected $casts = [ 'id' => 'string' ];

    public function user()
    {

      return $this->belongsTo(User::class , 'user_id');
    }

    public function replies()
    {

      return $this->hasMany(Comments::class , 'parent')->with('user');
    }
}
