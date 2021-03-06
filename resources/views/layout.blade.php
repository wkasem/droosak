<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
    <link rel="manifest" href="/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title')</title>

    <!--styles!-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @foreach($fonts as $font)
     <style>
       @font-face {
         font-family: "{{ $font->id }}";
         src: url({{ "/fonts/$font->src" }});
       }
     </style>
    @endforeach

    @if($font = $welcome->fonts['main_english'] && en())
     <style>
       body{
         font-family: "{{ $font }}"
       }
      </style>
      @endif

    @if($font = $welcome->fonts['main_arabic'] && !en())
     <style>
       body{
         font-family: "{{ $font }}"
       }
      </style>
      @elseif(!en() && !$font)
      <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
      <style>
         body{
           font-family: 'Cairo', sans-serif;

         }
        </style>
      @endif

      <style>
       .hero{
         background-repeat: no-repeat;
         background-size: cover;
       }
      </style>
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
  'type_id'    : '{{ auth()->user()->type_id }}',
};

window.appLocal = "{{ en() ? 'en' : 'ar'}}";
</script>
@yield('scripts')
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('js/main.js')}}"> </script>

  </body>
</html>
