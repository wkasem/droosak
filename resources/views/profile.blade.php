@extends('layout')


@section('title' , $user->username)

@section('styles')
<style>
.profile-pic{
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: space-around;
}
</style>
@endsection

@section('content')

<section class="section" dir="{{ tdir() }}">

  <div class="container">
    <div class="columns">
      <div class="column is-2 profile-pic">
        <img src="/pic/{{$user->id}}" class="image is-circle" />
        <a href="#" class="button is-pulled-right">Download Cv</a>

      </div>
      <div class="column">
        <span class="title is-2">
          {{ $user->username}}
        </span>
        <span class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
      </div>
    </div>
    <hr />
    <span class="title">Videos</span>
    @foreach($user->videos->chunk(3) as $video_group)
    <div class="columns">
      @foreach($video_group as $video)
         <div class="column is-one-third" >
            <div class="card">
               <div class="card-image">
                 <figure class="image is-4by3">
                   <img src="/video/{{ $video->video_id }}/getThumb" alt="{{ $video->title }}">
                 </figure>
               </div>
               <div class="card-content">
                 <div class="content">
                   <span class="title block">{{ $video->title }}</span><br>
                   {{ $video->discription }}
                   <br>
                   <a >
                     <span class="tag is-info">@lang('auth.views' , ['count' => 2])</span><br>
                   </a>
                   <small>{{ $video->published_by->username }}</small>
                 </div>
               </div>
               <footer class="card-footer">
                <a href="/video/{{ $video->video_id}}" target="_blank" class="card-footer-item">@lang('auth.watch')</a>
              </footer>
        </div>
      </div>
      @endforeach
    </div>
    @endforeach
  </div>
</section>

@endsection
