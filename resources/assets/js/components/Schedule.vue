<template>
<div>
    <div class="columns"  v-for='(s , index) in schedule'>
      <div class="column">
        <section class="section">
          <div class="heading">
            {{ Locale.get('event_title')}}
            <div class="control is-grouped">
              <p class="control is-expanded">
                <input :class="'input ' + [s.errorTitle ? 'is-danger' : '']" type="text"
                placeholder="Event name" name="title"
                v-model='schedule[index].title'>
              </p>
              <p class="control is-expanded">
                <span class="select is-medium" style="font-size:1rem;">
                  <select v-model='schedule[index].stage_id'>
                    <option v-for='stage in stages' :value="stage.id">{{ stage.title }}</option>
                  </select>
                </span>
              </p>
              <p class="control">
                <a class="button is-info" @click='save($event , index)'>
                  {{ Locale.get('save')}}
                </a>
              </p>
            </div>
          </div>
          <div class="container">
            <form @submit.prevent='addTime($event , index)'>
            <table class="table">
              <thead>
                <tr>
                  <th><abbr title="day">{{ Locale.get('day')}}</abbr></th>
                  <th><abbr title="from">{{ Locale.get('from')}}</abbr></th>
                  <th><abbr title="to">{{ Locale.get('to')}}</abbr></th>
                  <th><abbr title="to">{{ Locale.get('actions')}}</abbr></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for='(time , tin) in s.times'>
                  <td>
                    <h3>{{ Locale.get(time.day)}}</h3>
                  </td>
                  <td dir="ltr">
                    <h3>{{ time.from }}</h3>
                  </td>
                  <td dir="ltr">
                    <h3>{{ time.to }}</h3>
                  </td>
                  <td>
                    <button class="delete" @click='deleteTime(index , tin)'></button>
                  </td>
                </tr>

                <tr>
                  <td>
                    <p class="control">
                      <span class="select ">
                        <select name="day">
                          <option v-for='(day , index) in new Array(7)' :value="index + 1">
                            {{ Locale.get(index + 1)}}
                          </option>
                        </select>
                      </span>
                    </p>
                  </td>
                  <td>
                    <input type="text" name="from" class="input timepicker" dir="ltr"/>
                  </td>
                  <td>
                    <input type="text" name="to" class="input timepicker" dir="ltr"/>
                  </td>
                  <td>
                    <button class="button" type="submit">{{ Locale.get('add_time')}}</button>
                  </td>
                </tr>
            </table>
          </form>
          </div>
        </section>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <a class="button is-success" @click='addEvent'>
          <span class="icon is-small">
            <i class="fa fa-calendar"></i>
          </span>
          <span>{{ Locale.get('new_event')}}</span>
        </a>
      </div>
    </div>
</div>
</template>

<script>
export default{

  props : ['data' , 'data2'],

  data(){
    return {
      schedule : [],
      Locale : window.Locale
    }
  },
  methods :{

    addEvent(){
      this.schedule.push({
        title : '',
        stage_id : 1,
        times : []
      });
    },
    addTime(e , i){
      this.schedule[i].times.push({
         day  : e.target.day.value,
         from : e.target.from.value,
         to   : e.target.to.value
      });
    },
    deleteTime(parent , child){

      this.schedule[parent].times.splice(child , 1);
    },
    save(e , i){

      let data = new FormData();
      data.append('title' , this.schedule[i].title);
      data.append('stage_id' , this.schedule[i].stage_id);
      data.append('times' , JSON.stringify(this.schedule[i].times));

      Progressbar.self(e.target);
      this.$http.post('schedule/save' ,data).then(res => {
        Progressbar.end(e.target);

        Alert.updated();
      }).catch(res => {
        Progressbar.end(e.target);

      });
    },
    validate(i){


      this.schedule.forEach((s , m) => {
        this.schedule.forEach((x , is) => {
          if(s.title == x.title && is != m){
            this.schedule[m].errorTitle = true;
          }
        });
      });

    }
  },

 mounted(){
  this.schedule = JSON.parse(this.data);
  this.stages = JSON.parse(this.data2);
 },
  updated(){
    this.validate();
    $('.timepicker').wickedpicker();
   }
}
</script>
