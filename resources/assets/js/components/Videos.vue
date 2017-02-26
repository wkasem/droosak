<template>
<div>
  <div class="columns">
    <div class="column section">
      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64">
            <img src="http://bulma.io/images/placeholders/128x128.png">
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <p>
              <strong>{{ playlist.title }}</strong>
              <br>
              {{ playlist.discription }}
           </p>
          </div>
        </div>
        <div class="media-right">
          <a href="#video_add" class="modal-trigger button">
            <span class="icon">
              <i class="fa fa-plus"></i>
            </span>
            <span>{{ Locale.get('new_video') }}</span>
          </a>
          <a href="#video_poster" class="modal-trigger button">
            <span class="icon">
              <i class="fa fa-plus"></i>
            </span>
            <span>{{ Locale.get('video_poster') }}</span>
          </a>
        </div>
      </article>
</div>
</div>


  <div class="columns" v-for='(videos_group , parent) in playlist.videos'>
       <div class="column is-one-third" v-for='(video , child) in videos_group' v-bind:key="video.id">
          <div class="card">
             <div class="card-image">
               <figure class="image is-4by3">
                 <img :src="'/video/' + video.video_id + '/getThumb'" :alt="video.title">
               </figure>
             </div>
             <div class="card-content">
               <div class="content">
                 <span class="title block">{{ video.title }}</span><br>
                 {{ video.discription }}
                 <br>
                 <a >
                   <span class="tag is-info">0 Views</span><br>
                 </a>
                 <small>Uploaded By : {{ video.published_by.first_name }}</small>
               </div>
             </div>
             <footer class="card-footer">
              <a :href="'/video/' + video.video_id" target="_blank" class="card-footer-item">Watch</a>
              <a href="#video_edit" class="card-footer-item modal-trigger" @click.prevent='setCurrent(parent , child)'>Edit</a>
              <a href="#video_delete"class="card-footer-item modal-trigger" @click.prevent='setCurrent(parent , child)'>Delete</a>
            </footer>
      </div>
    </div>
  </div>

  <div class="modal" id="video_edit">
  <div class="modal-background"></div>
  <div class="modal-content" v-if='hasAny()'>
    <form @submit.prevent='updateVideo($event)'>
      <div class="box">
        <article class="media">
          <div class="media-content">
            <div class="content ">
              <h1 class="title is-dark">Edit : {{getCurrent().title}} </h1>
              <p class="control">
                <input  type="text" class="input is-expanded" name="title" placeholder="Title" :value='getCurrent().title'>
              </p>
              <p class="control">
                <textarea class="textarea" placeholder="Discription" name="discription">{{ getCurrent().discription}}</textarea>
              </p>
              <p class="control">
                <button class="button is-info" type="submit">
                  Update
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

  <div class="modal" id="video_add">
  <div class="modal-background"></div>
  <div class="modal-content">
    <form @submit.prevent='addVideo($event)'>
      <div class="box">
        <article class="media">
          <div class="media-content">
            <div class="content ">
              <h1 class="title is-dark">{{ Locale.get('new_video') }}</h1>
              <p class="control">
                <input type="file" name="video" accept='video/*' >
              </p>
              <p class="control">
                <input  type="text" class="input is-expanded" name="title" :placeholder="Locale.get('title')">
              </p>
              <p class="control">
                <input  type="number" class="input is-expanded" name="points" :placeholder="Locale.get('points')">
              </p>
              <p class="control">
                <textarea class="textarea" :placeholder="Locale.get('discription')" name="discription"></textarea>
              </p>
              <p class="control">
                <button class="button is-success" type="submit">
                  {{ Locale.get('add') }}
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

 <div class="modal" id="video_delete">
 <div class="modal-background"></div>
 <div class="modal-content" v-if='hasAny()'>
   <form v-on:submit.prevent='deleteVideo($event)'>
     <div class="box">
       <article class="media">
         <div class="media-content">
           <div class="content ">
             <h1 class="title is-dark">Delete {{getCurrent().title}}</h1>
             <p class="control has-addons ">
               <input class="input is-expanded" type="password" name="password" placeholder="Admin Password">
               <button class="button is-danger" type="submit">
                 Delete
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
        props : ['data'],

        data(){
          return {
            playlist : {videos : []},
            parent : 0,
            child : 0,
            Locale : window.Locale
          }
        },
        methods :{

          setCurrent(parent , child){

            this.parent = parent;
            this.child = child;
          },
          hasAny(){

            if(this.playlist.videos.length){
              return this.playlist.videos[0].length;
            }

            return this.playlist.videos.length;
          },
          getCurrent(){

             return this.playlist.videos[this.parent][this.child];
          },
          addVideo(e){

           let data = new FormData($(e.target)[0]);

           var url = '/admin/playlists/' + this.playlist.playlist_id + '/upload';

            this.$http.post( url, data , {
              before : e => {
                Progressbar.self($(e.target).find('button'));
              },
              progress : pe => {

              let percent = (pe.loaded / pe.total) * 100;

              Progressbar.update(percent);
              }
            }).then(res => {

              Progressbar.end($(e.target).find('button'));
              Modal.close('video_add');
              Chunk.add(this.playlist.videos , res.body);
            } ,res => {
              Progressbar.end($(e.target).find('button'));

              Validator.errors(res.body);
          });

        },
        updateVideo(e){

          let data = new FormData($(event.target)[0]);

          data.append('videoid' , this.getCurrent().video_id);

          var url = '/admin/playlists/' + this.playlist.playlist_id + '/edit';

           Progressbar.show();
           this.$http.post( url, data).then(res => {

             Progressbar.hide();
             Modal.close('video_edit');
              this.getCurrent().title = data.get('title');
              this.getCurrent().discription = data.get('discription');
              Validator.wipeInputs();
           } ,res => {
             Progressbar.hide();

             Validator.errors(res.body);

         });
       },
        deleteVideo(e){
          let data = new FormData($(e.target)[0]);
          let url = '/admin/playlists/' + this.playlist.playlist_id + '/delete';

          data.append('videoid' , this.getCurrent().video_id);

          Progressbar.show();

           this.$http.post(url , data).then(res => {

             this.removeVideo();
             Progressbar.hide();
             Modal.close('video_delete');
           }, res => {
             Alert.wrong('Wrong Password');

             Progressbar.hide();
           });
        },
        removeVideo(){

          let parent = this.parent;
          let child  = this.child;

          this.parent = this.child = 0;
          this.playlist.videos[parent].splice(child,1);
        }

        },

        mounted() {
          this.playlist = JSON.parse(this.data);

          this.playlist.videos = Chunk.cast(this.playlist.videos);
        },
        updated(){

          Modal.activate();
        }
    }
</script>
