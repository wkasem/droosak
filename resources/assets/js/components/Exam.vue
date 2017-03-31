<template>
<div v-if='exam.questions'>
  <section class="section">
    <div class="container">
      <div class="heading">
        <h1 class="title">{{ t }}</h1>
      </div>
      <p class="control" v-if='exam.questions.length'>
        <label class="checkbox">
          <input type="checkbox" v-model='exam.published'>
          {{ Locale.get('publish')}}
        </label>
      </p>
      <div class="control is-grouped">
        <p class="control is-expanded">
          {{ Locale.get('points')}}
          <input class="input" type="number" @keyup='validate'  name="points"  min='0'  v-model='exam.points'>
        </p>
        <p class="control is-expanded">
          {{ Locale.get('time')}}
          <input class="input" type="number" @keyup='validate' name="minutes" min='0'  v-model='exam.minutes'>
        </p>
      </div>
<hr>
<nav class="level">
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">{{ Locale.get('take')}}</p>
      <p class="title">{{ take }}</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">{{ Locale.get('fail')}}</p>
      <p class="title">{{ fail }}</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">{{ Locale.get('pass')}}</p>
      <p class="title">{{ pass }}</p>
    </div>
  </div>
</nav>
    </div>
  </section>
  <hr>


  <div class="box" v-for='(question , qIndx) in exam.questions'>
    <article class="media">
      <div class="media-left">
        <figure class="media-number is-64x64">
          {{ qIndx + 1}}
        </figure>
      </div>
      <div class="media-content">

        <div class="content">
          <div v-if='question.errBag'>
            <span class="tag is-danger is-medium" v-for='error in question.errBag'>
              {{ error }}
            </span>
            <hr v-if='question.errBag.length'>
          </div>
          <p class="control is-expanded">
            <input class="input" type="text"
                   v-model='exam.questions[qIndx].title'
                   @keyup='validate'>
          </p>

          <article class="media" v-for='(answer , aIndx) in question.answers'>
            <div class="media-content">
              <div class="content">
                <div class="control is-grouped">
                  <p class="control">
                    <input type="radio"
                           :name="question.id"
                           v-model='exam.questions[qIndx].right'
                           :value="aIndx"
                           >
                  </p>
                  <p class="control is-expanded">
                    <input class="input" type="text"
                           :placeholder="aIndx + 1"
                           v-model="exam.questions[qIndx].answers[aIndx].title"
                           @keyup='validate'>
                  </p>
                </div>
              </div>
            </div>
            <div class="media-right">
              <button class="delete" @click='removeAnswer(qIndx , aIndx)'></button>
            </div>
        </article>

        <article class="media">
          <div class="media-content">
            <div class="content">
              <a class="button is-info" @click='newAnswer(question.id)'>{{ Locale.get('newAnswer')}}</a>
            </div>
          </div>
        </article>

        </div>
  </div>
  <div class="media-right">
    <button class="delete" @click='removeQuestion(qIndx)'></button>
  </div>
</article>
</div>
<div class="notification has-text-centered" v-if='! locked'>
  <a class="button is-info" @click='newQuestion'>{{ Locale.get('newQuestion')}}</a>
  <a :class="'button is-success  ' + [canSave ? '' : 'is-disabled']" @click='saveExam($event)'>
    {{ Locale.get('save')}}
  </a>
</div>
<div class="notification has-text-centered" v-if='locked'>
  <i class="fa fa-lock" aria-hidden="true"></i>
  {{ Locale.get('exam_locked') }}
</div>
</div>
</template>

<script>
    export default {
        props : ['data' , 't' , 'locked'],

        data(){
          return {
            exam : [],
            canSave : true,
            Locale : window.Locale
          }
        },
        computed :{

          fail(){
            if(this.exam.results){
              return this.exam.results.filter(r => {
                return r.score < 50 && r.results;
              }).length;
            }
            return 0;
          },
          pass(){
            if(this.exam.results){
              return this.exam.results.filter(r => {
                return r.score > 50;
              }).length;
            }
            return 0;
          },
          take(){
            return this.exam.results.length;
          }
        },
        methods :{

          newQuestion(){

            this.exam.questions.push(this.prepareQuestion());
            this.validate();
          },
          newAnswer(id){
            let qIndx = this.exam.questions.findIndex(q => {
              return q.id == id;
            });

            this.exam.questions[qIndx].answers.push(this.prepareAnswer(qIndx));

            this.validate();
          },
          removeAnswer(qIndx , aIndx){

            this.exam.questions[qIndx].right = (aIndx - 1);

            this.exam.questions[qIndx].answers.splice(aIndx , 1);

            this.validate();

          },
          removeQuestion(qIndx){

            this.exam.questions.splice(qIndx , 1);
            this.validate();
          },
          prepareQuestion(){

            let qNumber = this.exam.questions.length + 1;

            return {
              title : `Q${qNumber}`,
              id    : qNumber,
              answers : [this.prepareAnswer('default')],
              right : 0
            }
          },
          prepareAnswer(index){

               let aNumber = (index == 'default')
                             ? 1
                             : this.exam.questions[index].answers.length + 1;

            return {
                  id  : aNumber,
                  title : ''
                }
          },
          validate(){

            let hasErr  = false;

            this.exam.questions.map(q => {
              let qErrBag = [];


              if(q.title == ""){
                qErrBag.push(this.Locale.get('titleError'));
              }

              if(q.answers.length <= 1){
                qErrBag.push(this.Locale.get('moreAnswer'));
              }

              q.answers.map((a ,index) =>{
                let aErrBag = [];

                if(a.title == ""){
                  aErrBag.push(index);
                }
                a['errBag'] = aErrBag;

                if(aErrBag.length){
                  qErrBag.push(this.Locale.get('noAnswer' , (index + 1)));
                  hasErr = true;
                }

                return a;
              });

              q['errBag'] = qErrBag;

              if(qErrBag.length) hasErr = true;


              return q;
            });

            if(!this.exam.questions.length || this.exam.points == 0 || this.exam.minutes == 0){
                this.canSave = false;
                return;
            }

            this.canSave = !hasErr;
          },
          indexExsist(array , indx){
            if(array){
              return array.findIndex(a => {
                 return a == indx;
              });
            }

            return false;

          },
          saveExam(e){

            if(!this.canSave) return;


            Progressbar.self(e.target);

            let data = new FormData();

            let tempData = this.exam;

            delete tempData['taken'];
            delete tempData['failed'];
            delete tempData['succesed'];
            delete tempData['results'];
            delete tempData['errBag'];

            tempData.questions.map(q => {
               q.answers.map(a => {
                  delete a['errBag'];
                  return a;
                });
             return q;
            });

            data.append('exam' , JSON.stringify(tempData));

            this.$http.post('save' , data).then(r => {
                Progressbar.end(e.target);
                Alert.updated();
            });
          }
        },

        mounted() {
           this.exam = JSON.parse(this.data);

           this.validate();
        },
    }
</script>
