<div class="nav-left is-hidden-desktop">
  <a class="nav-item">
    <img src="{{ asset('imgs/'.$welcome->logo)}}" alt="Droosak">
  </a>
</div>
<span class="nav-toggle is-hidden-desktop ">
  <span></span>
  <span></span>
  <span></span>
</span>
<div class="nav-mobile nav-menu is-hidden-desktop">
  @if(teacher())
    <a href="{{ route('home.index')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('home.index') }}">
       <i class="fa fa-home" aria-hidden="true"></i>
       @lang('nav.home')
     </a>
  @endif
   <a href="{{ route('messages')}}"
      class="nav-item is-tab {{ active()->output('is-active')->route('messages') }}">
      <i class="fa fa-inbox" aria-hidden="true"></i>
      @lang('nav.messages')
    </a>
  @if(student())
  <a href="{{ route('home.playlists')}}"
     class="nav-item is-tab {{ active()->output('is-active')->route('home.playlists') }}">
     <i class="fa fa-list-alt" aria-hidden="true"></i>
     @lang('nav.videos')
   </a>
   <a href="{{ route('home.schedule')}}"
      class="nav-item is-tab {{ active()->output('is-active')->route('home.schedule') }}">
      <i class="fa fa-calendar" aria-hidden="true"></i>
      @lang('nav.schedule')
    </a>
  <a href="{{ route('home.exams')}}"
     class="nav-item is-tab {{ active()->output('is-active')->route('home.exams') }}">
     <i class="fa fa-inbox" aria-hidden="true"></i>
     @lang('nav.exams')
   </a>
  <a href="{{ route('home.payment')}}"
     class="nav-item is-tab {{ active()->output('is-active')->route('home.payment') }}">
     <i class="fa fa-money" aria-hidden="true"></i>
     @lang('nav.payment')
   </a>
   @endif
   @if(teacher())
     @if($isLive)
       <a href="/video/{{ $isLive->video_id }}"
          class="nav-item is-tab is-live">
          @lang('nav.liveNow')
        </a>
     @else
       <a href="#live"
          class="nav-item is-tab modal-trigger ">
          <i class="fa fa-video-camera is-red" aria-hidden="true"></i>
          @lang('nav.live')
        </a>
     @endif
   @endif
   @if(teacher())
     <a href="{{ route('profile' , ['id' => auth()->user()->id])}}"
        class="nav-item is-tab {{ active()->output('is-active')->route('profile') }}">
          <img src="/pic/{{auth()->user()->id}}"  class="image is-24x24">
          {{ auth()->user()->username }}
      </a>
     @endif
     @if(student())
       <a href="{{ route('home.notifications')}}"
          class="nav-item noti_holder is-tab {{ active()->output('is-active')->route('home.notifications') }}">
          <i class="fa fa-globe" aria-hidden="true"></i>
          @lang('nav.notifications')
          <span class="noti_count" style="display : {{ $notis->count() ? 'block' : 'none' }}"></span>
        </a>
       @endif
   <a href="{{ route('settings')}}"  class="nav-item is-tab"> @lang('nav.settings') </a>
   <a class="nav-item is-tab is-danger"
      onclick="javascript: document.getElementsByName('logout')[0].submit();"> @lang('nav.logout') </a>

   <a href="/lang/{{ en() ? 'ar' : 'en' }}"  class="nav-item">
     {{ en() ? 'عربى' : 'English'}}
   </a>

   <form method="post" action="{{ route('logout') }}" name="logout">

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
