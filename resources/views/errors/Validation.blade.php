<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@lang('validation.page.title') </title>

    <!--styles!-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <section class="hero is-sucess is-bold is-fullheight">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            @lang('validation.page.msg')
          </h1>
          @if(auth()->user()->phone_code)
            <h1 class="title">
              <i class="fa fa-mobile" style="font-size: 6em;"></i>
            </h1>
            <h2 class="subtitle">
              @if(session()->has('wrong_phone_code'))
                <span class="help is-danger">{{ session('wrong_phone_code') }}</span>
              @endif
              <form method="post" action="{{ route('validation.phone') }}">
                {{ csrf_field() }}
                <p class="control has-addons has-addons-centered">
                  <input class="input {{ (session()->has('wrong_phone_code')) ? 'is-danger' : '' }}" type="text" name="code">
                  <button class="button is-primary" type="submit">
                    @lang('validation.page.button')
                  </button>
                </p>
              </form>
            </h2>
          @endif
          @if(auth()->user()->mail_code != "")
          <hr />
            <h1 class="title">
              <i class="fa fa-envelope" style="font-size: 4em;"></i>
            </h1>
            <h2 class="subtitle">
              @if(session()->has('wrong_email_code'))
                <span class="help is-danger">{{ session('wrong_email_code') }}</span>
              @endif
              <form method="post" action="{{ route('validation.email') }}">
                {{ csrf_field() }}
              <p class="control has-addons has-addons-centered">
                <input class="input {{ (session()->has('wrong_email_code')) ? 'is-danger' : '' }}" type="text" name="code">
                <button class="button is-primary" type="submit">
                  @lang('validation.page.button')
                </button>
              </p>
            </form>
            </h2>
          @endif
        </div>
      </div>
      <div class="hero-foot">
        <nav class="tabs is-boxed is-fullwidth">
          <div class="container">
            <ul>
              <li>
                <a class="button is-danger is-outlined">
                  <span class="icon">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                  </span>
                  <span>@lang('validation.page.logout')</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </section>
  </body>
</html>
