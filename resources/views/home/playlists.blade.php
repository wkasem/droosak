@extends('layout')


@section('content')

@foreach($playlists as $playlists_group)
<div class="columns" >
  @foreach($playlists_group as $playlist)
   <div class="column is-one-third">
      <div class="card">
       <div class="card-image">
         <figure class="image is-4by3">
           <img src="http://bulma.io/images/placeholders/1280x960.png" alt="Image">
         </figure>
       </div>
       <div class="card-content">
         <div class="content">
           <span class="title block">{{ $playlist->title }}</span><br>
           {{ $playlist->discription }}
           <br>
            <span class="tag is-info">@lang('playlists.videos_count' , ['count' => $playlist->videos_count])</span><br>
         </div>
       </div>
       <footer class="card-footer">
         <a href="playlists/{{ $playlist->id }}/videos" class="card-footer-item">
          @lang('playlists.discover')
         </a>
        </footer>
  </div>
</div>
@endforeach
</div>
@endforeach
@endsection
