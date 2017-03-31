<section class="hero bg is-fullheight" id="joinus">
   <div class="hero-head top-nav">
     <header class="nav">
       <div class="container">
         <div class="nav-left">
           <a class="nav-item">
             <img src="/imgs/{{ $welcome->logo }}" alt="Droosak">
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
           <a href="#messages" class="nav-item">
             @lang('welcome.nav.messages')

           </a>
           <a href="#exams" class="nav-item">
             @lang('welcome.nav.exams')

           </a>
           <a href="#teachers" class="nav-item">
             @lang('welcome.nav.teachers')

           </a>
           <a href="#about" class="nav-item">
             @lang('welcome.nav.about')

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
                <h2 class="title is-1 is-white"
                    style=" {{ loadFontStyle($welcome , 'title_english') }}">
                  {{ $welcome->title_english}}
                </h2>
                <h4 class="subtitle is-white"
                style=" {{ loadFontStyle($welcome , 'subtitle_english') }}">
                  {{ $welcome->subtitle_english}}
                </h4>
              @endif
              @if(!en())
                <h2 class="title is-1 is-white"
                style=" {{ loadFontStyle($welcome , 'title_arabic') }}">
                  {{ $welcome->title_arabic}}
                </h2>
                <h4 class="subtitle is-white"
                style=" {{ loadFontStyle($welcome , 'subtitle_english') }}">
                  {{ $welcome->subtitle_arabic}}
                </h4>
              @endif
            </div>
            <div class="column">
              <form  method="post" action="{{ action('Auth\RegisterController@register') }}">
                {{ csrf_field() }}
                <label class="label">@lang('welcome.username')</label>
                <p class="control has-icon">
                  <input class="input {{ ($errors->has('username')) ? 'is-danger' : '' }}" type="text" name="username" value="{{ old('username') }}">
                  <span class="icon is-small">
                    <i class="fa fa-terminal"></i>
                  </span>
                  @if($errors->has('username') )
                    <span class="help is-danger">{{ $errors->first('username') }}</span>
                  @endif
                </p>

                <label class="label">@lang('welcome.email')</label>
                <p class="control has-icon">
                  <input class="input {{ ($errors->has('email') && session()->has('signup_process')) ? 'is-danger' : '' }}" type="text" name="email" value="{{ (session()->has('signup_process')) ? old('email') : '' }}">
                  <span class="icon is-small">
                    <i class="fa fa-envelope"></i>
                  </span>
                  @if($errors->has('email') && session()->has('signup_process'))
                    <span class="help is-danger">{{ $errors->first('email') }}</span>
                  @endif
                </p>

                <label class="label">@lang('welcome.phone_number')</label>
                <p class="control">
                  <input id="phone" class="input {{ ($errors->has('phone_number')) ? 'is-danger' : '' }}" type="text" value="{{ old('phone_number')}}">
                  <input type="hidden" name="phone_number" value="{{ old('phone_number')}}" />
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

                <label class="label">@lang('welcome.stage')</label>
                <p class="control has-icon">
                  <span class="select" style="width:100%;">
                    <select name="stage_id" style="width:100%;">
                      @foreach($stages as $stage)
                        <option value="{{ $stage->id }}">@lang('exams.'.$stage->title)</option>
                      @endforeach
                    </select>
                  </span>
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
