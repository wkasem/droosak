<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Stage;
use Exam;

class ExamsController extends Controller
{


    public function index()
    {

      $exams = Exam::all();


      $stages = Stage::all()->filter(function($stage) use ($exams){
         return !in_array($stage->id ,$exams['monthly']->pluck('stage_id')->toArray());
      });

      return view('admin.exams.index' , compact('exams' ,'stages'));
    }

    public function edit($id)
    {

      $exam = Exam::edit($id);

      $locked = Exam::isLocked($exam);

      $stages = Stage::all()->map(function($s){
        $s->title = \Lang::get('exams.'.$s->title);
        return $s;
      });

      return view('admin.exams.edit' , compact('exam' , 'locked' , 'stages'));
    }

    public function createExam()
    {

      $stage = Stage::where('id' , request('stage_id'))->first();

      $exam = Exam::createExam($stage->id , $stage->title);

      return redirect()->route('admin.exams.edit' , ['id' => $exam->id]);
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

    public function download($id)
    {

      return Exam::download($id);
    }

    public function getTitle()
    {

      return \Lang::get('exams.'.request('title'));
    }
}
