@extends('layout')

@section('title' , $playlist->title)

@section('content')

<div class="columns">
  <div class="column section">
    <div class="container">
        <div class="content has-text-centered">
          <p class="title">
            {{ $playlist->title }}
          </p>
          <h3 class="subtitle">{{ $playlist->discription }}</h3>
        </div>
    </div>
  </div>
</div>

<hr />

@foreach($playlist->videos->chunk(3) as $video_group)
<div class="columns">
  <div class="column section">
    <div class="container">
      <div class="heading">
        <h1 class="title">@lang('nav.videos')</h1>
      </div>
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
</div>
</div>
@endforeach

@if(!$playlist->videos->count())
<div class="columns">
  <div class="column section" dir="{{ tdir() }}">
      <div class="container">
        <div class="content has-text-centered">
          <i class="fa fa-file-video-o" style="font-size:10rem"></i>
          <h1 class="title">@lang('auth.videos.error.title')</h1>
           <p>
             @lang('auth.videos.error.subtitle')
           </p>
        </div>
      </div>
  </div>
</div>
@endif


@if($playlist->documents)
<hr>
<div class="columns">
  <div class="column section">
  <div class="container">
  <div class="heading">
    <h1 class="title">@lang('nav.documents')</h1>
  </div>
  @foreach($playlist->documents as $document)
  <div class="box">
    <article class="media">
      <div class="media-left">
        <figure class="image is-64x64">
          {!! documents($document->src) !!}
        </figure>
      </div>
      <div class="media-content">
        <div class="content">
          <p> {{ $document->name }} </p>
        </div>
      </div>
      <div class="media-right">
        <a  href="/documents/{{ $document->id }}/download"  target="_blank" class="button">
          @lang('nav.download')
        </a>
      </div>
    </article>
  </div>
  @endforeach
</div>
</div>
</div>
@endif

@if(!$playlist->documents->count())
<div class="columns">
  <div class="column section" dir="{{ tdir() }}">
    <div class="container">
      <div class="content has-text-centered">
        <i class="fa fa-file-text-o" style="font-size:10rem"></i>
        <h1 class="title">@lang('auth.documents.error.title')</h1>
         <p>
           @lang('auth.documents.error.subtitle')
         </p>
      </div>
    </div>
  </div>
</div>

@endif


@endsection
