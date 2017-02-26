<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\User;

class StudentsController extends Controller
{

    public function index()
    {

      $students = User::students()->get();

      return view('admin.students' , compact('students'));
    }


    public function updatePoints()
    {
      if(!\Hash::check(request()->input('password') , auth()->user()->password )){

        return abort(403, 'Unauthorized action.');
      }

      \Points::add(
      request()->input('points') ,
      User::where('id' , request()->input('id'))->first()
    );
    }
}
