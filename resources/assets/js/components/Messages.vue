<template>
<div class="columns " style="height:100%;">
<div class="column is-one-quarter messages__wrapper is-hidden-touch">
  <div class="card contacts__wrapper">
      <div :class="'contact ' + [index == indx ? 'active' : '']"
           v-for='(conversation , index) in conversations'
           @click='changeConversation(index)'>
        <img :src="'/pic/' + conversation.other_user.id" class="image is-circle is-64x64">
        <div class="details">
          <h5 class="title is-5" style="margin:0"> {{ conversation.other_user.username }} </h5>
          <h6 class="title is-6" v-html="lastMessage(conversation.messages)"></h6>
        </div>
          <span class="tag is-danger"
                v-if='conversation.notify_count' style="position: absolute;left: 0;">
          {{conversation.notify_count}}
          </span>
      </div>
  </div>
</div>
<!-- Mobile -->
<div class="column is-one-quarter messages__wrapper mobile is-hidden-desktop">
  <span class="nav-item">
    <a class="button is-warning is-inverted" @click.prevent='toggleContacts'>
      <span class="icon">
        <i class="fa fa-users" aria-hidden="true"></i>
      </span>
      <span>Contacts</span>
    </a>
  </span>
  <div class="card contacts__wrapper">
      <div :class="'contact ' + [index == indx ? 'active' : '']"
           v-for='(conversation , index) in conversations'
           @click='changeConversation(index)'>
        <img :src="'/pic/' + conversation.other_user.id" class="image is-circle is-64x64">
        <div class="details">
          <h5 class="title is-5" style="margin:0"> {{ conversation.other_user.username }} </h5>
          <h6 class="title is-6" v-html="lastMessage(conversation.messages)"></h6>
        </div>
          <span class="tag is-danger"
                v-if='conversation.notify_count' style="position: absolute;left: 0;">
          {{conversation.notify_count}}
          </span>
      </div>
  </div>
</div>

<div class="column">

  <section class="hero is-light is-large " style="height:100%;" v-if='conversations.length'>
    <div class="hero-head" style="position: relative;z-index: 0;">
      <header class="nav">
        <div class="container">
          <div class="nav-left">
            <a class="nav-item">
              <img :src="'/pic/' + current('other_id')"
                   class="image is-circle logo">
            </a>
            <a class="nav-item">
              <h4 class="name title  is-4">{{ current('other_user').username }}</h4>
            </a>
            <a class="nav-item">
              <span v-html="badge(current('other_user'))"></span>
            </a>
          </div>
          <div class="nav-right is-hidden-desktop">
            <span class="nav-item">
              <a class="button is-warning is-inverted" @click.prevent='toggleContacts'>
                <span class="icon">
                  <i class="fa fa-users" aria-hidden="true"></i>
                </span>
                <span>Contacts</span>
              </a>
            </span>
          </div>
        </div>
      </header>
    </div>

    <div class="hero-body"
         style="padding: 0;border-bottom:1px solid rgba(219, 219, 219, 0.5);"
         v-if='conversations[indx].messages.length'>
      <div class="container">
        <div class="messages">
          <article :class="'media msg ' +  [hisOwnMessage(message) ? '' : 'other']"
                    v-for='message in conversations[indx].messages'
                    v-if='conversations[indx].messages.length'>
            <figure class="media-left">
              <p class="image">
                <img class="image is-circle is-64x64" :src="'/pic/' + [hisOwnMessage(message) ? authUser().id : current('other_id')]">
              </p>
            </figure>
            <div class="media-content">
              <div class="content">
                <p>
                  <voicenote :data='message' v-if='message.voiceNote'></voicenote>
                  <span v-if='!message.voiceNote'>
                    {{ message.body }}
                  </span>
                </p>
              </div>
            </div>
          </article>
      </div>
    </div>
  </div>

    <div class="hero-body" style="padding:13rem 0" v-if='!conversations[indx].messages.length'>
      <div class="container has-text-centered">
        <h1 class="title">
          <i class="fa fa-inbox" style="font-size:40px"></i>
          {{ Locale.get('no-messages') }}
        </h1>
      </div>
    </div>

    <div class="hero-foot" style="margin: 5px auto;width: 90%;">
      <form class="media" @submit='sendMessage($event)'  @submit.prevent>
        <div class="media-content">
          <p class="control">
            <textarea class="textarea" name="body" ref="bodyText" @keyup.enter="$refs.sendBtn.click()"></textarea>
          </p>
          <nav class="level">
            <div class="level-left">
              <div class="level-item">
                <button type="submit" class="button is-success is-outlined" ref="sendBtn">
                  {{ Locale.get('send') }}
                </button>
              </div>
              <div class="level-item">
                <voicemessage @send='sendVoiceNote' :Locale='Locale'></voicemessage>
              </div>
            </div>
          </nav>
        </div>
      </form>
    </div>
  </section>
</div>

</div>
</template>

