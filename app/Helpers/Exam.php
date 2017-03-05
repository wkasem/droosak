<?php

namespace droosak\Helpers;

use droosak\Notifications\ExamPublished;
use Carbon\Carbon;
use droosak\Exams;
use Points;
use PDF;

class Exam
{

  protected $exam;

  public function __construct($id , $withUser = true)
  {

    $this->exam =  (gettype($id) == 'integer') ? $this->get($id , $withUser) : $id;

  }

  public static function all()
  {

    $m = Exams::whereYear('created_at' , date('Y'))
                ->whereMonth('created_at' , date('m'))->count();
    if(!$m){
      Exams::create([
        'title' => date('n'),
        'monthly' => 1,
        'questions' => []
      ]);
    }

    return Exams::all();
  }

  public static function edit(int $id)
  {

    return Exams::where('id' , $id)->with(['results'])->first();
  }

  public static function get(int $id , $user = false)
  {

    $exam = Exams::published()->findOrFail($id);

    return ($user) ? $exam->load('user'): $exam;
  }

  public function createTaker()
  {

    $this->exam->results()->create(['user_id' => auth()->user()->id]);

    return $this->instructionsView($this->exam);
  }

  public static function take(int $id)
  {
      $i = new static($id);

      if(session()->has('examing')){
          return redirect()->route('home.exams.take' , ['id' => session('examing')]);
      }

      //didnt start or take the exam
      if(!$i->already()) return $i->createTaker();

      //created but not statrted
      if(!$i->hasStarted()) return $i->instructionsView($i->exam);

      //started
      if($i->hasMoreTime() && !$i->hasFinished()){
        return $i->examView($i->exam);
      }

      if($i->hasFinished() || !$i->hasMoreTime())  return $i->finishedView($i->exam);

  }


  public static function start(int $id)
  {


      $i = new static($id);


      Points::subtract($i->exam);

      if($i->already()){
        if(!$i->hasStarted()){
          $i->exam->user()->update(['started_at' => Carbon::now()->format('Y-m-d H:i:s') ]);
        }
      }


      session(['examing' => $i->exam->id ]);

      return redirect()->route('home.exams.take' , ['id' => $i->exam->id]);
  }


  private function hasMoreTime()
  {

    $time = $this->exam->user->started_at
                 ->addMinutes($this->exam->minutes)->diffForHumans();

    return (bool) strpos($time , 'now');
  }

  private function already()
  {

    return (bool) count($this->exam->user);
  }

  private function hasStarted()
  {

    return (bool) $this->exam->user->started_at;
  }

  private function hasFinished()
  {

    return (bool) $this->exam->user->finished_at;
  }

  private function examView($exam)
  {

    return view('home.exams.take' , compact('exam'));
  }

  private function instructionsView($exam)
  {

    return view('home.exams.instructions' , compact('exam'));
  }

  private function inProgressView($exam)
  {

    return view('home.exams.inProgress' , compact('exam'));
  }

  private function finishedView($exam)
  {

    return view('home.exams.finished' , compact('exam'));
  }


  public static function isLocked($exam)
  {

   $locked = false;

   foreach ($exam->results as $result) {

     $time = $result->started_at;

     $time->addMinutes($exam->minutes);

     if(!$locked){

       $locked = (bool) (Carbon::now())->diffInMinutes($time);
     }
   }

   return $locked;
  }
  public static function update()
  {
    $exam = (array) json_decode(request()->input('exam'));

    $exam['questions'] = collect($exam['questions'])->map(function ($a) {

      $a->answers = collect($a->answers)->map(function ($b) {
          return (array)$b;
      });

        return (array)$a;
    });

    $temp = Exams::where('id' , $exam['id']);

    // if(!sizeof(json_decode($exam->first()->questions) && (bool) $exam->published ){
    //
    // }
    \Notification::send(students(), new ExamPublished($exam));

    $temp->update($exam);
  }


  public static function save()
  {

    $i = new static(intval(request()->input('examid')));

    $i->commitAnswers();
  }

  public static function finish()
  {

    $i = new static(intval(request()->input('examid')));

    session()->forget('examing');

    $i->commitAnswers(true);
  }

  public  function commitAnswers($finish = false)
  {

    $user = $this->exam->results()->where('user_id' , \Auth::id())->first();

    $answers = json_decode(request()->input('answers'));

    $user->results = json_encode($answers);
    $user->score   = $this->getExamScore($this->exam->questions , $answers);

    if($finish){
      $user->finished_at = Carbon::now()->format('Y-m-d H:i:s');
      $user->time        = $this->calculateTime($user);
    }

    $user->save();
  }

  private function getExamScore($questions , $answers)
  {

    $right = 0;

    foreach ($answers as $answer) {

      if($questions[$answer->qIndx]['right'] == $answer->aIndx) $right++;
    }

    return round(($right / count($questions)) * 100);
  }

  private function calculateTime($user)
  {

    return ($user->started_at)->diffInMinutes($user->finished_at);
  }

  public static function download(int $id)
  {
    $i = new static($id);

    if($i->already() && $i->hasFinished()){
      $exam = $i->exam;
      $answers = json_decode($exam->user->results);

      return  PDF::loadView('home.exams.result',compact('exam' , 'answers'))
                  ->download(\Lang::get('exams.'.$exam->title).' - Results.pdf');
    }

  }


  public static function Worker()
  {

      $exams = Exams::published()->with('user')->whereHas('results', function ($query) {
        $query->where('user_id' , \Auth::id());
      });

    if($exams->count()){
      foreach ($exams->get() as $exam) {

        $i = new static($exam);

        if(!$i->hasFinished()){
          if($i->hasStarted()){
            if($i->hasMoreTime()){

              session(['examing' => $i->exam->id]);
            }else{

             session()->forget('examing');

              $i->exam->user->finished_at = $i->exam->user->started_at
                                           ->addMinutes($i->exam->minutes);
              $i->exam->user->time        = $i->exam->minutes;

              $i->exam->user->save();
            }
          }
        }

      }
    }
  }



}
