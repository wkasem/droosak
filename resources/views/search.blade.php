@extends('layout')

@section('title' , $key)

@section('content')
<section class="section">
  <div class="container">
    <div class="heading">
      <h1 class="title">"{{ $key }}" @lang('nav.results')</h1><br />
      <hr />

      @if($users->count())
        @foreach($users as $user)
        <div class="box">
          <article class="media">
            <div class="media-left">
              <figure >
                <img src="{{ route('profilePic' , ['id' => $user->id]) }}" class="image is-circle is-64x64">
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>{{ $user->username }}</strong> {{ badge($user) }}
                  <br>
                  {{ $user->about }}
                </p>
              </div>
              <nav class="level">
                <div class="level-left">
                  <a href="{{ route('messages' , ['id' => $user->id])}}" target="_blank" class="level-item">
                    <span class="icon is-small">
                      <i class="fa fa-envelope-o"></i>
                    </span>
                  </a>
                  @if($user->type_id == 2)
                  <a href="{{ route('profile' , ['id' => $user->id])}}" target="_blank" class="level-item">
                    <span class="icon is-small">
                      <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                  </a>
                  @endif
                </div>
              </nav>
            </div>
          </article>
        </div>
      @endforeach

      {{ $users->appends(['s' => $key])->links() }}

    @endif
    </div>
  </div>
</section>

@endsection
