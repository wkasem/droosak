<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use Exam;

class ExamsController extends Controller
{


    public function index()
    {

      $exams = Exam::all();

      $monthly = $exams->filter(function($e){
        return $e->monthly;
      })->groupBy(function($x){
        return $x->created_at->year;
      });


      return view('admin.exams.index' , compact('exams' , 'monthly'));
    }

    public function edit($id)
    {

      $exam = Exam::edit($id);

      $locked = false; //Exam::isLocked($exam);

      return view('admin.exams.edit' , compact('exam' , 'locked'));
    }

    public function takeExam($id)
    {

      return Exam::take($id);
    }

    public function startExam($id)
    {

      return Exam::start($id);
    }

    public function acceptAnswers()
    {

      return Exam::save();
    }

    public function finish()
    {

      return Exam::finish();
    }

    public function save()
    {

      Exam::update();
    }
}