<script>
import voiceNote from '../helpers/voicenote';

    export default {
        props : ['data'],

        data(){
          return {
            'conversations' : [],
            'voiceNote' : new voiceNote(this),
            'messageData' : null,
            'indx' :0,
            'curr_id' : null,
            'Locale' : window.Locale,
            'badge' : window.Badge
          }
        },
        methods :{
          toggleContacts(){

            $('.mobile').fadeToggle();
          },
          current(key){

            return this.conversations[this.indx][key];
          },
          getIndex(e){

            return this.conversations.findIndex(c =>{
               return c.id == e.conversation_id;
            });
          },
          authUser(){

            return window.user;
          },
          lastMessage(msgs){

            let msg = msgs[(msgs.length - 1)];

            if(msg){
              if(msg.voiceNote){
                return '<span class="icon is-small"> <i class="fa fa-microphone"></i> </span>';
              }
              return msg.body;
            }
          },
          scrollBottom(){

            $('.messages').scrollTop($('.messages').prop("scrollHeight"));
          },
          sendVoiceNote(blob , local){

           this.messageData = new FormData();

           this.messageData.append('audio' , blob);
           this.messageData.append('conversation_id' , this.current('id'));

           this.addMessage(this.indx , this.prepareMessage(local));

           this.$http.post('/messages/sendVoiceNote' , this.messageData , {emulateJSON : false});

          },
          sendMessage(event){

            this.messageData = new FormData($(event.target)[0]);

            if(this.messageData.get('body') == ''){
              Alert.wrong('You Can\'t Send Empty Msg');
              return false;
            }

            $(this.$refs.bodyText).val('');

            this.addMessage(this.indx , this.prepareMessage(false));

            this.messageData.append('conversation_id' , this.current('id'));

            this.$http.post('/messages/send' , this.messageData);
          },
          notify(e){

           if(e.conversation_id != this.current('id')){

               let indx = this.getIndex(e);

               if(!this.conversations[indx].hasOwnProperty('notify_count')){
                 this.conversations[indx]['notify_count'] = 1;
               }else{

                 this.conversations[indx]['notify_count']++;
               }

                this.playNotification();

          }

          },
          clearNotify(indx){

             if(this.conversations[indx]['notify_count'] > 0){

               this.sendSeen(this.conversations[indx].id);

               delete this.conversations[indx]['notify_count'];
             }


          },
          playNotification(){

            $('#notification_alert')[0].play();
          },
          hisOwnMessage(message){

            return message.user_id == window.user.id;
          },
          prepareMessage(voiceNote){

            if(voiceNote){
              return {
                'body' : '',
                'voiceNote' : true,
                'user_id' : window.user.id,
                'voiceNote_src' : voiceNote,
                'localVoiceNoteURl' : true,
                'created_at' : new Date().toLocaleString()
              }
            }
            return {
              'body' : this.messageData.get('body'),
              'voiceNote' : false,
              'user_id' : window.user.id,
              'created_at' : new Date().toLocaleString()
            }
          },
          addMessage(indx , msg){

            this.conversations[indx].messages.push(msg);
          },
          changeConversation(id){

             this.indx = id;
             this.clearNotify(id);
          },
          online(index , y){

           this.conversations[index].other_online = y;
         },
          registerListeners(){

            this.conversations.forEach((c , index) =>{

              Echo.join(`conversation.${c.id}`)
                  .listen('MessageRecieved',e => {
                      this.notify(e.msg);
                      this.addMessage(this.getIndex(e.msg) , e.msg);
                   });
            });
          },
          reverseMsgs(){

            this.conversations.map(conversation => {
              conversation.messages = conversation.messages.reverse();
              return conversation;
            });
          },
          unseenMessages(){

            this.conversations.map((conversation , index) => {
              conversation['notify_count'] = 0;

              if(index == this.indx){
                this.sendSeen(conversation.id);
              }else{
                conversation.messages.forEach(msg =>{

                  if(msg.user_id != window.user.id && !msg.seen){
                    conversation['notify_count']++;
                  }
                });
              }

              return conversation;
            });
          },
          sendSeen(id){
            let data = {'conversation_id' : id , 'user_id': this.current('other_id')};

            this.$http.post('/messages/markAsSeen' , data);
          },
          selectCurrent(){

            this.indx = this.conversations.findIndex(c => {
              return c.other_id == this.curr_id;
            });
          }
        },

        mounted() {

          let data = JSON.parse(this.data);

          this.conversations = data[0];
          this.curr_id = data[1];

          if(this.curr_id){
            this.selectCurrent();
          }

          this.registerListeners();
          this.unseenMessages();
          this.reverseMsgs();

          this.scrollBottom();
        },

        updated(){
          if($('.contacts__wrapper')[0] && !$('.contacts__wrapper .ps-scrollbar-x-rail')[0]){
            Ps.initialize($('.contacts__wrapper')[0]);
          }
          if($('.messages')[0] && !$('.messages .ps-scrollbar-x-rail')[0]){
             Ps.initialize($('.messages')[0]);
          }
          if($('.messages .ps-scrollbar-x-rail')[0]) Ps.update($('.messages')[0]);
          this.scrollBottom();
        }
    }
</script>
