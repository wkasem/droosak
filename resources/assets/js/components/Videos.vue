<template>
<div>
  <div class="columns" v-if='playlist.show'>
    <div class="column section">
      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64">
            <img src="/imgs/video_banco_wiki.jpg" :alt="playlist.title" v-if='!playlist.poster'>
            <img :src="'poster/' + playlist.poster" :alt="playlist.title" v-if='playlist.poster'>
          </p>
          <div class="is-file ">
            <input type="file" name="poster" @change='uploadPoster($event)'>
              <a class="button ">
                <span class="icon">
                  <i class="fa fa-picture-o" aria-hidden="true"></i>
                </span>
                <span>{{ Locale.get('video_poster') }} </span>
              </a>
          </div>
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
      </article>
</div>
</div>
<hr v-if='playlist.show'>

<div class="columns">
  <div class="column section">
    <div class="tabs is-boxed">
      <ul>
        <li class="is-active"><a href="#playlists">Playlists</a></li>
        <li ><a href="#videos">Videos</a></li>
        <li><a href="#documents">Documents</a></li>
      </ul>
    </div>
  <div class="container">

   <div id="playlists">
     <playlists :data='playlist.playlists' v-if='playlist.playlists'
                :parent='playlist'>
      </playlists>
   </div>

    <div id="documents">
      <div class="heading">
        <h1 class="title">{{ Locale.get('documents')}}<span class="tag" v-if='playlist.documents'>{{ playlist.documents.length }}</span></h1>
        <div class="is-file ">
          <input type="file" name="file" @change='uploadDocument($event)'>
            <a class="button ">
              <span class="icon">
                <i class="fa fa-file-text-o"></i>
              </span>
              <span>{{ Locale.get('new_document')}} </span>
            </a>
        </div>
      </div>
      <div class="box" v-for='(document , index) in playlist.documents'>
        <article class="media">
          <div class="media-left">
            <figure class="image is-64x64" v-html='Document.img(document.src)'> </figure>
          </div>
          <div class="media-content">
            <div class="content">
              <p> {{ document.name }} </p>
            </div>
          </div>
          <div class="media-right">
            <a  :href="'/documents/'+ document.id +'/download'"  target="_blank" class="button">
              {{ Locale.get('download') }}
            </a>
            <a href="#document_delete"class="button is-danger modal-trigger" @click.prevent='setCurrent(0 , index)'>
              {{ Locale.get('delete') }}
            </a>
          </div>
        </article>
      </div>
    </div>


    <div id="videos">
  <div class="heading">
    <h1 class="title">{{ Locale.get('videos')}}<span class="tag">{{ videos_count }}</span></h1>
    <a href="#video_add" class="modal-trigger button">
      <span class="icon">
        <i class="fa fa-plus"></i>
      </span>
      <span>{{ Locale.get('new_video') }}</span>
    </a>
  </div>
  <div class="columns" v-for='(videos_group , parent) in playlist.videos'>
       <div class="column is-one-third" v-for='(video , child) in videos_group'>
          <div class="card">
             <div class="card-image">
               <figure class="image is-4by3">
                 <img :src="'/video/' + video.video_id + '/getThumb'" :alt="video.title" v-if='video.src'>
               </figure>
             </div>
             <div class="card-content">
               <div class="content">
                 <span class="title block">{{ video.title }}</span><br>
                 {{ video.discription }}
                 <br>
                 <a >
                   <span class="tag is-info" v-if='!isPromo()'>{{ Locale.get('views' , video.views_count)  }}</span><br>
                 </a>
                 <figure class="box-publish" v-if='!isPromo()'>
                   <img :src="'/pic/' + video.published_by.id"  class="image is-24x24">
                   <a :href="'/profile/' + video.published_by.id" target="_blank"><small>{{ video.published_by.username }}</small></a>
                 </figure>
               </div>
             </div>
             <footer class="card-footer">
              <a :href="'/video/' + video.video_id" target="_blank" class="card-footer-item" v-if='!isPromo()'>
                {{ Locale.get('watch') }}
              </a>
              <a href="#video_edit" class="card-footer-item modal-trigger" v-if='!isPromo()' @click.prevent='setCurrent(parent , child)'>
                {{ Locale.get('edit')}}
              </a>
              <a href="#video_delete"class="card-footer-item modal-trigger" @click.prevent='setCurrent(parent , child)'>
                {{ Locale.get('delete') }}
              </a>
            </footer>
      </div>
    </div>
  </div>
