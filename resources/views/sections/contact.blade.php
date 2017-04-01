<footer class="footer" id="contact">
  <div class="container">
    <div class="columns">
      <div class="column">
        <iframe src="{{ $welcome->map }}" height="300" frameborder="0" style="width:100%;border:0"></iframe>
      </div>
      <div class="column">
        <label class="label">@lang('welcome.intouch')</label>
        <form method="post" action="{{route('home.newsletter')}}">
          {{ csrf_field() }}
          <p class="control has-addons">
            <input class="input is-expanded {{ ($errors->has('newsletter_email')) ? 'is-danger' : '' }}" type="text" placeholder="Your Email..." name="newsletter_email">
            <button class="button">
              <span class="icon">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
               </span>
            </button>
          </p>
      </form>
      <hr />
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
            <button class="button is-warning">
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
     </div>
  </div>
</footer>
