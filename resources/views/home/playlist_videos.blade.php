@extends('layout')

@section('title' , $playlist->title)

@section('content')


<div class="columns">
  <div class="column">
    <div class="card ">
    <header class="card-header">
      <p class="card-header-title">
        {{ $playlist->title }}
      </p>
    </header>
    @if($playlist->discription)
      <div class="card-content">
        <div class="content">
          <h3 class="subtitle">{{ $playlist->discription }}</h3>
        </div>
      </div>
     @endif
  </div>
</div>
</div>


@foreach($playlist->videos->chunk(3) as $video_group)
<div class="columns">
  @foreach($video_group as $video)
     <div class="column is-one-third">
        <div class="card">
           <div class="card-image">
             <figure class="image is-4by3">
               <img src="/video/{{$video->video_id}}/getThumb" alt="{{ $video->title }}">
             </figure>
           </div>
           <div class="card-content">
             <div class="content">
               <span class="title block">{{ $video->title }}</span><br>
               {{ $video->discription }}
               <br>
               <span class="tag is-warning">
               @lang('auth.points.badge' ,['points' => $video->points])
             </span>
             <br />
              <small>{{ $video->published_by->username }}</small>
             </div>
           </div>
           <footer class="card-footer">
            <a href="/video/{{ $video->video_id }}" target="_blank" class="card-footer-item">
              @lang('auth.watch')
            </a>
          </footer>
    </div>
  </div>
  @endforeach
</div>
@endforeach


@endsection
