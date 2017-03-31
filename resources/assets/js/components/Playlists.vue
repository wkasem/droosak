<template>
<div>
 <p class="control has-addons has-addons-centered">
  <a href="#playlist_add" class="button modal-trigger is-success is-medium">
    <span class="icon is-small">
      <i class="fa fa-list"></i>
    </span>
    <span>{{ Locale.get('new_course_list')}}</span>
  </a>
</p>
   <div class="columns" v-for='playlists_group in playlists'>
        <div class="column is-one-third" v-for='playlist in playlists_group' >
           <div class="card">
        <div class="card-image">
          <figure class="image is-4by3">
            <img src="/imgs/video_banco_wiki.jpg" :alt="playlist.title" v-if='!playlist.poster'>
            <img :src="'courses/'+playlist.playlist_id+'/poster/' + playlist.poster" :alt="playlist.title" v-if='playlist.poster'>
          </figure>
        </div>
        <div class="card-content">
          <div class="content">
            <span class="title block" v-if='playlist.show'>{{ playlist.title }}</span>
            <span class="title block" v-if='!playlist.show'>{{ Locale.get(`${playlist.title}`)}}</span>
            <br>
            <span class="subtitle block">{{ playlist.discription }}</span>
            <br>
              <span class="tag is-info">{{ Locale.get('videos' , playlist.videos_count)}}</span><br>
          </div>
        </div>
        <footer class="card-footer">
          <a class="card-footer-item" :href="'/admin/courses/'+ playlist.playlist_id + '/videos'">{{ Locale.get('videos')}}</a>
        </footer>
       </div>
     </div>
   </div>

 <div class="modal" id="playlist_add">
 <div class="modal-background"></div>
 <div class="modal-content">
   <form @submit.prevent='addPlaylist($event)'>
     <div class="box">
       <article class="media">
         <div class="media-content">
           <div class="content ">
             <h1 class="title is-dark">{{ Locale.get('new_course_list')}}</h1>
             <p class="control">
               <input class="input is-expanded" type="text" name="title" :placeholder="Locale.get('title')">
             </p>
             <p class="control" v-if='stages.length'>
               <span class="select">
                 <select name="stage_id">
                   <option v-for='stage in stages' :value="stage.id">{{ stage.title }}</option>
                 </select>
               </span>
             </p>
             <input type="hidden" :value="parent.stage_id" v-if='!stages.length' name="stage_id">
             <p class="control">
               <textarea class="textarea" placeholder="Discription" :placeholder="Locale.get('discription')"></textarea>
             </p>
             <p class="control">
               <button class="button is-success" type="submit">
                 {{ Locale.get('add')}}
               </button>
             </p>
           </div>
         </div>
       </article>
     </div>
  </form>
 </div>
 <a class="modal-close"></a>
</div>

</div>
</template>

<script>

    export default {
        props : ['data' ,'data2', 'parent'],

        data(){
          return {
            playlists : [],
            stages: [],
            Locale : window.Locale
          }
        },
        methods :{

         addPlaylist(e){
           let Data = new FormData($(e.target)[0]);

           if(this.parent != "0"){
              Data.append('parent' , this.parent.playlist_id);
           }

                Progressbar.self($(e.target).find('button'));

             this.$http.post('/admin/courses/add-playlist' , Data).then(res => {
               Progressbar.end($(e.target).find('button'));

               Modal.close('playlist_add');

               Chunk.add(this.playlists , res.body);

             } ,res => {
                    Progressbar.end($(e.target).find('button'));

                Validator.errors(res.body);
           });
         }
        },

        mounted() {
          this.playlists = Chunk.cast(JSON.parse(this.data));
          this.stages = JSON.parse((this.data2) ? this.data2 : "[]");
          Modal.activate();
        }
    }
</script>
