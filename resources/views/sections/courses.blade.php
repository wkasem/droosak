@if($playlists)
<section class="hero hide-courses" id="courses">
  <div class="hero-body">
    <div class="container">
      @foreach($playlists as $playlist)
      <div class="title course-title">{{ $playlist->title }}</div>
      <div class="columns courses">
        @foreach($playlist->videos as $video)
        <div class="column">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="/v/{{ $video->video_id }}/getThumb" alt="Image">
                  </figure>
                  <figure class="is-play">
                    <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                  </figure>
                </div>
            </div>
          </div>
          @endforeach
        @foreach($playlist->videos as $video)
        <div class="column">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="/v/{{ $video->video_id }}/getThumb" alt="Image">
                  </figure>
                  <figure class="is-play">
                    <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                  </figure>
                </div>
            </div>
          </div>
          @endforeach
        @foreach($playlist->videos as $video)
        <div class="column">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="/v/{{ $video->video_id }}/getThumb" alt="Image">
                  </figure>
                  <figure class="is-play">
                    <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                  </figure>
                </div>
            </div>
          </div>
          @endforeach
        @foreach($playlist->videos as $video)
        <div class="column">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="/v/{{ $video->video_id }}/getThumb" alt="Image">
                  </figure>
                  <figure class="is-play">
                    <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                  </figure>
                </div>
            </div>
          </div>
          @endforeach
      </div>
      @endforeach
    </div>
  </div>
  @if($playlists->count() > 2)
  <div class="course-more">
     <button class="button ">More</button>
  </div>
  @endif

</section>
@endif
