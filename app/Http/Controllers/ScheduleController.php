<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;
use droosak\Notifications\SchedulePublish;
use droosak\Schedule;
use droosak\User;

class ScheduleController extends Controller
{

    public function index()
    {
      $schedule = Schedule::with('times')->get();

      return view('admin.schedule' , compact('schedule'));
    }
    public function save()
    {

      \Notification::send(students(), new SchedulePublish(request()->all()));

      $schedule = Schedule::firstOrCreate(['title' => request('title')]);

      $schedule->times()->delete();

      $times = collect(json_decode(request('times')))->map(function($t) use($schedule){
        $t->schedule_id = $schedule->id;
        return (array) $t;
      });


      $schedule->times()->insert($times->toArray());
    }
}
