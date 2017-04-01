<?php

namespace droosak;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Broadcasting\PrivateChannel;


class User extends Authenticatable
{
    use HasApiTokens , Notifiable;

    /**
      * The channels the user receives notification broadcasts on.
      *
      * @return array
      */
     public function receivesBroadcastNotificationsOn()
     {
         return 'notifications.'.$this->id;
     }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password' , 'type_id' , 'cv_src' , 'balance'
        , 'phone_number' , 'phone_code' , 'mail_code' , 'profile_pic' , 'about' , 'stage_id' , 'ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'mail_code' , 'phone_code'
    ];


    public function hasPic()
    {

      return (bool) $this->profile_pic;
    }


    public function scopeStudents($query)
    {

      return $query->where('type_id' , 3);
    }

    public function scopeTeachers($query)
    {

      return $query->where('type_id' , 2);
    }

    public function scopeNotAdmin($query)
    {

      return $query->where('type_id' ,'!=', 1);
    }

    public function conversations()
    {

      return $this->hasMany(Conversations::class , 'user_id')
                  ->with(['messages' , 'otherUser']);
    }

    public function videos()
    {

      return $this->hasMany(Videos::class , 'by');
    }

    public function views()
    {

      return $this->hasMany(View::class ,'owner_id');
    }

    public function exams()
    {

      return $this->hasMany(Exams::class , 'user_id');
    }

    public function isLive()
    {

      return $this->videos()->where('live' , 1)->count();
    }

    public function channels()
    {
      $channels = ['broadcast' , 'database' , 'nexmo'];

      if(!empty($this->email)) $channels[] = 'mail';

      return $channels;
    }
}
