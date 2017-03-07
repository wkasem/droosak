@if($teachers)
<section class="hero is-light is-large" id="teachers" dir="ltr">
   <div class="hero-body">
     <div class="container">
       @foreach($teachers->chunk(2) as $teacher_group)
       <div class="columns">
         @foreach($teacher_group as $teacher)
         <div class="column">
           <div class="box">
             <article class="media">
               <div class="media-left">
                 <figure class="image is-64x64">
                   <img src="p/{{$teacher->id}}" alt="Image">
                 </figure>
               </div>
               <div class="media-content">
                 <div class="content">
                   <p>
                     <strong>{{ $teacher->username }}</strong>
                     <br>
                     {{ ($teacher->about) ? $teacher->about : ''}}
                   </p>
                 </div>
               </div>
             </article>
           </div>
         </div>
         @endforeach
       </div>
       @endforeach
     </div>
   </div>
 </section>
@endif
