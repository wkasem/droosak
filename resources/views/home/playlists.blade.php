@extends('layout')

@section('title' , Lang::get('nav.videos'))


@section('content')


@if(!$filter && $playlists->count())
  <div class="columns">
    <div class="column">
       <a href="?filter=all" class="button">@lang('auth.showallcourses')</a>
    </div>
  </div>
@endif

@foreach($playlists as $playlists_group)
<div class="columns" >
  @foreach($playlists_group as $playlist)
   <div class="column is-one-third">
      <div class="card">
       <div class="card-image">
         <figure class="image is-4by3">
           @if($playlist->poster)
            <img src="/{{ $playlist->playlist_id}}/poster/{{ $playlist->poster}}">
            @else
            <img src="/imgs/video_banco_wiki.jpg">
            @endif
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
         <a href="courses/{{ $playlist->playlist_id }}/videos" class="card-footer-item">
          @lang('playlists.discover')
         </a>
        </footer>
  </div>
</div>
@endforeach
</div>
@endforeach

@if(!$playlists->count())
<section class="section" dir="{{ tdir() }}">
  <div class="container">
    <div class="content">
      @if(!$filter)
        <div class="columns">
          <div class="column">
             <a href="?filter=all" class="button">@lang('auth.showallcourses')</a>
          </div>
        </div>
      @endif
      <h1 class="title">@lang('auth.playlists.error.title')</h1>
       <p>
         @lang('auth.playlists.error.subtitle')
       </p>
    </div>
  </div>
</div>
@endif
@endsection
