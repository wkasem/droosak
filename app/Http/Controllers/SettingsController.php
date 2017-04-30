<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;
use droosak\User;
use droosak\Stage;
use Image;

class SettingsController extends Controller
{
  public function index()
  {
    $stages = Stage::all()->map(function($s){
      $s->title = \Lang::get('exams.'.$s->title);
      return $s;
    });

    return view('settings' , compact('stages'));
  }

  public function getPic($id)
  {
    $user = User::where('id' , $id)->first();

    if(!$user) return;

    $fallback = \Storage::disk('public')->get('imgs/avatar-1.png');

    if($user->hasPic()){
      try{
        $img = \Storage::get(sprintf("/profile_pics/%s" , $user->profile_pic));
      }catch(FileNotFoundException $e){

        return response($fallback)
               ->header('Content-Type', "image/png")
               ->header("Cache-Control" , "max-age=3600 , public");

      }

      $ext = pathinfo($user->profile_pic , PATHINFO_EXTENSION);

      return response($img)
           ->header('Content-Type', "image/{$ext}")
           ->header("Cache-Control" , "max-age=3600 , public");

    }

    return response($fallback)
           ->header('Content-Type', "image/png")
           ->header("Cache-Control" , "max-age=3600 , public");

  }
  public function uploadpic()
  {

    $this->validate(request(),[
      'pic' => 'required|file|mimes:png,jpg,jpeg'
    ]);


    if(auth()->user()->hasPic()){
      \Storage::delete(sprintf("/profile_pics/%s" , auth()->user()->profile_pic));
    }

    $file = request()->file('pic');

    $path = $file->hashName('profile_pics');

    $image = Image::make($file);

    $image->resize(128, 128);

     \Storage::put($path, (string) $image->encode());

     auth()->user()->update([ 'profile_pic' => basename($path) ]);

    return back()->with('updated' , true);
  }

  public function username()
  {

    $this->validate(request(),[
      'username' => 'required|min:2'
    ]);

    auth()->user()->username = request('username');

    auth()->user()->save();

    return back()->with('updated' , true);
  }
  public function stage()
  {

    auth()->user()->stage_id = request('stage_id');

    auth()->user()->save();

    return back()->with('updated' , true);
  }
}
