@extends('layout')

@section('title' , Lang::get('nav.exams'))


@section('content')
@if($fixed->count())
<div class="columns">
 <div class="column">
<section class="section">
  <div class="container">
    @foreach($fixed as $exam)
    <div class="columns">
      <div class="column">
        <div class="box">
          <article class="media">
            <div class="media-left">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>@lang('exams.'.$exam->title)</strong>
                    <span class="tag is-warning">
                    @lang('auth.points.badge' ,['points' => $exam->points])
                  </span>
                  <br>
                  {{ $exam->discription }}
                </p>
              </div>
              <nav class="level">
                <div class="level-left">
                  <div class="level-item" style="flex-direction:column;align-items:baseline;">
                  @if($exam->user)
                    @if($exam->finished && $exam->started)
                    <progress class="progress is-small {{ $exam->progresscolor }}" value="{{ $exam->user->score }}" max="100" style="width:200px">
                      {{ $exam->user->score }}
                    </progress>

                    <a href="{{ route('home.exams.take' , ['exam' => $exam->id])}}"
                       class="button">@lang('auth.exam.view')</a>
                    @endif
                    @if(!$exam->finished && $exam->started)
                    <a href="{{ route('home.exams.take' , ['exam' => $exam->id])}}"
                       class="button">@lang('auth.exam.complete')</a>
                    @endif
                    @if(!$exam->finished && !$exam->started)
                    <a href="{{ route('home.exams.take' , ['exam' => $exam->id])}}"
                       class="button">@lang('auth.exam.take')</a>
                    @endif
                  @else
                    <a href="{{ route('home.exams.take' , ['exam' => $exam->id])}}"
                       class="button">@lang('auth.exam.take')</a>
                  @endif
                  </div>
                </div>
              </nav>
            </div>
          </article>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>
</div>
</div>
@endif
@if($monthly->count())
<div class="columns">
 <div class="column">
   @foreach($monthly as $year => $month)
   <div class="columns">
     <div class="column">
       <section class="section">
         <div class="container">
           <div class="heading">
             <h1 class="title">{{ $year }}</h1>
           </div>
           @foreach($month as $exam)
           <div class="columns">
             <div class="column">
               <div class="box">
                 <article class="media">
                   <div class="media-left">
                     <i class="fa fa-file-text-o" aria-hidden="true"></i>
                   </div>
                   <div class="media-content">
                     <div class="content">
                       <p>
                         <strong>@lang('exams.'.$exam->title)</strong>
                           <span class="tag is-warning">
                           @lang('auth.points.badge' ,['points' => $exam->points])
                         </span>
                         <br>
                         {{ $exam->discription }}
                       </p>
                     </div>
                     <nav class="level">
                       <div class="level-left">
                         <a class="level-item">
                           <a href="{{ route('home.exams.take' , ['exam' => $exam->id])}}"
                              class="button">@lang('auth.exam.take')</a>
                         </a>
                       </div>
                     </nav>
                   </div>
                 </article>
               </div>
             </div>
           </div>
           @endforeach
         </div>
       </section>
     </div>
   </div>
   @endforeach
 </div>
</div>
@endif

@if(!$fixed->count() && !$monthly->count())
<section class="section" dir="{{ tdir() }}">
  <div class="container">
    <div class="content">
      <h1 class="title">@lang('auth.exams.error.title')</h1>
       <p>
         @lang('auth.exams.error.subtitle')
       </p>
    </div>
  </div>
</div>
@endif


@endsection
