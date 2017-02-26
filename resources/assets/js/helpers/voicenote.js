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

  finish(){
    this.recordStatus = false;

    Modal.close('voice-note');
    Fr.voice.stop();
  }


}
