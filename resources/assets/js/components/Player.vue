<template>
  <div class="columns">
    <div class="column is-12">
      <div class="card">
        <div class="card-image" v-if='Object.keys(video).length'>

          <figure class="image " v-if='video.live != 1 && promo'>
            <video  class="video-js" id="promotion"  autoplay
            :poster="'/video/' + promotion.video_id + '/getThumb'" data-setup="{}">
              <source :src="'/video/' + promotion.video_id + '/stream'" type='video/mp4'>
            </video>
            <div class="promo-skip" v-if='promoInterval'>{{ promoInterval }}</div>
            <div class="promo-skip is-btn" v-if='!promoInterval && promo' @click='skipPromo'>
             {{ Locale.get('skip') }}
            </div>
          </figure>

          <figure class="image" v-if='video.live != 1' v-show='!promo'>
            <video  id="lesson-player" class="video-js" controls
            :poster="'/video/' + video.video_id + '/getThumb'" data-setup="{}">
              <source :src="'/video/' + video.video_id + '/stream'" type='video/mp4'>
              <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a web browser that
                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
              </p>
            </video>
          </figure>

          <figure class="image  live" v-if='video.live == 1'>
             <iframe class="video-js" src="//iframe.dacast.com/b/85909/c/432649" frameborder="0" scrolling="no" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
          </figure>
        <div class="box" v-if='video.published_by'>
          <article class="media">
            <div class="media-left">
              <figure class="image">
                <img :src="'/pic/' + video.published_by.id" class="image is-circle is-64x64">
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>{{ video.published_by.username }}</strong> <span v-html='badge(video.published_by)'></span>
                </p>
                <a :href="'/profile/' + video.published_by.id" class="button is-primary" target="_blank">
                  <span>{{ Locale.get('profile')}}</span>
                  <span class="icon is-small">
                    <i class="fa fa-user" ></i>
                  </span>
                </a>
              </div>
            </div>
          </article>
        </div>
        <div class="box" v-if='!streamOff &&video.stream && authUser().id == video.published_by.id'>
          <article class="media">
            <div class="media-left">
              <figure class="image">
                <i class="fa fa-cog" aria-hidden="true"></i>
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                 <strong>Login :</strong> {{ video.stream.login }} <strong> Password :</strong> {{ video.stream.password }}
                </p>
                <p>
                  <strong>Stream Key :</strong> {{ video.stream.stream_name }} <strong> URL :</strong> {{ video.stream.src }}
                </p>
                <a href="#stream_how" class="button  modal-trigger">
                  <span>{{ Locale.get('how') }}</span>
                  <span class="icon is-small">
                    <i class="fa fa-question" aria-hidden="true"></i>
                  </span>
                </a>
                <a  class="button  is-danger" @click='endStream($event)'>
                  {{ Locale.get('endStream') }}
                </a>
              </div>
            </div>
          </article>
        </div>
        <div class="box" v-if='!streamOff && authUser().id == video.published_by.id'>
          <article class="media">
            <div class="media-content">
              <div class="content">
                <div class="is-file ">
                  <input type="file" name="video" @change='addVideo($event)'>
                    <a class="button ">
                      <span>Upload </span>
                    </a>
                </div>
              </div>
            </div>
          </article>
        </div>
        <div class="card-content">
          <section class="section">
            <div class="container">
              <div class="heading">
                <a class="button is-pulled-right"  @click="fullscreenComments">
                  <span class="icon is-small">
                    <i class="fa fa-arrows-alt"></i>
                  </span>
                </a>
                <h1 class="title">{{ video.title }}</h1>
                <h6 class="subtitle is-6">{{ video.discription }} </h6>
              </div>
            </div>
          </section>
          <nav class="level">
             <div class="level-left">
               <a class="level-item" style="color:#000000">
                 {{ video.comments_count }} Comments
               </a>
               <a class="level-item" style="color:#000000">
                 {{ video.views_count }} Views
               </a>
           </nav>
          <hr>
          <div class="content has-text-centered"  >
            <a class="button" v-if='hasMoreComments' @click='loadMoreComments($event)'>{{ Locale.get('more_comments')}}</a>
           </div>
           <div ref='comment_section'>
            <article class="media" v-for="(comment , index) in video.comments" :id="'#' + index">
              <figure class="media-left">
                <p class="image">
                  <img :src="'/pic/' + comment.user.id" class="image is-circle is-64x64">
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong>{{ comment.user.username }}</strong>
                    <span v-html='badge(comment.user)'></span>
                    <br>
                    <voicenote :data='comment' v-if='comment.voiceNote'></voicenote>
                    <span v-if='!comment.voiceNote'>{{ comment.body }}</span>
                    <br>
                    <small >
                      <a @click='setReplyIndex(index)'>Reply</a> . <timeago :since="Date.parse(comment.created_at)" :auto-update="60"></timeago>
                    </small>
                  </p>
                </div>

                <article class="media more-replies" v-if='comment.hasMoreReplies' >
                  <div class="subtitle" @click='loadReplies($event,comment.id,index)' style="width:100%">
                    <span class="icon media-left">
                      <i class="fa fa-angle-down"></i>
                    </span>
                    More Replies
                  </div>
                  <span class="replies-load"></span>
                </article>

                <article class="media" v-for='reply in comment.replies'>
                  <figure class="media-left">
                    <p class="image">
                      <img :src="'/pic/' + reply.user.id" class="image is-circle is-64x64">
                    </p>
                  </figure>
                  <div class="media-content">
                    <div class="content">
                      <p>
                        <strong>{{ reply.user.username }}</strong>
                        <span v-html='badge(reply.user)'></span>
                        <br>
                        <voicenote :data='reply' v-if='reply.voiceNote'></voicenote>
                        <span v-if='!reply.voiceNote'>{{ reply.body }}</span>
                        <br>
                        <small>
                          <timeago :since="Date.parse(reply.created_at)" :auto-update="60"></timeago>
                        </small>
                      </p>
                    </div>
                  </article>
                  <article class="media" v-if='curr_reply_indx == index'>
                    <figure class="media-left is-hidden-touch	">
                      <p class="image is-64x64">
                        <img :src="'/pic/' + comment.user.id" class="image is-circle is-64x64">
                      </p>
                    </figure>
                    <form class="media-content" v-on:submit.prevent='postComment($event , true)'>
                      <p class="control">
                        <textarea class="textarea" name="body" id='reply' @keyup.enter="$refs.replyBtn[0].click()"></textarea>
                      </p>
                      <p class="control" >
                        <button class="button" ref="replyBtn">reply</button>
                        <voicemessage @send='sendReplyVoiceNote' :Locale='Locale'></voicemessage>
                      </p>
                    </form>
                  </article>
              </div>
            </article>
          </div>
          <hr v-if='video.comments.length'>
          <article class="media">
            <figure class="media-left is-hidden-touch">
              <p class="image is-64x64">
                <img :src="'/pic/' + authUser().id" class="image is-circle is-64x64">
              </p>
            </figure>
            <form class="media-content" v-on:submit.prevent='postComment($event , false)'>
              <p class="control">
                <textarea class="textarea" name="body" ref='comment' @keyup.enter="$refs.commentBtn.click()"></textarea>
              </p>
              <p class="control">
                <button class="button" ref="commentBtn">{{ Locale.get('comment')}}</button>
                <voicemessage @send='sendCommentVoiceNote' :Locale='Locale'></voicemessage>
              </p>
            </form>
          </article>

        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="stream_how">
  <div class="modal-background"></div>
  <div class="modal-content">
    <p class="image is-4by3">
      <img src="/imgs/stream_how.png">
    </p>
  </div>
  <button class="modal-close"></button>
