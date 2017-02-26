
let Alert = {

  notify(text){

    toastr["success"](text);
  },
  updated(){

   this.notify(Locale.get('updated'));
  },
  wrong(text){

    toastr["warning"](text)
  }


}

let Modal = {

  activate(){
    $('a.modal-trigger').click(function(e){
      e.preventDefault();
      let id = $(this).attr('href');
      $(id).addClass('is-active');
    });

    $('a.modal-close , .modal-background').each(function(){

        $(this).click(() => { $(this).parent().removeClass('is-active'); });
    });
  },
  close(id){
    $("#" + id).removeClass('is-active');
  }
}

window.Alert = Alert;
window.Modal = Modal;
