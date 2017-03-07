<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;
use droosak\Document;
use droosak\Playlist;

class DocumentsController extends Controller
{
    public function upload()
    {
      $this->validate(request(),[
        'file' => 'required'
      ]);

      $filesrc  = basename(request()->file('file')->store("documents"));
      $filename = pathinfo(request()->file('file')->getClientOriginalName() , PATHINFO_FILENAME);

      return Playlist::where('playlist_id' , request('playlist_id'))->first()->documents()
                ->create([
                  'src' => $filesrc,
                  'name'=> $filename
                ]);

    }
    public function download(Document $document)
    {

      return response()->download(
        sprintf("%s/documents/%s" , storage_path('app') , $document->src),
        $document->name
      );
    }
    public function delete()
    {

      if(!\Hash::check(request()->input('password') , auth()->user()->password )){

        return abort(403, 'Unauthorized action.');
      }

      $doc = Document::find(request('docuemntId'))->first();

      \Storage::delete(sprintf("%s/documents/%s" , storage_path('app') , $doc->src));

      $doc->delete();
    }
}
