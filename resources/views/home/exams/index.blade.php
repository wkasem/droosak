@extends('layout')


@section('content')
<section class="section">
  <div class="container">
    <div class="heading">
      <h1 class="title">@lang('auth.exam.fixed')</h1>
      <hr />
    </div>

    @foreach($exams->chunk(2) as $exam_group)
    <div class="columns">
      @foreach($exam_group as $exam)
      <div class="column">
        <div class="box">
          <article class="media">
            <div class="media-left">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>{{ $exam->title }}</strong>
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
      @endforeach
    </div>
    @endforeach
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="heading">
      <h1 class="title">@lang('auth.exam.monthly')</h1>
      <hr />
    </div>

    @foreach($exams->chunk(2) as $exam_group)
    <div class="columns">
      @foreach($exam_group as $exam)
      <div class="column">
        <div class="box">
          <article class="media">
            <div class="media-left">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>{{ $exam->title }}</strong>
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
      @endforeach
    </div>
    @endforeach
  </div>
</section>


@endsection
