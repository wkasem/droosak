<div class="nav-left is-hidden-desktop">
  <a class="nav-item">
    <img src="{{ asset('imgs/logo.png')}}" alt="Bulma logo">
  </a>
</div>
<span class="nav-toggle is-hidden-desktop ">
  <span></span>
  <span></span>
  <span></span>
</span>
<div class="nav-mobile nav-menu is-hidden-desktop">
  <a class="nav-item is-tab"> @lang('nav.home') </a>
  <a href="{{ route('messages')}}"
     class="nav-item is-tab {{ active()->output('is-active')->route('messages') }}">
     @lang('nav.messages')
   </a>
  @if(student())
    <a href="{{ route('home.playlists')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('home.playlists') }}">
       @lang('nav.videos')
     </a>
    <a href="{{ route('home.exams')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('home.exams') }}">
       @lang('nav.exams')
     </a>
     <a href="{{ route('home.payment')}}"
        class="nav-item is-tab {{ active()->output('is-active')->route('home.payment') }}">
        <i class="fa fa-money" aria-hidden="true"></i>
        @lang('nav.payment')
      </a>
   @endif
   <a href="{{ route('settings')}}"  class="nav-item is-tab"> @lang('nav.settings') </a>
   <a class="nav-item is-tab is-danger"
      onclick="javascript: document.getElementsByName('logout')[0].submit();"> @lang('nav.logout') </a>

   <a href="/lang/{{ en() ? 'ar' : 'en' }}"  class="nav-item">
     {{ en() ? 'عربى' : 'English'}}
   </a>

   <form method="post" action="{{ route('logout') }}" name="logout">
     {{ csrf_field() }}
   </form>
    <form action="{{ route('search') }}" class="nav-item control has-addons">
        <span class="select">
          <select name="type" style="height:96%">
            <option value="2">@lang('nav.teachers')</option>
            <option value="3">@lang('nav.students')</option>
          </select>
        </span>
        <input class="input  is-expanded" type="text" name="s" placeholder="{{ Lang::get('nav.search') }}" />
        <button class="button">
          Search
        </button>
   </form>
</div>