</div>


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
              <h1 class="title is-dark">{{getCurrent().title}} </h1>
              <p class="control">
                <span class="select">
                  <select name="playlist_id">
                    <option v-for='p in playlists'
                            :value="p.playlist_id"
                            :selected='(playlist.playlist_id == p.playlist_id)'>
                      {{ p.title }}
                    </option>
                  </select>
                </span>
              </p>
              <p class="control">
                <input  type="text" class="input is-expanded" name="title" :placeholder="Locale.get('title')" :value='getCurrent().title'>
              </p>
              <p class="control">
                <input  type="number" class="input is-expanded" name="points" :placeholder="Locale.get('points')" :value='getCurrent().points'>
              </p>
              <p class="control">
                <textarea class="textarea" :placeholder="Locale.get('discription')" name="discription">{{ getCurrent().discription}}</textarea>
              </p>
              <p class="control">
                <button class="button is-info" type="submit">
                  {{ Locale.get('update') }}
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
              <div v-if='!isPromo()'>
                <label class="label">{{ Locale.get('badges_teacher')}}</label>
                <p class="control">
                  <span class="select">
                    <select name="published_by">
                      <option v-for='teacher in teachers' :value="teacher.id">
                        {{ teacher.username }}
                      </option>
                    </select>
                  </span>
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
              </div>
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
             <h1 class="title is-dark">{{getCurrent().title}}</h1>
             <p class="control has-addons ">
               <input class="input is-expanded" type="password" name="password" :placeholder="Locale.get('admin_pass')">
               <button class="button is-danger" type="submit">
                 {{ Locale.get('delete') }}
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

 <div class="modal" id="document_delete">
 <div class="modal-background"></div>
 <div class="modal-content" v-if='hasAnyDocuemnts()'>
   <form v-on:submit.prevent='deleteDocument($event)'>
     <div class="box">
       <article class="media">
         <div class="media-content">
           <div class="content ">
             <h1 class="title is-dark">{{getCurrentDocument().name}}</h1>
             <p class="control has-addons ">
               <input class="input is-expanded" type="password" name="password" :placeholder="Locale.get('admin_pass')">
               <button class="button is-danger" type="submit">
                 {{ Locale.get('delete') }}
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
        props : ['data' , 'data2' , 'data3' , 'stages'],

        data(){
          return {
            playlist : {videos : []},
            parent : 0,
            child : 0,
            Locale : window.Locale,
            teachers : [],
            playlists : [],
            Document : window.Document,
            videos_count : 0
          }
        },
        methods :{

          uploadDocument(e){

           let data = new FormData();

            data.append('file' , $(e.target)[0].files[0]);
            data.append('playlist_id' , this.playlist.playlist_id);

            Progressbar.self($(e.target).siblings()[0]);
            this.$http.post('/admin/documents/upload', data).then(res => {

              this.playlist.documents.push(res.body);

              Progressbar.end($(e.target).siblings()[0]);

            } ,res => {
              Progressbar.end($(e.target).siblings()[0]);

              Validator.errors(res.body);
          });

        },
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
          hasAnyDocuemnts(){

            return (this.playlist.documents) ? this.playlist.documents.length : false;
          },
          getCurrent(){

             return this.playlist.videos[this.parent][this.child];
          },
          getCurrentDocument(){

            return this.playlist.documents[this.child];
          },
          isPromo(){

            return this.playlist.title == 'promotion';
          },
          addVideo(e){

           let data = new FormData($(e.target)[0]);

           if(this.isPromo()){
             let num = this.playlist.videos.length + 1;

             data.set('title' , `Droosak${num}`)
           }

           var url = '/admin/courses/' + this.playlist.playlist_id + '/upload';

            this.$http.post( url, data , {
              before : e => {
                Progressbar.show();
              },
              progress : pe => {

              let percent = (pe.loaded / pe.total) * 100;

              Progressbar.update(percent);
              }
            }).then(res => {

              Progressbar.hide();
              Modal.close('video_add');
              Validator.reset();
              Validator.wipeInputs();

              this.videos_count++;

              Chunk.add(this.playlist.videos , res.body);
            } ,res => {
              Progressbar.hide();

              Validator.errors(res.body);
          });

        },
        uploadPoster(e){
          let data = new FormData($(e.target)[0]);

          data.append('poster' , $(e.target)[0].files[0]);

          var url = '/admin/courses/' + this.playlist.playlist_id + '/poster';
          Progressbar.self($(e.target).siblings()[0]);

          this.$http.post( url, data).then(res => {

             this.playlist.poster = res.body;

             Progressbar.end($(e.target).siblings()[0]);
             Modal.close('video_poster');
          } ,res => {
            Progressbar.end($(e.target).siblings()[0]);

            Validator.errors(res.body);

        });
        },
        updateVideo(e){

          let data = new FormData($(event.target)[0]);

          data.append('videoid' , this.getCurrent().video_id);

          var url = '/admin/courses/' + this.playlist.playlist_id + '/edit';

          Progressbar.self($(e.target).find('button'));
           this.$http.post( url, data).then(res => {

             Progressbar.end($(e.target).find('button'));
             Modal.close('video_edit');
             Validator.wipeInputs();

             if(data.get('playlist_id') != this.playlist.playlist_id){
               this.removeVideo();
               return;
             }

              this.getCurrent().title = data.get('title');
              this.getCurrent().discription = data.get('discription');
              this.getCurrent().points = data.get('points');
           } ,res => {
             Progressbar.end($(e.target).find('button'));

             Validator.errors(res.body);

         });
       },
        deleteVideo(e){
          let data = new FormData($(e.target)[0]);
          let url = '/admin/playlists/' + this.playlist.playlist_id + '/delete';

          data.append('videoid' , this.getCurrent().video_id);

          Progressbar.self($(e.target).find('button'));

           this.$http.post(url , data).then(res => {

             this.removeVideo();
             Progressbar.end($(e.target).find('button'));
             Modal.close('video_delete');
           }, res => {
             Alert.wrong(Locale.get('wrong_pass'));

             Progressbar.end($(e.target).find('button'));
           });
        },
        deleteDocument(e){
          let data = new FormData($(e.target)[0]);
          let url = '/admin/documents/delete';

          data.append('docuemntId' , this.getCurrentDocument().id);

          Progressbar.self($(e.target).find('button'));

           this.$http.post(url , data).then(res => {

             this.playlist.documents.splice(this.child , 1);

             Progressbar.end($(e.target).find('button'));

             Modal.close('document_delete');
           }, res => {

             Alert.wrong(Locale.get('wrong_pass'));

             Progressbar.end($(e.target).find('button'));
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
          let data = JSON.parse(this.data);
          data.playlists = JSON.stringify(data.playlists);
          this.playlist = data;

          this.teachers = JSON.parse(this.data2);
          this.playlists = JSON.parse(this.data3);

          this.isPromo();
          this.videos_count = this.playlist.videos.length;

          this.playlist.videos = Chunk.cast(this.playlist.videos);

        },
        updated(){
          $('.is-file .button').click(function(e){
            $(this).parent().find('input').click(function(e){
              e.stopPropagation();
            });
          });
          Modal.activate();
        }
    }
</script>

<style scoped>
.heading{
  display: flex;
  justify-content: space-between;
}
</style>
