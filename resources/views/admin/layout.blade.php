<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!--styles!-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('styles')
  </head>
  <body >

    @include('partials.admin.content')


  <!--scripts!-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script src="{{ asset('js/jquery.voice.js') }}"></script>
<script src="{{ asset('js/recorder.js') }}"></script>
<script>

$('.nav .nav-toggle').click(function(){

  $(this).next().slideToggle();
});

window.user = {
  'id'         : '{{ auth()->user()->id }}',
  'email'      : '{{ auth()->user()->email }}',
  'username' : '{{ auth()->user()->username }}'
};
window.appLocal = 'en';

</script>
@yield('scripts')
<script src="{{ asset('js/app.js')}}"></script>
  </body>
</html>
