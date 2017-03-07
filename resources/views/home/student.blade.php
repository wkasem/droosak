<section class="section">
  <div class="container">
    <div class="heading">
      <h1 class="title">@lang('auth.latest_videos')</h1>
      <div class="columns">
        @foreach($videos as $video)
           <div class="column is-one-third">
              <div class="card">
                 <div class="card-image">
                   <figure class="image is-4by3">
                     <img src="/video/{{$video->video_id}}/getThumb" alt="{{ $video->title }}">
                   </figure>
                 </div>
                 <div class="card-content">
                   <div class="content">
                     <span class="title block">{{ $video->title }}</span><br>
                     {{ $video->discription }}
                     <br>
                     <figure class="box-publish">
                       <img src="/pic/{{$video->published_by->id}}"  class="image is-24x24">
                       <a href="/profile/{{$video->published_by->id}}" target="_blank"><small>{{ $video->published_by->username }}</small></a>
                     </figure>
                   </div>
                 </div>
                 <footer class="card-footer">
                  <a href="/video/{{ $video->video_id }}" target="_blank" class="card-footer-item">
                    Watch
                  </a>
                </footer>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
