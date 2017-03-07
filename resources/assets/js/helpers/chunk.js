let Chunk = {

  cast(data){
    console.log(data);
    data = data.map(arr => {
      if(arr instanceof Array){ return arr }

      let newArr = [];

      Object.keys(arr).forEach(ob => {
        newArr.push(arr[ob]);
      });

      return newArr;
    });

    return data;
  },
  add(into , data){
    let crr = (into.length) ? into[into.length - 1] : into.length;
    if(crr.length < 3){ crr.push(data); return; }

    into.push([data]);
  }
}

window.Chunk = Chunk;
