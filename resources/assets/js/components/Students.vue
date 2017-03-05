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
    </p>
  <table class="table" :dir='tdir'>
    <thead>
      <tr>
        <th><abbr title="ID">{{ Locale.get('id')}}</abbr></th>
        <th><abbr title="Image">{{ Locale.get('image')}}</abbr></th>
        <th><abbr title="username">{{ Locale.get('username')}}</abbr></th>
        <th><abbr title="Email">{{ Locale.get('email')}}</abbr></th>
        <th><abbr title="mobile">{{ Locale.get('mobile')}}</abbr></th>
        <th><abbr title="points">{{ Locale.get('points')}}</abbr></th>
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
        <th><abbr title="points">{{ Locale.get('points')}}</abbr></th>
        <th><abbr title="actions">{{ Locale.get('actions')}}</abbr></th>
      </tr>
    </tfoot>
    <tbody>
      <tr v-for='(student , index) in shadowCopy'>
        <th>{{ student.id }}</th>
        <th dir="ltr"><img :src="'/pic/' + student.id" class="image is-circle is-32x32" /></th>
        <td>{{ student.username }}</td>
        <td>{{ student.email }}</td>
        <td>{{ student.phone_number }}</td>
        <td>{{ student.points }}</td>
        <td>
          <div class="block">
            <a href="#student-points" class="button  modal-trigger" @click='setCurrent(student)'>
              <span>{{ Locale.get('points_add')}}</span>
              <span class="icon is-small">
                <i class="fa fa-dot-circle-o" ></i>
              </span>
            </a>
            <a :href="'/messages/' + student.id" class="button is-info is-outlined" target="_blank">
              <span>{{ Locale.get('chat')}}</span>
              <span class="icon is-small">
                <i class="fa fa-comments-o"></i>
              </span>
            </a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="modal" id="student-points">
  <div class="modal-background"></div>
  <div class="modal-content" v-if='shadowCopy.length && current'>
    <form v-on:submit.prevent='updateBalanace($event)'>
      <div class="box">
        <article class="media">
          <div class="media-content">
            <div class="content ">
              <h1 class="title is-dark" >{{ current.username }}</h1>
              <p class="control">
                <input class="input is-expanded" type="number" name="points">
              </p>
              <p class="control has-addons ">
                <input class="input is-expanded" type="password" name="password" :placeholder="Locale.get('admin_pass')">
                <button class="button is-primary" type="submit">
                  {{ Locale.get('update')}}
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
        props : ['data' , 'tdir'],

        data(){
          return {
            students : [],
            shadowCopy : [],
            searchBy : 'id',
            searchKey: '',
            current : null,
            Locale : window.Locale
          }
        },
        watch: {
          searchKey: function(val, oldVal) {
            this.indx = 0;
            if(val == ""){
              this.shadowCopy = this.students;
              return;
            }

            this.shadowCopy = this.students.filter(student => {
                return student[this.searchBy].toString().includes(val.trim().toLowerCase());
            });
          }
        },
        methods : {

         setCurrent(crr){
           this.current = crr;

         },
         updateBalanace(e){
           let data = new FormData($(e.target)[0]);

           data.append('id' , this.current.id);

           Progressbar.self($(e.target).find('button'));

           this.$http.post('students/points/update' , data ).then(res => {
             Progressbar.end($(e.target).find('button'));
              Modal.close('student-points');
              Alert.updated();

              this.students.find(user => { return user.id == this.current.id; }).points += parseInt(data.get('points'));

           } , res => {
             Alert.wrong(Locale.get('wrong_pass'));

             Progressbar.end($(e.target).find('button'));
           });
         }
        },

        mounted() {
           this.students = JSON.parse(this.data);
           this.shadowCopy = this.students;
        },
        updated(){

          Modal.activate();
        }
    }
</script>
