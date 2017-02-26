<section class="hero is-warning is-bold is-fullheight">
  <div class="hero-head" dir="{{ en() ? 'ltr' : 'rtl'}}">
    <header class="nav  has-shadow">
      <div class="container">
         @include('partials.admin.nav')
      </div>
    </header>
  </div>

  <div class="hero-body">
    <div class="container" id="app">
      @yield('content')
    </div>
  </div>

</section>

@include('partials.footer')
