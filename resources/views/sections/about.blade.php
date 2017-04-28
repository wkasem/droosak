@foreach($welcome->sections as $section)
<section class="hero is-large" style="background-color : {{$section['bgColor'] }}" id="about">
   <div class="hero-body">
     <div class="container">
       <div class="columns">
         <div class="column has-text-centered {{ ($section['wide']) ? ' is-12' : ''}}"
              style="font-size:2rem;background-color : {{ $section['first']['bgColor']}}">

          @if($img = $section['first']['img'])
             <img src="imgs/{{ $img }}" />
          @else
            <h1 class="title is-1" style="color : {{ $section['first']['textColor']}}">
              {{ $section['first']['enText'] }}
            </h1>
          @endif
         </div>

         @if(!$section['wide'])
           <div class="column has-text-centered"
                style="font-size:2rem;background-color : {{ $section['second']['bgColor']}};color :{{ $section['second']['textColor']}}">

            @if($img = $section['second']['img'])
               <img src="imgs/{{ $img }}" />
            @else
              <h1 class="title is-1"> {{ $section['second']['enText'] }}</h1>
            @endif
           </div>
         @endif

       </div>
     </div>
   </div>
 </section>
@endforeach
