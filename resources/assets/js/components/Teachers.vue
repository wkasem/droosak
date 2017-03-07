<template>
<div>
  <p class="control has-addons has-addons-centered">
    <span class="select">
      <select v-model='searchBy'>
        <option value="id">{{ Locale.get('id')}}</option>
        <option value="username">{{ Locale.get('username')}}</option>
        <option value="email">{{ Locale.get('email')}}</option>
        <option value="mobile">{{ Locale.get('mobile')}}</option>
      </select>
    </span>
    <input class="input" type="text" :placeholder="Locale.get('searchby')" v-model='searchKey'>
    <a href="#teacher-new" class="button is-success modal-trigger">
      <span>{{ Locale.get('new_teacher')}}</span>
      <span class="icon is-small">
        <i class="fa fa-plus"></i>
      </span>
    </a>
  </p>
<table class="table" :dir='tdir'>
  <thead>
    <tr>
      <th><abbr title="ID">{{ Locale.get('id')}}</abbr></th>
      <th><abbr title="Image">{{ Locale.get('image')}}</abbr></th>
      <th><abbr title="username">{{ Locale.get('username')}}</abbr></th>
      <th><abbr title="Email">{{ Locale.get('email')}}</abbr></th>
      <th><abbr title="mobile">{{ Locale.get('mobile')}}</abbr></th>
      <th><abbr title="actions">{{ Locale.get('actions')}}</abbr></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th><abbr title="ID">{{ Locale.get('id')}}</abbr></th>
      <th><abbr title="Image">{{ Locale.get('image')}}</abbr></th>
      <th><abbr title="username">{{ Locale.get('username')}}</abbr></th>
      <th><abbr title="Email">{{ Locale.get('email')}}</abbr></th>
      <th><abbr title="mobile">{{ Locale.get('mobile')}}</abbr></th>
      <th><abbr title="actions">{{ Locale.get('actions')}}</abbr></th>
    </tr>
  </tfoot>
  <tbody>
    <tr v-for='(teacher , index) in shadowCopy'>
      <th>{{ teacher.id }}</th>
      <th dir="ltr"><img :src="'/pic/' + teacher.id" class="image is-circle is-32x32" /></th>
      <td>{{ teacher.username }}</td>
      <td>{{ teacher.email }}</td>
      <td>{{ teacher.phone_number }}</td>
      <td>
        <div class="block">
          <a href="#update-cv" class="button modal-trigger" @click='setCurrent(index)'>
            <span>{{ Locale.get('update_cv')}}</span>
            <span class="icon is-small">
              <i class="fa fa-file-text" ></i>
            </span>
          </a>
          <a :href="'/profile/' + teacher.id" class="button is-primary" target="_blank">
            <span>{{ Locale.get('profile')}}</span>
            <span class="icon is-small">
              <i class="fa fa-user" ></i>
            </span>
          </a>
        </div>
      </td>
    </tr>

  </tbody>
</table>

<div class="modal" id="teacher-new">
<div class="modal-background"></div>
<div class="modal-content">
  <form v-on:submit.prevent='newTeacher($event)'>
    <div class="box">
      <article class="media">
        <div class="media-content">
            <div class="control">
              <input class="is-expanded" type="file" name="pic">
            </div>
            <div class="control">
              <input class="input is-expanded" name="username" type="text" :placeholder="Locale.get('username')">
            </div>
            <div class="control">
              <input class="input is-expanded" name="email" type="text" :placeholder="Locale.get('email')">
            </div>
            <div class="control">
              <input class="input is-expanded" name="phone_number" type="text" :placeholder="Locale.get('mobile')">
            </div>
            <div class="control">
              <input class="input is-expanded" name="password" type="password" :placeholder="Locale.get('password')">
            </div>
            <div class="control">
              <textarea class="textarea is-focused" name="discription" :placeholder="Locale.get('bio')"></textarea>
            </div>
            <div class="control is-horizontal">
              <div class="control">
                <button class="button is-success " type="submit">
                  {{ Locale.get('add')}}
                </button>
              </div>
            </div>
          </div>
        </div>
        </div>
     </form>
</div>

<div class="modal" id="update-cv">
<div class="modal-background"></div>
<div class="modal-content" v-if='shadowCopy.length && current()'>
  <form v-on:submit.prevent='updateCV($event)'>
    <div class="box">
      <article class="media">
        <div class="media-content">
          <div class="content ">
            <h1 class="title is-dark" >{{ current().username }}</h1>
            <p class="control">
              <input class="is-expanded" type="file" name="cv">
            </p>
            <p class="control has-addons ">
              <input class="input is-expanded" type="password" name="password" :placeholder="Locale.get('admin_pass')">
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
</div>
</template>

<script>
    export default {
      props : ['data' , 'tdir'],

        data(){
          return {
            teachers : [],
            shadowCopy : [],
            searchBy : 'id',
            searchKey: '',
            indx : 0,
            Locale : window.Locale
          }
        },
        watch: {
          searchKey: function(val, oldVal) {
            this.indx = 0;
            if(val == ""){
              this.shadowCopy = this.teachers;
              return;
            }

            this.shadowCopy = this.teachers.filter(student => {
                return student[this.searchBy].toString().includes(val.trim().toLowerCase());
            });
          }
        },
        methods :{

          newTeacher(e){

            let data = new FormData($(e.target)[0]);

            Progressbar.self($(e.target).find('button'));

            this.$http.post('teachers/add' , data , {emulateJSON : false}).then(res => {

              this.teachers.push(res.body);
              Modal.close('teacher-new');
              Progressbar.end($(e.target).find('button'));
              Validator.wipeInputs();
              Alert.updated();
            } , res => {
              Progressbar.end($(e.target).find('button'));
              Validator.errors(res.body);
            });
          },
          setCurrent(index){

            this.indx = index;
          },
          current(){

            return this.shadowCopy[this.indx];
          },
          updateCV(e){
            let data = new FormData($(e.target)[0]);

            data.append('teacher_id' , this.current().id);

            Progressbar.self($(e.target).find('button'));

            this.$http.post('/teacher/add/cv' , data).then(res => {

              this.current().cv_src = res.body;
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

        mounted() {
           this.teachers = JSON.parse(this.data);
           this.shadowCopy = this.teachers;

           Modal.activate();
        },
        updated(){

          Modal.activate();
        }
    }
</script>
