
let Validator = {

  errors(errs){

    this.reset();

    $.map(errs , (text , key) => {

      $(`input[name='${key}']`)
        .addClass('is-danger')
        .parent().prepend(`<span class="help is-danger">${text}</span>`)
    });
  },
  reset(){
    $('input.is-danger')
    .removeClass('is-danger')
    .prev().remove();
  },
  wipeInputs(){

    let inputs = $('input');
    inputs.each((indx , input) => {
      $(input).val('');
    });

  }

}

window.Validator = Validator;
