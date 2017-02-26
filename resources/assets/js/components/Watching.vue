<template>
<div>
  <div class="columns">
    <div class="column">
      <div class="card ">
      <header class="card-header">
        <p class="card-header-title">
          {{ playlist.title }}
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          <h3 class="subtitle">{{ playlist.discription }}</h3>
        </div>
      </div>
    </div>
</div>
</div>


  <div class="columns" v-for='(videos_group , parent) in playlist.videos'>
       <div class="column is-one-third" v-for='(video , child) in videos_group' v-bind:key="video.id">
          <div class="card">
             <div class="card-image">
               <figure class="image is-4by3">
                 <img :src="'/video/' + video.id + '/getThumb'" :alt="video.title">
               </figure>
             </div>
             <div class="card-content">
               <div class="content">
                 <span class="title block">{{ video.title }}</span><br>
                 {{ video.discription }}
                 <br>
                 <a >
                   <span class="tag is-info">{{ Locale.get('views' , 0) }}</span><br>
                 </a>
                 <small>Uploaded By : {{ video.published_by.first_name }}</small>
               </div>
             </div>
             <footer class="card-footer">
              <a :href="'/video/' + video.id" target="_blank" class="card-footer-item">{{ Locale.get('watch')}}</a>
            </footer>
      </div>
    </div>
  </div>

</div>
</template>

<script>

    export default {
        props : ['data'],

        data(){
          return {
            playlist : {
              videos : []
            }
          }
        },
        methods :{

        },

        mounted() {
          this.playlist = JSON.parse(this.data);

          this.playlist.videos = Chunk.cast(this.playlist.videos);
          Modal.activate();
        }
    }
</script>
