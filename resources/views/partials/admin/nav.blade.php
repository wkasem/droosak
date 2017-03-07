 <div class="nav-left is-hidden-touch">
    <a class="nav-item">
      <img src="{{ asset('imgs/'.$welcome->logo)}}" alt="Droosak" class="main-logo">
    </a>

    <a href="{{ route('admin.index')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('admin.index') }}">
       <i class="fa fa-home" aria-hidden="true"></i>
       @lang('nav.home')
     </a>
    <a href="{{ route('admin.students')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('admin.students') }}">
       <i class="fa fa-users" aria-hidden="true"></i>
       @lang('nav.students')
     </a>
    <a href="{{ route('admin.teachers')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('admin.teachers') }}">
       <i class="fa fa-users" aria-hidden="true"></i>
       @lang('nav.teachers')
     </a>
    <a href="{{ route('messages')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('admin.messages') }}">
       <i class="fa fa-inbox" aria-hidden="true"></i>
       @lang('nav.messages')
     </a>
    <a href="{{ route('admin.playlists')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('admin.playlists') }}">
       <i class="fa fa-video-camera" aria-hidden="true"></i>
       @lang('nav.videos')
     </a>
    <a href="{{ route('admin.schedule')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('admin.schedule') }}">
       <i class="fa fa-calendar" aria-hidden="true"></i>
       @lang('nav.schedule')
     </a>
    <a href="{{ route('admin.exams')}}"
       class="nav-item is-tab {{ active()->output('is-active')->route('admin.exams') }}">
       <i class="fa fa-file-text" aria-hidden="true"></i>
       @lang('nav.exams')
     </a>
  </div>

  <!-- Mobile -->

  @include('partials.admin.mobileNav')

  <!--mobile -->

  <div class="nav-right nav-menu is-hidden-touch">
    <a href="{{ route('settings')}}"  class="nav-item is-tab"> @lang('nav.settings') </a>
    <a class="nav-item is-tab is-danger"
       onclick="javascript: document.getElementsByName('logout')[0].submit();"> @lang('nav.logout') </a>
       <a href="/lang/{{ en() ? 'ar' : 'en' }}"  class="nav-item">
         {{ en() ? 'عربى' : 'English'}}
       </a>
    <form method="post" action="{{ route('logout') }}" name="logout">
      {{ csrf_field() }}
    </form>
  </div>
</div>
</header>
</div>
