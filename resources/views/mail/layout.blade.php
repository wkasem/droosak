<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Droosak</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <style>
    body,html{
      height: 100%;
    }
    body{
      margin: 0;
      font-family: 'Source Sans Pro', sans-serif;
      direction: rtl;
    }
     .container{
       margin: 0 auto;
       width: 80%;
       height: 100%;
       background: #f1ecec;
       position: relative;
       box-shadow: 0px 0px 2px #333333;
     }
     header{
       width: 100%;
       height: 25%;
       background: #ffb100;
     }
     footer{
       width: 100%;
       height: 10%;
       position: absolute;
       bottom: 0;
       left: 0;
       background: #e0dcdc;
       flex-direction: row;
     }
     .flex{
       display: flex;
       justify-content: center;
       align-items: center;
     }
     .content{
       height: 65%;
       justify-content: flex-start !important;
     }
     .social{
       width: 25px;
       margin: 25px;
     }
    </style>
    @yield('styles')
  </head>
  <body>
    <div class="container">
      <header class="flex">
        <img src="{{secure_asset('imgs/logo.png')}}" style="width: 150px;" />
      </header>

      <div class="content flex">
        @yield('content')
      </div>

      <footer class="flex">
        <a href="{{ config('app.url') }}">Droosak.com</a>
        <a href="{{ $welcome->facebook }}">
          <img src="{{secure_asset('imgs/social/facebook.png')}}" class="social" />
        </a>
        <a href="{{ $welcome->twitter }}">
          <img src="{{secure_asset('imgs/social/twitter.png')}}" class="social" />
        </a>
        <a href="{{ $welcome->instagram }}">
          <img src="{{secure_asset('imgs/social/insta.png')}}" class="social" />
        </a>
      </footer>
    </div>
  </body>
</html>
