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
    @if(auth()->user()->id == $user->id)
    <Profile data='{{json_encode($user)}}'></Profile>
    @else
    <div class="columns">
      <div class="column is-2 profile-pic">
        <img src="/pic/{{$user->id}}" class="image is-circle" />
        @if($user->cv_src)
         <a href="/teachers/download/{{$user->id}}/cv" class="button is-pulled-right">@lang('auth.download_cv')</a>
        @endif
      </div>
      <div class="column">
        <span class="title is-2">
          {{ $user->username}}
        </span>
         <span class="subtitle">{{ ($user->about) ? $user->about : ''}}</span>
      </div>
    </div>
    @endif
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
