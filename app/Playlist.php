<?php

namespace droosak;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{

  protected $table = 'playlists';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'playlist_id' , 'title', 'discription' , 'by' , 'poster' , 'show' , 'parent' , 'stage_id'
  ];

  protected $primaryKey = 'playlist_id';

  protected $casts = ['playlist_id' => 'string'];


  public function playlists()
  {

    return $this->hasMany(Playlist::class , 'parent');
  }

  public function videos()
  {

    return $this->hasMany(Videos::class , 'playlist_id')->withCount('views');
  }

  public function documents()
  {

    return $this->hasMany(Document::class , 'playlist_id');
  }

  public function scopeShow($q)
  {

    return $q->where('show' , 1);
  }

  public function scopeNoParent($q)
  {

    return $q->where('parent' , null);
  }



}
