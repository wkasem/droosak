@extends('layout')


@section('content')
<section class="section" dir="{{ tdir() }}">
  <div class="container">
    <div class="content has-text-centered">
      <img src="/imgs/money-bill-and-coins_318-47813.jpg" class="image is-128x128" style="display:inline" />
      <h1 class="title">@lang('auth.points.error.title')</h1>
       <p>
         @lang('auth.points.error.subtitle')
       </p>
    </div>
  </div>
</div>

@endsection
