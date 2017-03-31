@extends('mail.layout')

@section('content')

<img src="https://droosak.com/p/{{ $user->id }}" class="pic" />
<strong>{{ $user->username }}</strong>
<p>
  Laracasts
</p>
<p>
  فى بث حى الان
</p>
<a href="{{ route('home.video' , ['id' => $video->video_id])}}"class="button">مشاهدة</a>

@stop
