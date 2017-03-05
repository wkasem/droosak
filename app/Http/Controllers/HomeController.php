<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Videos;
use droosak\Playlist;
use droosak\Exams;
use droosak\User;
use droosak\NewsLetter;
use droosak\Welcome;
use droosak\Mail\Contact;
use droosak\Schedule;


class HomeController extends Controller
{

    public function home()
    {
      $welcome = Welcome::first();

      return view('welcome' , compact('welcome'));
    }

    public function schedule()
    {
      $schedules = Schedule::with('times')->get();

      return view('home.schedule' , compact('schedules'));
    }

    public function index()
    {

      if(student()){

        $videos = Videos::where('live' , '!=' , 1)->latest()->take(3)->get();
        $live = Videos::where('live', 1)->latest()->take(4)->get();

        return view('home.index' , compact('videos' , 'live'));
      }
      return view('home.index');
    }


    public function search()
    {
      $key = request()->get('s');

      $type = request()->get('type') ?? 2;

      if($key == "") return back();

      $users = User::notAdmin()
                   ->where('type_id' , $type)
                   ->where('username' ,'LIKE', "%$key%")
                   ->paginate(10);

      return view('search' , compact('users' , 'key' , 'type'));
    }

    public function contact()
    {

      $this->validate(request(),[
        'contact_username' => 'required',
        'contact_email' => 'required|email',
        'contact_msg' => 'required'
      ]);

      $email = Welcome::first()->email;

      \Mail::to($email)->send(new Contact(request()->all()));

      return back()->with(['contact_success' => true]);
    }

    public function newsletter()
    {

      $this->validate(request(),[
        'newsletter_email' => 'required|email'
      ]);

      NewsLetter::firstOrCreate(['email' => request('newsletter_email')]);

      return back()->with(['intouch_success' => true]);
    }

    public function validation()
    {

      return view('errors.Validation');
    }

    public function validatePhone()
    {

      if(request()->input('code') == auth()->user()->phone_code){

        auth()->user()->update(['phone_code' => 0]);
      }

      return redirect()->back()->with('wrong_phone_code' , \Lang::get('validation.page.wrongcode'));
    }

    public function validateEmail()
    {

      if(request()->input('code') == auth()->user()->mail_code){

        auth()->user()->update(['mail_code' => ""]);
      }

      return redirect()->back()->with('wrong_email_code' , \Lang::get('validation.page.wrongcode'));
    }


    public function exams()
    {

      $exams = Exams::published()->with('user')->get();

      $fixed = $exams->filter(function($e){
        return !$e->monthly;
      });
      $monthly = $exams->filter(function($e){
        return $e->monthly;
      })->groupBy(function($x){
        return $x->created_at->year;
      });

      return view('home.exams.index' , compact('fixed' , 'monthly'));
    }

    public function playlists()
    {

      $playlists = Playlist::where('show' , 1)->withCount(['videos'])->get()->chunk(3);

      return view('home.playlists' , compact('playlists'));
    }



    public function getPlaylist($id)
    {

      $playlist = Playlist::where('playlist_id' , $id)->with('videos.published_by')->first();

      if(!$playlist) return redirect()->route('home.playlists');

      return view('home.playlist_videos' , compact('playlist'));
    }



}
