@extends('layout')

@section('title' , Lang::get('nav.messages'))

@section('content')

@if(count($conversations[0]))
  <Messages data='{{ json_encode($conversations) }}'></Messages>
@else
<section class="section">
  <div class="container has-text-centered">
    <div class="heading">
        <h1 class="title">
          <i class="fa fa-inbox" style="font-size:40px"></i>
          @lang('auth.no-messages')
        </h1>
    </div>
  </div>
</section>
@endif
@endsection
