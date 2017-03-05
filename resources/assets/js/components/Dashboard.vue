<template>
<div>

    <div class="box">
    <article class="media">
      <div class="media-left">
        <figure class="image is-64x64">
          <img src="/imgs/logo.png" alt="Image">
        </figure>
      </div>
      <div class="media-content">
        <form method="post" name="logoForm" action="/admin/logo" enctype="multipart/form-data">
          <div class="is-file ">
            <input type="file" name="pic">
              <a class="button ">
                <span>{{ Locale.get('update')}} </span>
              </a>
          </div>
        </form>
      </div>
    </article>
  </div>
    <div class="box">
    <article class="media">
      <div class="media-content">
        <div class="content" id="usersChart" > </div>
        <div class="content is-loading-div" v-if='!usersChart'> </div>
      </div>
    </article>
  </div>
  <div class="columns">
    <div class="column">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            NewsLetter Subscribers
            <span class="content is-loading-div" v-if='!subscribers'> </span>
            <span class="tag" v-if='subscribers'>{{ subscribers.length }}</span>
          </p>
          </a>
        </header>
        <div class="card-content subscribers">
          <div class="content">
            <table>
              <tbody>
                <tr v-for='subscriber in subscribers'><td>{{ subscriber.email }}</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            {{ Locale.get('liveNow') }}
            <span class="content is-loading-div" v-if='!live'> </span>
          </p>
          </a>
        </header>
        <div class="card-content live">
          <div class="content">
            <table>
              <tbody>
                <tr v-for='video in live'>
                  <td>
                    <figure class="image is-64x64">
                      <img src="/imgs/video_banco_wiki.jpg">
                    </figure>
                  </td>
                  <td>
                          <p>
                            <strong>{{ video.published_by.username }}</strong> <small><timeago :since="Date.parse(video.created_at)" :auto-update="60"></timeago></small>
                            <br>
                            {{ video.title }}
                          </p>
                    </td>
                    <td>
                      <a :href="'/video/' + video.video_id" target="_blank" class="button is-warning">{{ Locale.get('watch')}}</a>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="box">
  <article class="media">
    <div class="media-content">
      <div class="content" id="revenueChart" > </div>
      <div class="content is-loading-div" v-if='!revenueChart'> </div>
    </div>
  </article>
</div>


<div class="box" v-if='welcome'>
<article class="media">
  <div class="media-content">
    <div class="columns">
      <div class="column">
        <img src="/imgs/welcome1.png" class="image">
      </div>
      <form class="column" @submit.prevent='introSave($event)'>
        <span class="title">Intro <button class="button is-success">{{ Locale.get('save') }}</button></span>
        <label class="label">Title - Arabic</label>
        <p class="control">
          <input class="input" type="text" name="title_arabic" :value='welcome.title_arabic'>
        </p>
        <label class="label">Title - English</label>
        <p class="control">
          <input class="input" type="text" name="title_english" :value='welcome.title_english'>
        </p>
        <hr>
        <label class="label">Subtitle - Arabic</label>
        <p class="control">
          <textarea class="textarea" name="subtitle_arabic">{{ welcome.subtitle_arabic}}</textarea>
        </p>
        <label class="label">Subtitle - English</label>
        <p class="control">
          <textarea class="textarea" name="subtitle_english">{{ welcome.subtitle_english}}</textarea>
        </p>
      </form>
    </div>
  </div>
</article>
</div>

