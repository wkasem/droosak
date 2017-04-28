<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\User;
use droosak\NewsLetter;
use droosak\Videos;
use droosak\Revenue;
use droosak\Welcome;
use droosak\Font;
use droosak\Playlist;

class adminController extends Controller
{


    public function index()
    {

      $welcome = Welcome::first();

      return view('admin.index' , compact('welcome'));
    }

    public function logoSave()
    {

      $this->validate(request(),[
        'logo' => 'required|file|mimes:jpg,jpeg,png'
      ]);

      $welcome = Welcome::first();

      $name = basename(request()->file('logo')->store('imgs' , 'public'));

      \Storage::disk('public')->delete('imgs/'.$welcome->logo);

      $welcome->update(['logo' => $name]);

      return $name;
    }


    public function uploadFont()
    {

      $this->validate(request(),[
        'font' => 'required|file|mimes:otf,ttf,svg,woff,woff2'
      ]);

      $src = basename(request()->file('font')->store('fonts' , 'public'));

      $name = studly_case(
      pathinfo(request()->file('font')->getClientOriginalName() , PATHINFO_FILENAME)
    );

      return Font::create(compact('src' , 'name'));
    }

    public function getSubscribers()
    {

      return NewsLetter::all();
    }

    public function live()
    {

      $videos = Videos::live()->get()->chunk(2);
      $teachers = User::teachers()->get();
      $playlists = Playlist::show()->get();
      $user_id = auth()->user()->id;
      $live_id = Playlist::where('title' , 'live')->select('playlist_id')->first();


      return compact('videos' , 'teachers' , 'playlists' , 'user_id' , 'live_id');
    }

    public function getUsersChart()
    {
      $users = User::notAdmin()->whereYear('created_at' , date('Y'))->get()->groupBy(function($user){
        return $user->created_at->month;
      })->map(function($user){
        return $user->count();
      });

      $chart = [];

      foreach (range(1,12) as $month) {

        $chart['students'][$month] = $users->has($month) ? $users[$month] : 0;
      }

      return $chart;
    }

    public function getRevenueChart()
    {
      $revenue = Revenue::whereYear('created_at' , date('Y'))->get()->groupBy(function($r){
        return $r->created_at->month;
      });

      $chart = [];

      foreach (range(1,12) as $month) {

        $chart[$month] = $revenue->has($month) ? $revenue[$month]->first()->points : 0;
      }

      return $chart;
    }

    public function introSave()
    {

      $fonts = json_decode(request('fonts'));
      $sections = json_decode(request('sections'));
      $imgs = request()->file('imgs');

      array_map(function($section) use ($imgs){

        if(! is_null($section->first->img) && ! is_string($section->first->img))
          $section->first->img = basename( array_shift( $imgs ) ->store('imgs' , 'public'));

        if(property_exists($section , 'second'))
          if(! is_null($section->second->img) && ! is_string($section->second->img))
            $section->second->img = basename( array_shift( $imgs ) ->store('imgs' , 'public'));


      },$sections);

      request()->merge(compact('fonts' , 'sections'));

      Welcome::first()->update(request()->except('imgs'));
    }
    public function adsSave()
    {

      $imgs = request()->file('imgs');
      $ads = json_decode(request('ads'));

      array_map(function($ad) use ($imgs){

        if(! is_string($ad->img))
          $ad->img = basename( array_shift( $imgs ) ->store('imgs' , 'public'));

      },$ads);

      Welcome::first()->update(compact('ads'));
    }


}
