<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
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

        <title>@lang('welcome.title')</title>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.1/css/bulma.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="js/ddscrollspy.js"></script>
<link href="https://fonts.googleapis.com/css?family=Supermercado+One" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>


<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>


        <script>
          function showLogin(){
            $('.modal-login').addClass('is-active');
          }
          function hideLogin(){
            $('.modal-login').removeClass('is-active');
          }

         $(function(){

           $(document).on('scroll',function(){
             if($(this).scrollTop() > 5){
               $('.top-nav').addClass('is-colored'); return;
             }
             $('.top-nav').removeClass('is-colored');

           });

           $('.course-more .button').click(function(){
             $('#courses').toggleClass('hide-courses');
           });

           if($(document).scrollTop() > 5){
             $('.top-nav').addClass('is-colored');
           }

           $('.nav-menu').ddscrollSpy();

           $('.button-login').click(showLogin);
           $('.modal-background').click(hideLogin);


           $('.courses').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  arrows: false,
  autoplay:true,
  infinite: true,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});

         });
        </script>

        @if( ($errors->has('email') || $errors->has('password')) && !session()->has('signup_process') )
          <script>$(function(){showLogin()});</script>
        @endif

        @if( $errors->has('newsletter_email') )
          <script>$(function(){$('#intouch-btn').click()});</script>
        @endif

        @if( session()->has('intouch_success') )
          <script>$(function(){toastr["success"]("{{ Lang::get('welcome.intouch_success')}}")});</script>
        @endif

        @if( session()->has('contact_success') )
          <script>$(function(){toastr["success"]("{{ Lang::get('welcome.intouch_success')}}")});</script>
        @endif


        <style>
         body,html{
           height: 100%;
           color: #fff;
           font-family: 'Supermercado One', cursive;

         }
         .inView{
           position: absolute;
           top: 0;
           width: 100%;
           height: 100%;
         }
         .label{
           color: #c7c7c7;
         }
         .hero.bg
         {
            background-image: url("imgs/demo_04.jpg");
            background-repeat: no-repeat;
         }

         .top-nav{
           position: fixed;
           width: 100%;
           transition: background .5s ease-in-out;
           z-index: 99;
         }

         .top-nav.is-colored{
           background: #000;
         }

         .nav-item a.is-active, a.nav-item.is-active
         {
           background: #fff;
           color: #000;
         }
         .fa-facebook{color: #6666ff; margin-right: 10px;}
         .fa-instagram{color: #ce9f61; margin-left: 10px;}
         .fa-facebook:hover,.fa-instagram:hover{color: #000;}

         .hero-intro
         {
           width: 50%;
           margin: 45px auto 0 auto;
           border: 1px dashed #d8d4d4;
           position: relative;
         }
         .hero-intro .circle
         {
           border-radius: 100%;
           content: "";
           height: 30px;
           left: 47%;
           position: absolute;
           top: -16px;
           width: 30px;
           z-index: 1;
           border: 1px dashed #d8d4d4;
         }
         .hero-intro .circle.blue{background: #3273dc}


         .hero-body .column
         {
           opacity: 0;
         }

         .hero-body .column.animated
         {
           opacity: 1;
         }

        .custom-font{
          font-family: 'Kaushan Script', cursive;
        }
        .is-play{
          background: rgba(0, 0, 0, 0.35);
          position: absolute;
          top: 0;
          left: 0;
          height: 100%;
          width: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .is-play i{
          font-size: 5rem;
          color: #fff;
        }
        .is-white{
          color: #fff;
        }

        .course-title{
          border-left: 4px solid #ce6e00;
          text-indent: 15px;
        }

        .is-hero-discription{
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          text-align: center;
        }

        .is-pattern{
          background: url('https://www.toptal.com/designers/subtlepatterns/patterns/sayagata-400px.png');

        }
        .card{box-shadow: 0}

        #courses{
          overflow: hidden;
          position: relative;
        }
        .hide-courses{
          max-height: 680px;
        }
        .course-more{
          position: absolute;
          left:50%;
          bottom: 0;
        }
        </style>

        @if(!en())
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">       <style>
           <style>
            body{
              direction: rtl;
              font-family: 'Cairo', sans-serif;
            }
            .label{text-align: right !important;}
            .button{float: right;}
           </style>
        @endif
    </head>
    <body>


      @include('sections.loginModal')

      @include('sections.joinus')

      @include('sections.courses')

      @include('sections.message')

      @include('sections.exams')

      @include('sections.teachers')

      @include('sections.about')

      @include('sections.contact')


    </body>
</html>
