<section class="hero is-warning is-bold is-fullheight">
  <div class="hero-head" dir="{{ en() ? 'ltr' : 'rtl'}}">
    <header class="nav  has-shadow">
      <div class="container">
         @include('partials.home.nav')
      </div>
    </header>
  </div>

  <div class="hero-body">
    <div class="container" id="app">
      @yield('content')
    </div>
  </div>

</section>

@if(teacher())
  <div class="modal" id="live">
  <div class="modal-background"></div>
  <div class="modal-content">
    <form method="post" action="{{ route('home.live') }}">
      {{ csrf_field() }}
      <div class="box">
        <article class="media">
          <div class="media-content">
            <div class="content ">
              <h1 class="title is-dark">@lang('nav.live')</h1>
                <p class="control">
                  <input  type="text" class="input is-expanded" name="title" placeholder="Title">
                </p>
                <p class="control">
                  <textarea class="textarea" placeholder="Discription" name="discription"></textarea>
                </p>
                <p class="control">
                  <button class="button is-success" type="submit">
                    add
                  </button>
                </p>
            </div>
          </div>
        </article>
      </div>
   </form>
  </div>
  <a class="modal-close"></a>
  </div>
@endif

@include('partials.footer')
