@extends('layout')

@section('title' , Lang::get('nav.notifications'))


@section('content')

<article class="section" dir="{{ tdir() }}">
  @foreach($notifications as $noti)
    <div class="columns">
      <div class="column is-10">
      @if($noti->type == 'droosak\Notifications\SchedulePublish')
        <strong>{{ $noti->data['title'] }}</strong>
      @elseif($noti->type == 'droosak\Notifications\ExamPublished')
      <strong>{{ Lang::get('exams.'.$noti->data['exam']['title']) }}</strong>
      @elseif($noti->type == 'droosak\Notifications\LiveEvent')
      <strong>{{ $noti->data['user']['username'] }}</strong>
      @endif
      {{ Lang::get('notifications.'.$noti->type)}}
      @if($noti->type == 'droosak\Notifications\LiveEvent')
      <a href="{{ route('home.video' , ['id' => $noti->data['video']['video_id'] ]) }}">
      {{ $noti->data['video']['title'] }}
      </a>
      @endif
      </div>
      <div class="column">
        {{ $noti->created_at->diffForHumans() }}
      </div>
    </div>

    <hr />
  @endforeach

  @if(!$notifications->count())
  <h4 class="has-text-centered">
    @lang('notifications.empty')
  </h4>
  @endif
</article>

@endsection
