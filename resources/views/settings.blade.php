@extends('layout')

@section('title' , Lang::get('nav.settings'))

@section('styles')
<style>
.change-pic{
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: space-around;
}
</style>
@endsection
@section('scripts')
 @if(session()->has('updated') || session()->has('status'))
  <script>
  $(function(){
    Alert.updated();
  });
  </script>
  @endif
@endsection

@section('content')

<section class="section" dir="{{ tdir() }}">

  <div class="container">
    <div class="columns">
      <div class="column is-2 has-text-centered change-pic">
       <img  class="image is-128x128 is-circle" src="/pic/{{ auth()->user()->id }}" />

        <form method="post" name="profilepic" action="{{ route('settings.pic') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="is-file ">
            <input type="file" name="pic"
            onchange="javascript: setTimeout(function(){ document.getElementsByName('profilepic')[0].submit(); } , 1000);"/>
              <a class="button ">
                <span>{{ Lang::get('auth.change')}} </span>
              </a>
            @if($errors->has('pic'))
              <span class="help is-danger">{{ $errors->first('pic') }}</span>
            @endif
          </div>
        </form>
      </div>
      <div class="column">
        <h3 class="subtitle">{{ Lang::get('auth.username')}}</h3>

        <form method="post" action="{{ route('settings.username')}}">
          {{ csrf_field()}}
        <div class="control is-grouped">
          <p class="control is-expanded">
            <input class="input {{ ($errors->has('username')) ? 'is-danger' : '' }}" name="username" type="text" value="{{ auth()->user()->username }}">
            @if($errors->has('username'))
              <span class="help is-danger">{{ $errors->first('username') }}</span>
            @endif
          </p>
          <p class="control">
            <button class="button is-info">
              {{ Lang::get('auth.change')}}
            </button>
          </p>
        </div>
      </form>
        <hr />

        @if(student())
          <h3 class="subtitle">{{ Lang::get('auth.stage')}}</h3>

          <form method="post" action="{{ route('settings.stage')}}">
            {{ csrf_field()}}
          <div class="control is-grouped">
            <p class="control is-expanded">
              <span class="select">
                <select name="stage_id" style="width:100%;">
                  @foreach($stages as $stage)
                    <option value="{{ $stage->id }}"
                           {{ ($stage->id == auth()->user()->stage_id) ? "selected" : ""}}>
                      {{ $stage->title }}
                    </option>
                  @endforeach
                </select>
              </span>
            </p>
            <p class="control">
              <button class="button is-info">
                {{ Lang::get('auth.change')}}
              </button>
            </p>
          </div>
        </form>
          <hr />
        @endif
        <h3 class="subtitle">{{ Lang::get('auth.password-change')}}</h3>
        <form method="post" action="/password/reset">
          {{ csrf_field() }}
          <input type="hidden" value="{{ auth()->user()->email }}" name="email" />
          <input type="hidden" value="{{app('auth.password.broker')->createToken(auth()->user())}}" name="token" />
        <div class="control is-grouped">
          <p class="control is-expanded">
            <input class="input" type="password" name="password"
            placeholder="{{ Lang::get('auth.newPass')}}">
            @if($errors->has('password'))
            <span class="help is-danger">{{ $errors->first('password') }}</span>
            @endif
          </p>
          <p class="control is-expanded">
            <input class="input" type="password" name="password_confirmation"
            placeholder="{{ Lang::get('auth.newPass')}}">
            @if($errors->has('password_confirmation'))
            <span class="help is-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </p>
          <p class="control">
            <button class="button is-info">
              {{ Lang::get('auth.change')}}
            </button>
          </p>
        </div>
      </form>
      </div>
    </div>
  </div>
</section>

@endsection
