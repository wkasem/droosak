<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;
use droosak\Notifications\SchedulePublish;
use droosak\Schedule;
use droosak\User;
use droosak\Stage;

class ScheduleController extends Controller
{

    public function index()
    {
      $schedule = Schedule::with('times')->get();

      $stages = Stage::all()->map(function($s){
        $s->title = \Lang::get('exams.'.$s->title);
        return $s;
      });

      return view('admin.schedule' , compact('schedule' , 'stages'));
    }
    public function save()
    {

      \Notification::send(students(request('stage_id')), new SchedulePublish(request()->all()));
dd('s');
      $schedule = Schedule::firstOrCreate(['title' => request('title')]);

      $schedule->times()->delete();

      $times = collect(json_decode(request('times')))->map(function($t) use($schedule){
        $t->schedule_id = $schedule->id;
        return (array) $t;
      });


      $schedule->times()->insert($times->toArray());
    }
}
