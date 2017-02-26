<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@lang('errors.broketitle')</title>

    <!--styles!-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <section class="hero is-danger is-bold is-fullheight">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            <i class="fa fa-exclamation-circle" style="font-size: 8em;"></i>

          </h1>
          <h2 class="subtitle">
            @lang('errors.brokelink')<br /><br />
            <a href="/" class="button is-info">@lang('errors.back')</a>
          </h2>
        </div>
      </div>
    </section>
  </body>
</html>
