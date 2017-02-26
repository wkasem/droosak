@extends('layout')


@section('scripts')

@if(session()->has('payment-status'))
 <script>
   Alert.notify("{{ session('payment-status')}}");
 </script>
@endif

@endsection

@section('content')
<section class="section">
  <div class="container">
    <div class="heading">
      <h1 class="title"> @lang('auth.points.explain') </h1>
      <span class="tag is-warning is-large">
        @lang('auth.points.badge' , ['points' => auth()->user()->points])
      </span>
    </div>
    <hr />
    <div class="heading" style="display:flex;align-items: center;">
      <h1 class="title" > <i class="fa fa-paypal" aria-hidden="true"></i> </h1>
      <h1 class="title" > PayPal</h1>
    </div>
      <form method="post" action="{{ route('home.payment') }}" class="control has-addons">
        {{ csrf_field()}}
        <input class="input is-expanded" type="number">
        <button class="button">
          @lang('auth.points.button')
        </button>
      </form>
      <hr />
      <div class="columns">
        <div class="column">
          <img src="{{ asset('imgs/5137Image4.png')}}" class="image" />
        </div>
        <div class="column">
          <span class="tag is-warning is-large">
            0109454225
          </span>
          <img src="{{ asset('imgs/cashmenu.png')}}" class="image" />
        </div>
      </div>
  </div>
</section>
@endsection
