<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\User;
use droosak\NewsLetter;
use droosak\Videos;
use droosak\Revenue;
use droosak\Welcome;

class adminController extends Controller
{


    public function index()
    {

      $welcome = Welcome::first();

      return view('admin.index' , compact('welcome'));
    }

    public function logoSave()
    {

      $this->validate(request(),[
        'logo' => 'required|file|mimes:jpg,jpeg,png'
      ]);

      $welcome = Welcome::first();

      $name = basename(request()->file('logo')->store('imgs' , 'public'));

      \Storage::disk('public')->delete('imgs/'.$welcome->logo);

      $welcome->update(['logo' => $name]);

      return $name;
    }

    public function getSubscribers()
    {

      return NewsLetter::all();
    }

    public function live()
    {

      return Videos::live()->get();
    }

    public function getUsersChart()
    {
      $users = User::notAdmin()->whereYear('created_at' , date('Y'))->get()->groupBy(function($user){
        return $user->created_at->month;
      })->map(function($user){
        return $user->count();
      });

      $chart = [];

      foreach (range(1,12) as $month) {

        $chart['students'][$month] = $users->has($month) ? $users[$month] : 0;
      }

      return $chart;
    }

    public function getRevenueChart()
    {
      $revenue = Revenue::whereYear('created_at' , date('Y'))->get()->groupBy(function($r){
        return $r->created_at->month;
      });

      $chart = [];

      foreach (range(1,12) as $month) {

        $chart[$month] = $revenue->has($month) ? $revenue[$month]->first()->points : 0;
      }

      return $chart;
    }

    public function introSave()
    {

      Welcome::first()->update(request()->all());
    }


}
