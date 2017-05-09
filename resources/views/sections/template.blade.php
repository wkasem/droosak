<section class="hero is-fullheight" id="{{ camel_case($section['enTitle']) }}"
         style="background-color : {{ $section['bgColor']}}">
   <div class="hero-body">
     <div class="container">
       <div class="columns">


         <div class="column {{ (!$section['first']['img']) ? 'is-hero-discription' : '' }}"
              style="background-color : {{ $section['first']['bgColor']}};
                     color : {{ $section['first']['textColor']}}">

          @if($img = $section['first']['img'])
             <img src="imgs/{{ $img }}" />
          @else
             <h1 class="title is-1">
               {{ (en()) ? $section['first']['enText'] : $section['first']['arText']}}
             </h1>
          @endif

         </div>

         @if(!$section['wide'])
           <div class="column {{ (!$section['second']['img']) ? 'is-hero-discription' : '' }}"
                style="background-color : {{ $section['second']['bgColor']}};
                       color : {{ $section['second']['textColor']}}">

            @if($img = $section['second']['img'])
               <img src="imgs/{{ $img }}" />
            @else
               <h1 class="title is-1">
                 {{ (en()) ? $section['second']['enText'] : $section['second']['arText']}}
               </h1>
            @endif

           </div>
          @endif

       </div>
     </div>
   </div>
 </section>
