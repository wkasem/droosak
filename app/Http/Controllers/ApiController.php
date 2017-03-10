<?php

namespace droosak\Http\Controllers;

use droosak\Playlist;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getCourseList()
    {

      return response(Playlist::latest()->get() , 200);
    }

    public function getCourse($id)
    {

      $course = Playlist::where('playlist_id' , $id)
                        ->with(['videos.published_by' , 'documents'])
                        ->first();

      return response($course , 200);
    }
}
