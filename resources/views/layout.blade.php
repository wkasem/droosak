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
    @if(!en())
     <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">       <style>
        body{
          font-family: 'Cairo', sans-serif;

        }
       </style>
    @endif
    @yield('styles')
  </head>
  <body >

  @include(admin() ? 'partials.admin.content' : 'partials.home.content')


 <audio src="{{ asset('sound/demonstrative.mp3')}}"
        id="notification_alert">
 </audio>
  <!--scripts!-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/jquery.voice.js') }}"></script>
<script src="{{ asset('js/recorder.js') }}"></script>
<script>
window.user = {
  'id'         : '{{ auth()->user()->id }}',
  'email'      : '{{ auth()->user()->email }}',
  'username'   : '{{ auth()->user()->username }}',
};

window.appLocal = "{{ en() ? 'en' : 'ar'}}";
</script>
@yield('scripts')
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('js/main.js')}}"> </script>

  </body>
</html>
