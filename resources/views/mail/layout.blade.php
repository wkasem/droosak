<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <style>
    html,body{
      height: 100%;
    }
     body{
       background-color: #efefef;
       font-family: 'Cairo', sans-serif;
       text-align: center;
       direction: rtl;
     }
     a{
       text-decoration: none;
       color: #a0a0a0;
     }
     a:hover{
       color: #000;
     }
     img.pic{
       border-radius: 50%;
     }
     .button{
       background-color: #3fc31e;
        border: none;
        outline: none;
        padding: 10px;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
     }
     .button:hover{
       background-color:#35a219 ;
     }
     .container{
       height: 100%;
       width: 50%;
       margin: 0 auto;
     }
     .head,.foot{
       height: 10%;
       display: flex;
      align-items: baseline;
      justify-content: center;
     }
     .head img{
       height: 100%;
     }
     .panel{
       background: #fff;
       box-shadow: 0 1px 3px #bbb8b8;
       display: flex;
      align-items: center;;
      justify-content: space-around;
      flex-direction: column;
      padding: 15px;
     }
     .panel img{
       width: 30%;
     }
     .foot{
       color: #a0a0a0;
     }
     table{
       width: 100%;
     }
     table thead{
       background: #efefef;
     }
     .time{
       direction: ltr;
     }
    </style>
  </head>
  <body>

   <div class="container">
     <header class="head">
       <img src="{{ asset('imgs/logo.png')}}" />
     </header>
     <div class="panel">
       @yield('content')
     </div>
     <footer class="foot">
      <a href="https://droosak.com">Droosak.com </a> 2016 - {{ date('Y') }} All Rights Reserved
     </footer>
   </div>
  </body>
</html>
