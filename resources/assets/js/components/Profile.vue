<template>
<div>
  <div class="columns">
    <div class="column is-2 profile-pic">
      <img :src="'/pic/' + user.id" class="image is-circle" />
       <a :href="'/teachers/download/' + user.id + '/cv'" target="_blank" class="button is-pulled-right" v-if='user.cv_src'>
        {{ Locale.get('download_cv') }}
        <span class="icon is-small">
          <i class="fa fa-download" aria-hidden="true"></i>
        </span>
       </a>
       <a href="#update-cv" class="button modal-trigger">
         <span>{{ Locale.get('update_cv')}}</span>
         <span class="icon is-small">
           <i class="fa fa-file-text" ></i>
         </span>
       </a>
    </div>
    <div class="column">
      <span class="title is-2">
        {{ user.username}}
      </span>
        <p class="control">
          <textarea class="textarea" placeholder="BIO" v-model='user.about'></textarea>
        </p>
        <p class="control">
          <button class="button is-success" @click='saveBio($event)'>
            {{ Locale.get('save')}}
          </a>
        </p>
    </div>
  </div>
  <div class="modal" id="update-cv">
  <div class="modal-background"></div>
  <div class="modal-content">
    <form v-on:submit.prevent='updateCV($event)'>
      <div class="box">
        <article class="media">
          <div class="media-content">
            <div class="content ">
              <p class="control">
                <input class="is-expanded" type="file" name="cv">
              </p>
              <p class="control has-addons ">
                <input class="input is-expanded" type="password" name="password" :placeholder="Locale.get('teacher_pass')">
                <button class="button is-primary" type="submit">
                  {{ Locale.get('update')}}
                </button>
              </p>
            </div>
            </div>
          </div>
          </div>
       </form>
  </div>
</div>
</template>

<script>

export default{

  props :['data'],

  data(){
    return{
      user : [],
      Locale : window.Locale
    }
  },
  methods :{
    saveBio(e){
      let data = new FormData();

      data.append('bio' , this.user.about);

      Progressbar.self(e.target);

      this.$http.post('/teacher/update/bio' , data).then(res => {

        Alert.updated();

        Progressbar.end(e.target);
      });

    },
      updateCV(e){
        let data = new FormData($(e.target)[0]);

        data.append('teacher_id' , this.user.id);

        Progressbar.self($(e.target).find('button'));

        this.$http.post('/teacher/add/cv' , data).then(res => {

          this.user.cv_src = res.body;
          Progressbar.end($(e.target).find('button'));
          Validator.wipeInputs();
          Modal.close('update-cv');
        }, res => {

          Progressbar.end($(e.target).find('button'));

          if(res.status == 403){
            Alert.wrong(Locale.get('wrong_pass'));
            return;
          }
           Validator.errors(res.body);
        });
      }

  },
  mounted(){

    this.user = JSON.parse(this.data);

    this.user.about = (this.user.about) ? this.user.about : ''; 
  }

}
</script>
