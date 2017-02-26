@extends('layout')


@section('content')
<section class="section" dir="{{ tdir() }}">
  <div class="container">
    <div class="content">
      <h1 class="title">@lang('auth.points.error.title')</h1>
       <p>
         @lang('auth.points.error.subtitle')
       </p>
    </div>
  </div>
</div>

@endsection
