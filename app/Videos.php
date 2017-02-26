<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{

    protected $table = 'playlists_videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'video_id', 'title', 'discription' , 'src' , 'thumb_src' , 'by', 'stream_id' , 'playlist_id' , 'live'
    ];

    protected $primaryKey = 'video_id';

    protected $casts = ['video_id' => 'string'];
    
    public function playlist()
    {

      return $this->belongsTo(Playlist::class , 'playlist_id');
    }

    public function comments()
    {

      return $this->hasMany(Comments::class , 'video_id')
                  ->where('parent' , '')
                  ->with('user')
                  ->limit(10)
                  ->latest();
    }

    public function published_by()
    {

      return $this->belongsTo(User::class , 'by');
    }

    public function stream()
    {

      return $this->hasOne(Stream::class ,'video_id');
    }

    public function scopeLive($q)
    {

      return $q->where('playlist_id' , 1);
    }
}
