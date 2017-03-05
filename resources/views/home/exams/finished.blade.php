@extends('layout')

@section('title' , Lang::get('exams.'.$exam->title))

@section('content')
<section class="section has-text-centered" dir="{{ tdir() }}">
  <div class="container">
    <div class="content">
      <nav class="level is-mobile">
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">@lang('auth.exam.score')</p>
      <p class="title {{ ($exam->user->score >= 50) ? 'is-green' : 'is-red' }}">
        {{ $exam->user->score}}%
      </p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">@lang('auth.exam.time')</p>
      <p class="title">{{ $exam->user->time}} @lang('auth.exam.min')</p>
    </div>
  </div>
</nav>
   <div class="has-text-centered">
     @if($exam->user->results)
       <div class="level-item has-text-centered">
         <div>
           <p class="title">
             <a href="{{ $exam->id }}/download" class="button">@lang('auth.exam.copy')</a>
           </p>
         </div>
       </div>
     @endif
   </div>
    </div>
  </div>
</section>

@endsection