</div>
</template>

<script>
import screenfull from "screenfull";

export default {
    props : ['data' , 'data2'],

    data(){
      return {
        video : [],
        promotion : [],
        commentData : null,
        hasMoreComments : false,
        currentCommentPage : 1,
        last_indx : 0,
        curr_reply_indx : null,
        Locale : window.Locale,
        badge : window.Badge,
        promo : false,
        promoInterval : 10,
        streamOff : false
      }
    },
    methods :{
      addVideo(e){

       let data = new FormData();

       data.append('video' , $(e.target)[0].files[0]);
       data.append('videoId' , this.video.video_id);

       var url = '/teacher/courses/' + this.video.playlist_id + '/upload';

        this.$http.post( url, data , {
          before : e => {
            Progressbar.show();
          },
          progress : pe => {

          let percent = (pe.loaded / pe.total) * 100;

          Progressbar.update(percent);
          }
        }).then(res => {

          location.reload();
        } ,res => {
          Progressbar.hide();

          Validator.errors(res.body);
      });

    },
     fullscreenComments(){
       const target = $(this.$refs.comment_section)[0];
       if (screenfull.enabled) {
          screenfull.request(target);
       }
     },
     authUser(){

       return window.user;
     },
     setReplyIndex(index){
       if(this.curr_reply_indx == index){
         this.curr_reply_indx = null;
         return;
       }
       this.curr_reply_indx = index;
       $("#reply").focus();
     },
     postComment(event , reply){

     this.commentData = new FormData($(event.target)[0]);

     let comment_id = uuid();

     $(event.target).find('textarea').val('');

     if((this.commentData.get('body') == false)){
       Alert.wrong(this.Locale.get('empty_comment'));
       return false;
     }

     this.commentData.append('_videoID' , this.video.video_id);
     this.commentData.append('id' , comment_id);

     if(reply) this.commentData.append('parent' , this.video.comments[this.curr_reply_indx].id);


     this.addComment(this.prepareComment(comment_id) , reply);

     this.$http.post('/comment' , this.commentData).catch(res => {
       if(reply){

         this.video.comments[this.curr_reply_indx].replies.splice(this.last_indx , 1);
       }else{
         this.video.comments.splice(this.last_indx , 1);
       }
     });

   },
   addComment(data , reply){

      if(this.isFullscreen()) this.scrollBottom($(this.$refs.comment_section));

      if(reply){
         this.last_indx = this.video.comments[this.curr_reply_indx].replies.push(data);
         return;
      }

      this.video.comments_count++;

      this.last_indx = this.video.comments.push(data) - 1;
     },
     addReply(data){

       this.video.comments.find(c => {
         return c.id == data.parent;
       }).replies.push(data);
     },
     prepareComment(id , voiceNote){

     if(voiceNote){
       return {
         id : id,
         voiceNote_src : voiceNote,
         localVoiceNoteURl : true,
         video_id  : this.commentData.get('_videoID'),
         user      : window.user,
         voiceNote : true,
         created_at: (new Date).toLocaleString(),
         replies : []
       }
     }
     return {
         id : id,
         body      : this.commentData.get('body'),
         video_id  : this.commentData.get('_videoID'),
         user      : window.user,
         created_at: (new Date).toLocaleString(),
         replies : []
     }
   },
   loadMoreComments(e){

     let payload = {videoId : this.video.video_id , page : this.currentCommentPage++};

     Progressbar.self(e.target);

     this.$http.post('/comments/more' , payload ).then(res => {

      let result = res.body;

      this.hasMoreComments = (result.current_page != result.last_page);

      this.video.comments = result.data.concat(this.video.comments);

      Progressbar.end(e.target);

     });
   },
   listenForComments(){

      Echo.private(`video.${this.video.video_id}`)
          .listen('CommentRecieved',e => {
              (e.comment.parent) ? this.addReply(e.comment)  : this.addComment(e.comment);
           })
          .listen('Viewing',e => {
              this.video.views_count++;
           });
   },
   loadReplies(e,parent,index){

     let data = new FormData();

     data.append('videoId' , this.video.video_id);
     data.append('parent' , parent);

     $(e.target).next().show();

     this.$http.post('/replies/more' , data).then(res => {

     this.video.comments[index].replies = res.body.reverse();
     this.video.comments[index].hasMoreReplies = false;
     });
   },
   sendVoiceNote(blob , local , reply){

    this.commentData = new FormData();

    let comment_id = parseInt(uuid().substring(1,8));

    this.commentData.append('audio' , blob);
    this.commentData.append('id' , comment_id);
    this.commentData.append('_videoID' , this.video.video_id);

    if(reply) this.commentData.append('parent' , this.video.comments[this.curr_reply_indx].id);

    this.addComment(this.prepareComment(comment_id,local) , reply);

    this.$http.post('/comment/sendVoiceNote' , this.commentData , {emulateJSON : false});

   },
   sendCommentVoiceNote(blob , local){


    this.sendVoiceNote(blob , local , false);

   },
   sendReplyVoiceNote(blob , local){

    this.sendVoiceNote(blob , local , true);

   },
   endStream(e){

     Progressbar.self(e.target);

     let data = new FormData();

     data.append('videoId' , this.video.video_id);
     data.append('streamId', this.video.stream.stream_id);

     this.$http.post('/stream/off', data).then(res => {

       this.streamOff = true;

       setTimeout(() => {
         $('.is-file .button').click(function(e){
           $(this).parent().find('input').click();
         });
       },1000);
     });

   },
   isFullscreen(){

     return screenfull.isFullscreen;
   },
   scrollBottom(target){
     Ps.update(target[0]);

     $(target).scrollTop($(target).prop("scrollHeight") + 20);
   },
   preparePromo(){
     this.promo = (this.promotion) ? true : false;

   },
   commentsHasMoreReplies(){

     this.video.comments.map((c) => {

      if(c.replies_count){
        c.hasMoreReplies = (c.replies_count.count > 2)
        return c;
      }
       c.hasMoreReplies = false;

       return c;
     });
   },
   skipPromo(){

     this.promo = false;
     videojs("promotion").dispose();
     videojs("lesson-player").play();
   }
    },
    mounted() {

       this.promotion = JSON.parse(this.data2);
       this.video = JSON.parse(this.data);
       this.video.comments = this.video.comments.reverse();
       this.hasMoreComments = (this.video.comments_count > 5);


       if(this.video.live == 3){
         this.streamOff = true;
       }

       this.preparePromo();
       this.listenForComments();
       this.commentsHasMoreReplies();

       let that = this;

       $(function(){
         if(that.promo){
           videojs('promotion', {}, function(){
             this.on('loadedmetadata', function(){
               let p = setInterval(() => {
                 that.promoInterval -= 1;
                 (that.promoInterval) ? null : clearInterval(p);
               },1000);
             });

             this.on('ended', function() {
               that.skipPromo();
             });
           });
         }
         videojs('lesson-player');
       });

       document.addEventListener(screenfull.raw.fullscreenchange, () => {
         let target = $(this.$refs.comment_section);
          target.toggleClass('is-fullscreen');

          if(this.isFullscreen()) {
            Ps.initialize(target[0]);
            this.scrollBottom(target);
          }else{
            Ps.destroy(target[0]);
          }
      });
    },
    updated(){
      $('.is-file .button').click(function(){
        $(this).parent().find('input').click();
      });
      Modal.activate();
    }
}

</script>
