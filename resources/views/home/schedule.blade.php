@extends('layout')

@section('title' , Lang::get('nav.schedule'))

@section('content')

@foreach($schedules as $schedule)
<div class="columns" >
  <div class="column">
    <section class="section">
      <div class="heading">
        <span class="title">{{$schedule->title}}</span>
      </div>
      <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th><abbr title="day">Day</abbr></th>
              <th><abbr title="from">From</abbr></th>
              <th><abbr title="to">To</abbr></th>
            </tr>
          </thead>
          <tbody>
            @foreach($schedule->times as $time)
            <tr>
              <td>
                <h3>{{ days($time->day , tdir()) }}</h3>
              </td>
              <td dir="ltr">
                <h3>{{ $time->from }}</h3>
              </td>
              <td dir="ltr">
                <h3>{{ $time->to }}</h3>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </form>
      </div>
    </section>
  </div>
</div>
@endforeach


@if(!$schedules->count())
<section class="section" dir="{{ tdir() }}">
  <div class="container">
    <div class="content">
      <h1 class="title">@lang('auth.schedules.error.title')</h1>
       <p>
         @lang('auth.schedules.error.subtitle')
       </p>
    </div>
  </div>
</div>
@endif


@endsection
