export default class{


  constructor(parent){

    this.parent = parent;

    this.recordStatus = false;

  }

  start(){
    Fr.voice.record(false, e => {
        this.recordStatus = true;
    });
  }

  isRecording(){

    return this.recordStatus;
  }

  finish(id){
    this.recordStatus = false;

    Modal.close(id);
    Fr.voice.stop();
  }


}
