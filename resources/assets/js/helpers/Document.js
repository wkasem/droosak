let Document = {

  img(n){

    let name = n.split('.').pop().replace('.' , '');
    let srcs = ['pdf' , 'doc' , 'docx'];

    let exsist = srcs.find(p => {
      return p == name;
    });

    name = (exsist) ? name : 'document';

    return `<img src='/imgs/documents/${name}.png' />`;
  }
}


window.Document = Document;
