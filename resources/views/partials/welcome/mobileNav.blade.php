<div class="nav-left is-hidden-desktop">
  <a class="nav-item">
    <img src="/imgs/{{ $welcome->logo }}" alt="Droosak">
  </a>
</div>
<span class="nav-toggle is-hidden-desktop">
  <span></span>
  <span></span>
  <span></span>
</span>
<div class="nav-right nav-menu is-hidden-desktop mobile-nav">
    <a href="#joinus" class="nav-item">
      @lang('welcome.nav.joinus')
    </a>
    @if($playlists)
      <a href="#courses" class="nav-item">
        @lang('welcome.nav.courses')
      </a>
    @endif

    <a href="#teachers" class="nav-item">
      @lang('welcome.nav.teachers')

    </a>

    @foreach($welcome->sections as $section)
      <a href="#{{ camel_case($section['enTitle']) }}" class="nav-item">
        {{ (en()) ? $section['enTitle'] : $section['arTitle'] }}
      </a>
    @endforeach
    
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
