<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;


use droosak\User;

class TeachersController extends Controller
{
  public function index()
  {

    $teachers = User::teachers()->withCount('videos')->get();

    return view('admin.teachers' , compact('teachers'));
  }

  public function getTeacher($id = null)
  {

    $user = User::where('id' , $id)
                ->with('videos')
                ->where('type_id' , 2)->first();

    if(!$user) return redirect('/');

    return view('profile' , compact('user'));
  }

  public function add()
  {

    $this->validate(request() ,[
      'username' => 'required|min:2|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6',
      'discription' => 'min:10',
      'pic' => 'file|mimes:png,jpg,jpeg',
      'phone_number' => 'required|min:6|max:15|unique:users'
    ]);

    request()->merge([
      'password' => bcrypt(request()->input('password')),
      'type_id'  => 2
      ]);

    $user = User::create(request()->all());

    if($file = request()->file('pic')){

      $path = $file->hashName('profile_pics');

      $image = \Image::make($file);

      $image->resize(128, 128);

       \Storage::put($path, (string) $image->encode());

       $user->update([ 'profile_pic' => basename($path) ]);
    }

    return $user;

  }

  public function addCV()
  {
    if(!\Hash::check(request()->input('password') , auth()->user()->password )){

      return abort(403, 'Unauthorized action.');
    }

    $this->validate(request() , [
      'cv' => 'required|file|mimes:text,txt,pdf,docx,doc'
    ]);

    $user = User::find(request()->input('teacher_id'));

    if($user->cv_src){

      \Storage::delete('teachers/'.$user->cv_src);
    }

    $file  = basename(request()->file('cv')->store("teachers"));

    $user->update(['cv_src' => $file]);

    return $file;
  }


  public function downloadCV(User $teacher)
  {

    return response()->download(
      sprintf("%s/teachers/%s" , storage_path('app') , $teacher->cv_src)
    );
  }

  public function getViews()
  {

    $views = \Auth::user()->views()->whereYear('created_at' , date('Y'))->get()->groupBy(function($view){
      return $view->created_at->month;
    })->map(function($view){
      return $view->count();
    });

    $chart = [];

    foreach (range(1,12) as $month) {

      $chart[$month] = $views->has($month) ? $views[$month] : 0;
    }

    return $chart;
  }

  public function getNotis()
  {

    return \Auth::user()->notifications;
  }
}
