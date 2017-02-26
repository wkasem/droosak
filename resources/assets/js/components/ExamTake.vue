<template>
  <div v-if='exam'>
    <section class="section" v-if='!finish'>
      <div class="container">
        <div class="heading">
          <h1 class="title">{{ exam.title }}</h1>
          <div class="subtitle" id="countdown" :dir="tdir"> </div>
        </div>
        <hr />
        <div class="box">
          <article class="media">
            <div class="media-left">
              <figure class="media-number is-64x64">
                {{ indx + 1}}
              </figure>
            </div>
            <div class="media-content">

              <div class="content">
                <h5 class="title">{{ currentQ().title }}</h5>

                <article class="media" v-for='(answer , aIndx) in currentQ().answers'>
                  <div class="media-content">
                    <div class="content">
                      <div class="control is-grouped">
                        <p class="control">
                          <input :name="currentQ().id " type="radio"
                                 :id="currentQ().id + '-' + answer.id"
                                 v-model='answerIndx'
                                 :value="aIndx"
                                 >
                        </p>
                        <h6>{{ answer.title }}</h6>
                      </div>
                    </div>
                  </div>
              </article>
              </div>
        </div>
      </article>
      </div>

      <button class="button" @click='next()' v-if='hasNext()'>{{ Locale.get('next') }}</button>
      <button class="button" @click='finishSave($event)' v-if='!hasNext()'>{{ Locale.get('finish') }}</button>
      </div>
    </section>
    <section class="section" v-if='finish'>
      <div class="container">
        <div class="heading">
          Finished
        </div>
      </div>
    </section>
</div>
</template>

<script>
    export default {
        props : ['data' , 'tdir'],

        data(){
          return {
            exam : null,
            indx : 0,
            answerIndx : 0,
            finish : false,
            answers : [],
            Locale : window.Locale,
            results : []
          }
        },

        methods : {

          currentQ(){

            return this.exam.questions[this.indx];
          },
          hasNext(){

            return this.exam.questions.length > (this.indx + 1);
          },
          finished(){

            return this.finish = (this.exam.questions.length == this.exam.user.results.length);
          },
          next(){

            this.exam.user.results.push({ qIndx : this.indx , aIndx : this.answerIndx});

            this.acceptAnswers();

            this.indx++;
            this.answerIndx = 0;
          },
          acceptAnswers(){

            let data = new FormData();

            data.append('answers' , JSON.stringify(this.exam.user.results));
            data.append('examid' , this.exam.id);

            this.$http.post('acceptAnswers' , data);
          },
          checkStage(){


            this.exam.user.results = JSON.parse(this.exam.user.results) || [];

            if(!this.finished()){
              this.indx = this.exam.user.results.length;
            }
          },
          finishSave(e){
console.log(e);
           if(e) Progressbar.self(e.target);
           let data = new FormData();

           data.append('answers' , JSON.stringify(this.exam.user.results));
           data.append('examid' , this.exam.id);

           this.$http.post('finish' , data).then(res => {
             this.finish = true;
             this.results = JSON.parse(res.body);
           });
          },
          countdown(){
            let time = new Date(this.exam.user.started_at);

            time.setMinutes(time.getMinutes() + this.exam.minutes);

            $(() => {
              let that = this;
              $("#countdown").countdown(time.toLocaleString(), function(event){
                if(event.type == "finish" && !that.finish){

                  that.finishSave();
                }
                $(this).html(event.strftime(
                  `%H ${that.Locale.get('hour')}
                   %M ${that.Locale.get('min')}
                   %S ${that.Locale.get('sec')}`
                ));
              });
            });
          }
        },

        mounted() {

          this.exam = JSON.parse(this.data);
          this.answers = this.exam.user.results;
console.log(JSON.parse(this.data));
          this.countdown();

          this.checkStage();

        }
    }
</script>
