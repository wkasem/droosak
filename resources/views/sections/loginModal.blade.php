<!-- Login Modal -->
<div class="modal modal-login">
  <div class="modal-background"></div>
  <div class="modal-card">
    <section class="modal-card-body">
      <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="login_mobile_code" value="+2" />
        <label class="label">@lang('welcome.emailOrPhone')</label>
        <p class="control has-icon">
          <input class="input {{ ($errors->has('email') && !session()->has('signup_process')) ? 'is-danger' : '' }}" type="text" name="email" value="{{ (!session()->has('signup_process')) ? old('email') : '' }}" />
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
