<template>
  <div class="columns">
    <div class="column is-12">
      <div class="card">
        <div class="card-image">
          <figure class="image  Video" v-if='video.live != 1'>
            <video id="lesson-player" class="video-js" controls preload
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

                  <br>
                  {{ video.published_by.about }}
                </p>
              </div>
            </div>
          </article>
        </div>
        <div class="box" v-if='video.stream'>
          <article class="media">
            <div class="media-left">
              <figure class="image">
                <img :src="'/pic/' + video.published_by.id" class="image is-circle is-64x64">
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                 <strong>Login :</strong> {{ video.stream.login }} <strong> Password :</strong> {{ video.stream.password }}
                </p>
                <p>

                </p>
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
                        <textarea class="textarea" name="body" ref='reply' @keyup.enter="$refs.replyBtn[0].click()"></textarea>
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
          <hr>
          <article class="media">
            <figure class="media-left is-hidden-touch">
              <p class="image is-64x64">
                <img src="http://bulma.io/images/placeholders/128x128.png">
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
</template>

<script>
import screenfull from "screenfull";

export default {
    props : ['data'],

    data(){
      return {
        video : [],
        commentData : null,
        hasMoreComments : false,
        currentCommentPage : 1,
        last_indx : 0,
        curr_reply_indx : null,
        Locale : window.Locale,
        badge : window.Badge
      }
    },
    methods :{

     fullscreenComments(){
       const target = $(this.$refs.comment_section)[0];
       if (screenfull.enabled) {
          screenfull.request(target);
       }
     },
     setReplyIndex(index){
       if(this.curr_reply_indx == index){
         this.curr_reply_indx = null;
         return;
       }
       this.curr_reply_indx = index;
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

     $(e.target).addClass('is-loading is-disabled');

     this.$http.post('/comments/more' , payload ).then(res => {

      let result = res.body;

      this.hasMoreComments = (result.current_page != result.last_page);

      this.video.comments = result.data.concat(this.video.comments);

       $(e.target).removeClass('is-loading is-disabled');
     });
   },
   listenForComments(){

      Echo.private(`video.${this.video.video_id}.comments`)
          .listen('CommentRecieved',e => {
              (e.comment.parent) ? this.addReply(e.comment)  : this.addComment(e.comment);
           });
   },
   sendVoiceNote(blob , local , reply){

    this.commentData = new FormData();

    let comment_id = uuid();

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
   isFullscreen(){

     return screenfull.isFullscreen;
   },
   scrollBottom(target){
     Ps.update(target[0]);

     $(target).scrollTop($(target).prop("scrollHeight") + 20);
   }
    },
    mounted() {

       this.video = JSON.parse(this.data);
       this.video.comments = this.video.comments.reverse();
       this.hasMoreComments = (this.video.comments_count > 5);

       this.listenForComments();

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
    }
}

</script>
