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

  public function add()
  {

    $this->validate(request() ,[
      'first_name' => 'required|min:2|max:255',
      'last_name' => 'required|min:2|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6',
      'discription' => 'min:10'
    ]);

    request()->merge([
      'password' => bcrypt(request()->input('password')),
      'type_id'  => 2
      ]);

    $user = User::create(request()->all());

    return $user;

  }

  public function addCV()
  {
    if(!\Hash::check(request()->input('password') , auth()->user()->password )){

      return abort(403, 'Unauthorized action.');
    }

    $this->validate(request() , [
      'cv' => 'required|file|mimes:text,txt,pdf'
    ]);
    $file  = basename(request()->file('cv')->store("teachers"));

    User::find(request()->input('teacher_id'))->update(['cv_src' => $file]);

    return $file;
  }

  public function deleteCV()
  {
    if(!\Hash::check(request()->input('password') , auth()->user()->password )){

      return abort(403, 'Unauthorized action.');
    }

    $user = User::find(request()->input('teacher_id'));

    \Storage::delete('teachers/'.$user->cv_src);

    $user->update(['cv_src' => '']);
  }

  public function downloadCV(User $teacher)
  {

    return response()->download(
      sprintf("%s/teachers/%s" , storage_path('app') , $teacher->cv_src)
    );
  }
}
