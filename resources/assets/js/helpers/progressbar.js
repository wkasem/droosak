let Progressbar = {

  update(percent){

    $('.is-progress-holder .progress').attr('value' , percent);
  },

  show(){

    $('body').prepend(`<div class="is-progress-holder"> <progress class="progress is-primary" value="0" max="100"></progress> </div>`);
  },

   hide(){

     $('.is-progress-holder').remove();
   },

   self(el){

     $(el).addClass('is-disabled is-loading');
   },
   end(el){
     $(el).removeClass('is-disabled is-loading');
   }
}

window.Progressbar = Progressbar;
