@extends('layout')


@section('content')
<section class="section" dir="{{ tdir() }}">
  <div class="container">
    <div class="content">
      <h1 class="title">@lang('auth.exam.instructions.title')</h1>
       @foreach((array) Lang::get('auth.exam.instructions.steps') as $step)
         <h1>{{ $step['title'] }}</h1>
         <p>
           {{ $step['subtitle'] }}
         </p>
         @endforeach
        <p class="has-text-centered">
           <a href="{{ route('home.exams.start' , ['id' => $exam->id]) }}" class="button">
             @lang('auth.exam.start')
           </a>
        </p>
    </div>
  </div>
</div>

@endsection
