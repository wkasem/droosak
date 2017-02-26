<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <!--styles!-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <section class="hero is-warning is-bold is-fullheight">
      <div class="hero-body">
        <div class="container has-text-centered" id="app">
          <ExamTake data='{{ json_encode($exam) }}' tdir="{{ tdir() }}"></ExamTake>
        </div>
      </div>
    </section>



    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script>
    window.user = {
      'id'         : '{{ auth()->user()->id }}',
      'email'      : '{{ auth()->user()->email }}',
      'first_name' : '{{ auth()->user()->first_name }}',
      'last_name'  : '{{ auth()->user()->last_name }}'
    };

    window.appLocal = '{{ app()->getLocale() }}' || 'en';

    </script>
    <script src="{{ asset('js/app.js')}}"></script>

  </body>
</html>
