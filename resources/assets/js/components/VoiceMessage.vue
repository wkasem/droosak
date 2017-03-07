<template>
<div style="display: inline-block;">
  <a :href="'#'+uuid" class="button modal-trigger" @click.prevent>
    <span class="icon is-small">
        <i class="fa fa-microphone"></i>
    </span>
  </a>
  <div class="modal" :id="uuid">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="box">
      <div class="is-recorder-flex">
        <a :class="'is-record-circle ' + [finish ? '' : 'is-recording']" @click='record($event)'>
          {{ Locale.get('record') }}
        </a>
      </div>
      <div v-if='has_record'>
        <a  class="button modal-trigger" @click='cancel'>
          <span class="icon is-small">
            <i class="fa fa-minus-circle"></i>
          </span>
        </a>
      </div>
    </div>
  </div>
  <a class="modal-close"></a>
 </div>
</div>
</template>

<script>
import voiceNote from '../helpers/voicenote';
    export default {
        props : ['data' , 'Locale'],

        data(){
          return {
            exam : [],
            canSave : true,
            voiceNote: new voiceNote(this),
            finish : true,
            uuid : 0
          }
        },
        methods :{

         record(){

           if(this.voiceNote.isRecording()){
              this.$forceUpdate();
             return this.send();
           }

           this.finish = false;
           this.voiceNote.start();
         },
         send(){
           this.finish = true;

           Fr.voice.export(back => {

               this.$emit('send' , back.blob , back.url);
            } , ['URL' , 'blob']);


          this.voiceNote.finish(this.uuid);
         }
        },

        mounted() {

          this.uuid = window.uuid();

          Modal.activate();

          $('button.modal-close , .modal-background').click(() =>{
             if(this.voiceNote.isRecording()){
               return this.send();
             }
          });
        }

    }
</script>
