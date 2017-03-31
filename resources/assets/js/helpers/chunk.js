let Chunk = {

  cast(data){

    data = data.map(arr => {

      return (Array.isArray(arr)) ? arr : Object.keys(arr).map(k => arr[k]);

    });
    return data;
  },
  add(into , data){
    let crr = (into.length) ? into[into.length - 1] : into.length;
    if(crr.length < 3){ crr.push(data); return; }

    into.push([data]);
  },
  flat(Group){

    let all = [];

    Group.forEach(g => {
      g.forEach(v => {
        all.push(v);
      });
    });

    return all;
  }
}

window.Chunk = Chunk;
