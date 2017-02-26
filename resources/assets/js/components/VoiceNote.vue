<template>
  <div >
    <a class="button is-big" @click='play_pause()'>
      <span class="icon">
        <i :class="'fa fa-' + playState"></i>
      </span>
    </a>
    <audio :src="'/voiceNote/' + data.voiceNote_src +'/stream'"
           preload="none" controls v-if='!data.localVoiceNoteURl'
           ref="audio" class="is-audio-hidden"></audio>
    <audio :src="data.voiceNote_src" controls v-if='data.localVoiceNoteURl'
           ref="audio" class="is-audio-hidden"></audio>
  </div>
</template>

<script>
    export default {
        props : ['data'],

        data(){
          return {
            audio : null,
            playState : 'play'
          }
        },

        methods : {
          play_pause(){

            if(this.audio.paused){
              this.playState = 'pause';
              this.audio.play();

            }else{
              this.audio.pause();
              this.end();
            }
          },
          end(){

            this.playState = 'play';
          }
        },

        mounted() {
            this.audio = $(this.$refs.audio)[0];

            this.audio.onended = () => {
              setTimeout(() => {this.end()} , 1000);
            }
        }
    }
</script>

<style scoped>
.is-audio-hidden{
  display: none;
}
</style>