<div class="box" v-if='welcome'>
<article class="media">
  <form @submit.prevent='introSave($event)' class="media-content">
    <span class="title">Other Details <button class="button is-success">Save</button></span>
    <div class="columns">
      <div class="column">
        <img src="/imgs/welcome1.png" class="image">
      </div>
      <div class="column" >
        <label class="label">About - Arabic</label>
        <p class="control">
          <textarea class="textarea" name="about_arabic">{{ welcome.about_arabic}}</textarea>
        </p>
        <label class="label">About - English</label>
        <p class="control">
          <textarea class="textarea" name="about_english">{{ welcome.about_english}}</textarea>
        </p>
      </div>
    </div>
    <hr>
    <div class="columns">
      <div class="column">
        <img src="/imgs/welcome2.png" class="image">
      </div>
      <div class="column" >
        <label class="label">Email</label>
        <p class="control">
          <input class="input" type="text" name="email" :value='welcome.email'>
        </p>
      </div>
    </div>
    <hr>
    <p class="control has-icon has-icon-right">
      <input class="input" type="text" name="facebook" placeholder="Facebook" :value="welcome.facebook">
      <span class="icon is-small">
        <i class="fa fa-facebook"></i>
      </span>
    </p>
    <p class="control has-icon has-icon-right">
      <input class="input" type="text" name="twitter" placeholder="Twitter" :value="welcome.twitter">
      <span class="icon is-small">
        <i class="fa fa-twitter"></i>
      </span>
    </p>
    <p class="control has-icon has-icon-right">
      <input class="input" type="text" name="instagram" placeholder="Instagram" :value="welcome.instagram">
      <span class="icon is-small">
        <i class="fa fa-instagram"></i>
      </span>
    </p>
    <p class="control has-icon has-icon-right">
      <input class="input" type="text" name="map" placeholder="Google Map Url" :value="welcome.map">
      <span class="icon is-small">
        <i class="fa fa-map-marker"></i>
      </span>
    </p>
  </form>
</article>
</div>

</div>
</template>
<script>
export default{

props : ['data' , 'tdir'],

 data(){
   return {
      usersChart : null,
      revenueChart : null,
      subscribers : null,
      live : null,
      welcome : null,
      Locale :window.Locale
   }
 },

  methods :{

    introSave(e){
     let data = new FormData($(e.target)[0]);

     Progressbar.self($(e.target).find('button'));

     this.$http.post('admin/introSave' , data).then(res => {

       Progressbar.end($(e.target).find('button'));
       Alert.updated();
     });
    },
    prepareChart(){
      let x = [];
      $.map(this.usersChart , (data , name) => {
          x.push({
            name : name,
            data : Object.keys(data).map(d => { return data[d]; })
          })
      });
      return x;
    },
    usersChartGraph(){

      Highcharts.chart('usersChart', {
          chart: {
              type: 'line'
          },
          title: {
              text: (new Date()).getFullYear()
          },
          subtitle: {
              text: 'Yearly Overview'
          },
          xAxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: false
              }
          },
          series: this.prepareChart()
      });
    },
    revenueChartGraph(){
      Highcharts.chart('revenueChart', {
          chart: {
              type: 'line'
          },
          title: {
              text: (new Date()).getFullYear()
          },
          subtitle: {
              text: 'Yearly Overview'
          },
          xAxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: false
              }
          },
          series: [
            {
              name : "Revenue",
              data : Object.keys(this.revenueChart).map(d => { return this.revenueChart[d]; })
            }
          ]
      });
    },
    LoadData(){

      let modules = ['usersChart' ,'revenueChart', 'subscribers' , 'live'];

      modules.forEach(module => {
        this.$http.post(`admin/${module}`).then(res => {
          this[module] = res.body;
          switch (module) {
            case 'usersChart':
              this.usersChartGraph()
              break;
            case 'revenueChart':
              this.revenueChartGraph()
              break;
            case 'subscribers':
              Ps.initialize($('.subscribers')[0]);
              break;
            case 'live':
              Ps.initialize($('.live')[0]);
              break;

          }
        });
      });
    }
  },

  mounted(){
    this.welcome = JSON.parse(this.data);

    this.LoadData();
    $(window).on('resize' , () => {
      this.usersChartGraph();
      this.revenueChartGraph()
    });

  }
}
</script>

<style scoped>
#usersChart,
#revenueChart {
  width: 100%;
	height: 400px;
}
.subscribers,.live{
  position: relative;
  height: 235px;
}
</style>
