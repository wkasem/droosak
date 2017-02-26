<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@lang('welcome.title')</title>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.1/css/bulma.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="js/ddscrollspy.js"></script>

        <script>
          function showLogin(){
            $('.modal-login').addClass('is-active');
          }
          function hideLogin(){
            $('.modal-login').removeClass('is-active');
          }

         $(function(){

           $(document).on('scroll',function(){ if($(this).scrollTop() > 5){ $('.top-nav').addClass('is-colored'); return; } $('.top-nav').removeClass('is-colored'); });
           $(document).ready(function(){ if($(this).scrollTop() > 5){ $('.top-nav').addClass('is-colored'); return; } $('.top-nav').removeClass('is-colored'); });

           $('.nav-menu').ddscrollSpy();

           $('.button-login').click(showLogin);
           $('.modal-background').click(hideLogin);

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
         .title,.subtitle{color: #fff;}

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
         .title{
                   line-height: 2;
         }
         .newsletter input{
           flex-grow: 1;
           flex-shrink: 0;
           font-size: 2rem;
           padding: 10px;

         }

         .newsletter input,
         .newsletter button{
           height: 80px;
           box-shadow: 0px 0px 5px grey;
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

      <!-- Login Modal -->
      <div class="modal modal-login">
        <div class="modal-background"></div>
        <div class="modal-card">
          <section class="modal-card-body">
            <form action="{{ route('login') }}" method="post">
              {{ csrf_field() }}
              <label class="label">@lang('welcome.email')</label>
              <p class="control has-icon">
                <input class="input {{ ($errors->has('email') && !session()->has('signup_process')) ? 'is-danger' : '' }}" type="email" name="email" />
                <span class="icon is-small">
                  <i class="fa fa-envelope"></i>
                </span>
                @if($errors->has('email') && !session()->has('signup_process'))
                  <span class="help is-danger">{{ $errors->first('email') }}</span>
                @endif
              </p>
              <label class="label">@lang('welcome.password')</label>
              <p class="control has-icon">
                <input class="input {{ ($errors->has('password') && !session()->has('signup_process')) ? 'is-danger' : '' }}" type="password" name="password">
                <span class="icon is-small">
                  <i class="fa fa-lock"></i>
                </span>
                @if($errors->has('password') && !session()->has('signup_process'))
                  <span class="help is-danger">{{ $errors->first('password') }}</span>
                @endif
              </p>
              <p class="control">
                <button class="button is-success" type="submit">
                  @lang('welcome.login')
                </button>
              </p>
            </form>
          </section>
        </div>
      </div>

      <section class="hero bg is-fullheight" id="joinus">
         <!-- Hero header: will stick at the top -->
         <div class="hero-head top-nav">
           <header class="nav">
             <div class="container">
               <div class="nav-left">
                 <a class="nav-item">
                   <img src="{{ asset('imgs/logo.png')}}" alt="Droosak">
                 </a>
               </div>
               <span class="nav-toggle">
                 <span></span>
                 <span></span>
                 <span></span>
               </span>
               <div class="nav-right nav-menu">
                 <a href="#joinus" class="nav-item">
                   @lang('welcome.nav.joinus')
                 </a>
                 <a href="#courses" class="nav-item">
                   @lang('welcome.nav.courses')

                 </a>
                 <a href="#teachers" class="nav-item">
                   @lang('welcome.nav.teachers')

                 </a>
                 <a class="nav-item">
                   @lang('welcome.nav.about')

                 </a>
                 <a href="#intouch" class="nav-item" id="intouch-btn">
                   @lang('welcome.nav.intouch')

                 </a>
                 <a href="#contact" class="nav-item">
                   @lang('welcome.nav.contact')

                 </a>
                 <span class="nav-item">
                   <a class="button button-login is-success is-inverted">
                     <span>@lang('welcome.login')</span>
                   </a>
                 </span>
                 <span class="nav-item">
                   <a href="lang\{{ en() ? 'ar' : 'en'}}" class="button">
                     <span>{{ en() ? "عربى" : "English"}}</span>
                   </a>
                 </span>
               </div>
             </div>
           </header>
         </div>

         <!-- Hero content: will be in the middle -->
         <div class="hero-body">
           <div class="container">
                 <div class="columns">

                  <div class="column has-text-centered">
                    @if(en())
                      <h2 class="title is-1 ">
                        {{ $welcome->title_english}}
                      </h2>
                      <h4 class="subtitle">
                        {{ $welcome->subtitle_english}}
                      </h4>
                    @endif
                    @if(!en())
                      <h2 class="title is-1 ">
                        {{ $welcome->title_arabic}}
                      </h2>
                      <h4 class="subtitle">
                        {{ $welcome->subtitle_arabic}}
                      </h4>
                    @endif

                  </div>
                  <div class="column">
                    <form method="post" action="{{ action('Auth\RegisterController@register') }}">
                      {{ csrf_field() }}
                      <label class="label">@lang('welcome.username')</label>
                      <p class="control has-icon">
                        <input class="input {{ ($errors->has('username')) ? 'is-danger' : '' }}" type="text" name="username">
                        <span class="icon is-small">
                          <i class="fa fa-terminal"></i>
                        </span>
                        @if($errors->has('username') )
                          <span class="help is-danger">{{ $errors->first('username') }}</span>
                        @endif
                      </p>

                      <label class="label">@lang('welcome.email')</label>
                      <p class="control has-icon">
                        <input class="input {{ ($errors->has('email') && session()->has('signup_process')) ? 'is-danger' : '' }}" type="text" name="signup_email">
                        <span class="icon is-small">
                          <i class="fa fa-envelope"></i>
                        </span>
                        @if($errors->has('email') && session()->has('signup_process'))
                          <span class="help is-danger">{{ $errors->first('email') }}</span>
                        @endif
                      </p>

                      <label class="label">@lang('welcome.phone_number')</label>
                      <p class="control has-icon">
                        <input class="input {{ ($errors->has('phone_number')) ? 'is-danger' : '' }}" type="text" name="phone_number">
                        <span class="icon is-small">
                          <i class="fa fa-mobile"></i>
                        </span>
                        @if($errors->has('phone_number'))
                          <span class="help is-danger">{{ $errors->first('phone_number') }}</span>
                        @endif
                      </p>

                      <label class="label">@lang('welcome.password')</label>
                      <p class="control has-icon">
                        <input class="input {{ ($errors->has('email') && session()->has('signup_process')) ? 'is-danger' : '' }}" type="password" name="password">
                        <span class="icon is-small">
                          <i class="fa fa-lock"></i>
                        </span>
                        @if($errors->has('password'))
                          <span class="help is-danger">{{ $errors->first('password') }}</span>
                        @endif
                      </p>
                      <p class="control">
                        <button class="button is-success">
                          @lang('welcome.signup')
                        </button>
                      </p>
                   </form>
                  </div>
                </div>
           </div>
         </div>

      </section>

      <section class="hero  is-info is-large" id="courses">
        <div class="hero-head has-text-centered">
          <span class="title">Courses</span>
          <div class="hero-intro"> <span class="circle blue"></span> </div>
        </div>
        <div class="hero-body">
          <div class="container">
            <div class="columns">
              <div class="column">
                <div class="card">
                  <div class="card-image">
                    <figure class="image is-4by3">
                      <img src="imgs/41389897-Vector-flat-horizontal-illustration-of-group-of-kids-in-graduation-gowns-and-caps-opposite-school-bu-Stock-Vector.jpg" alt="Image">
                    </figure>
                  </div>
                  <div class="card-content">
                    <div class="content">
                      Seconday Courses
                    </div>
                  </div>
                </div>
              </div>
              <div class="column">
                <div class="card">
                  <div class="card-image">
                    <figure class="image is-4by3">
                      <img src="imgs/164401936.jpg" alt="Image">
                    </figure>
                  </div>
                  <div class="card-content">

                    <div class="content">
                      Primary Courses
                      <br>
                    </div>
                  </div>
                </div>
              </div>
              <div class="column">
                <div class="card">
                  <div class="card-image">
                    <figure class="image is-4by3">
                      <img src="imgs/164401936.jpg" alt="Image">
                    </figure>
                  </div>
                  <div class="card-content">

                    <div class="content">
                      Other Courses
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </section>


     <section class="hero is-primary is-bold is-large" id="teachers" dir="ltr">
       <div class="hero-head has-text-centered">
         <span class="title">Courses</span>
         <div class="hero-intro"> <span class="circle green"></span> </div>
       </div>
        <div class="hero-body">
          <div class="container">
            <div class="columns">
              <div class="column">
                <div class="box">
                  <article class="media">
                    <div class="media-left">
                      <figure class="image is-64x64">
                        <img src="imgs/testi_02-365x370.png" alt="Image">
                      </figure>
                    </div>
                    <div class="media-content">
                      <div class="content">
                        <p>
                          <strong>John Smith</strong> <small>@johnsmith</small>
                          <br>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                        </p>
                      </div>
                      <nav class="level">
                        <div class="level-left">
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-reply"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-heart"></i></span>
                          </a>
                        </div>
                      </nav>
                    </div>
                  </article>
                </div>
              </div>
              <div class="column">
                <div class="box">
                  <article class="media">
                    <div class="media-left">
                      <figure class="image is-64x64">
                        <img src="imgs/testi_03-365x370.png" alt="Image">
                      </figure>
                    </div>
                    <div class="media-content">
                      <div class="content">
                        <p>
                          <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                          <br>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                        </p>
                      </div>
                      <nav class="level">
                        <div class="level-left">
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-reply"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-heart"></i></span>
                          </a>
                        </div>
                      </nav>
                    </div>
                  </article>
                </div>
              </div>
            </div>
            <div class="columns">
              <div class="column">
                <div class="box">
                  <article class="media">
                    <div class="media-left">
                      <figure class="image is-64x64">
                        <img src="imgs/testi_03-365x370.png" alt="Image">
                      </figure>
                    </div>
                    <div class="media-content">
                      <div class="content">
                        <p>
                          <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                          <br>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                        </p>
                      </div>
                      <nav class="level">
                        <div class="level-left">
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-reply"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-heart"></i></span>
                          </a>
                        </div>
                      </nav>
                    </div>
                  </article>
                </div>
              </div>
              <div class="column">
                <div class="box">
                  <article class="media">
                    <div class="media-left">
                      <figure class="image is-64x64">
                        <img src="imgs/testi_03-365x370.png" alt="Image">
                      </figure>
                    </div>
                    <div class="media-content">
                      <div class="content">
                        <p>
                          <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                          <br>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                        </p>
                      </div>
                      <nav class="level">
                        <div class="level-left">
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-reply"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                          </a>
                          <a class="level-item">
                            <span class="icon is-small"><i class="fa fa-heart"></i></span>
                          </a>
                        </div>
                      </nav>
                    </div>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="hero is-primary is-bold is-large" id="intouch">
         <div class="hero-body">
           <div class="container">
             <div class="columns">
               <div class="column">
                 <form method="post" action="{{route('home.newsletter')}}">
                   {{ csrf_field() }}
                   <p class="control has-addons newsletter">
                     <input   class="input {{ ($errors->has('newsletter_email')) ? 'is-danger' : '' }}" type="text" placeholder="Your Email..." name="newsletter_email">
                     <button class="button">
                       <span class="icon">
                         <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </span>
                        <span>   @lang('welcome.intouch')</span>
                     </button>
                   </p>
               </form>
               </div>
             </div>
           </div>
         </div>
       </section>

      <footer class="footer" id="contact">
        <div class="container">
          <div class="columns">
            <div class="column">
              <iframe src="{{ $welcome->map }}" width="600" height="300" frameborder="0" style="border:0"></iframe>
            </div>
            <div class="column">
              <form method="post" action="{{ route('home.contact') }}">
                {{ csrf_field() }}
                <label class="label">@lang('welcome.username')</label>
                <p class="control">
                  <input class="input {{ ($errors->has('contact_username')) ? 'is-danger' : '' }}" type="text" name="contact_username">
                </p>
                <label class="label">@lang('welcome.email')</label>
                <p class="control">
                  <input class="input {{ ($errors->has('contact_email')) ? 'is-danger' : '' }}" type="text" name="contact_email">
                </p>
                <label class="label">@lang('welcome.msg')</label>
                <p class="control">
                  <textarea class="textarea {{ ($errors->has('contact_msg')) ? 'is-danger' : '' }}" name="contact_msg"></textarea>
                </p>
                <p class="control">
                  <button class="button is-success">
                    @lang('welcome.send')
                  </button>
                </p>
              </form>
            </div>
          </div>
          <div class="content has-text-centered">
             <p>
               <a class="icon" href="{{ $welcome->facebook }}" target="_blank">
                 <i class="fa fa-facebook"></i>
               </a>
               <a class="icon" href="{{ $welcome->twitter }}" target="_blank">
                 <i class="fa fa-twitter"></i>
               </a>
               <a class="icon" href="{{ $welcome->instagram}}" target="_blank">
                 <i class="fa fa-instagram"></i>
               </a>
             </p>
             <p>
  <strong>Droosak</strong> by <a href="#">Waleed Kasem</a>. The source code is licensed
  <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
  is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC ANS 4.0</a>.
</p>
           </div>
        </div>
      </footer>
    </body>
</html>
