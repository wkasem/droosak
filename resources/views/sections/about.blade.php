<section class="hero is-warning is-large" id="about">
   <div class="hero-body">
     <div class="container">
       <div class="columns">
         <div class="column has-text-centered" style="font-size:2rem;">

           @if(en())
             <p
             style=" {{ loadFontStyle($welcome , 'about_english') }}">
               <i class="fa fa-quote-left" aria-hidden="true"></i>
               {{ $welcome->about_english}}
               <i class="fa fa-quote-right" aria-hidden="true"></i>
             </p>
           @endif
           @if(!en())
             <p style=" {{ loadFontStyle($welcome , 'arabic_english') }}">
               <i class="fa fa-quote-left " aria-hidden="true"></i>
               {{ $welcome->about_arabic}}
               <i class="fa fa-quote-right" aria-hidden="true"></i>
             </p>
           @endif
         </div>
       </div>
     </div>
   </div>
 </section>
