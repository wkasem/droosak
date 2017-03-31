<template>
  <div class="columns">
    <div class="column section">
      <div class="tabs is-boxed">
        <ul>
          <li ><a href="#live">{{ Locale.get('live') }}</a></li>
          <li class="is-active"><a href="#metrics">metrics</a></li>
          <li ><a href="#landpage">Land Page</a></li>
          <li><a href="#settings">Settings</a></li>
        </ul>
      </div>
    <div class="container">
      <div id='live' >
        <a href="#newLive" class="button is-danger modal-trigger">{{ Locale.get('live') }}</a>
        <hr>

        <div v-if='live'>
        <div class="columns"  v-for='videoGroup in mylive'>
          <div class="column is-6" v-for='video in videoGroup'>
            <div class="card">
              <div class="card-image">
                <figure class="image">
                  <iframe class="video-js"
                          :src="video.stream.src"
                          frameborder="0" scrolling="no">
                  </iframe>
                </figure>
              </div>
              <div class="card-content">
                <div class="content">
                  <p>
                   <strong>Login :</strong> {{ video.stream.login }} <strong> Password :</strong> {{ video.stream.password }}
                  </p>
                  <p>
                    <strong>Stream Key :</strong> {{ video.stream.stream_name }}
                  </p>
                  <p>
                    <strong> URL :</strong> {{ video.stream.src }}
                  </p>
                </div>
              </div>
              <footer class="card-footer">
                <a class="card-footer-item" :href="'/video/' + video.video_id" target="_blank">
                  {{ Locale.get('watch')}}
                </a>
              </footer>
            </div>
          </div>
        </div>
</div>

      </div>
      <div id="metrics">
        <div class=" is-loading-div" v-if='!usersChart'> </div>
        <div id="usersChart" > </div>
        <hr>
        <div class=" is-loading-div" v-if='!revenueChart'> </div>
        <div id="revenueChart" > </div>
        <hr>
        <div class="columns">
          <div class="column">
            <div class="card">
              <header class="card-header">
                <p class="card-header-title">
                  {{ Locale.get('liveNow') }}
                  <span class="content is-loading-div" v-if='!live'> </span>
                </p>
                </a>
              </header>
              <div class="card-content live_panel" v-if='live'>
                <div class="content">
                  <table>
                    <tbody>
                      <tr v-for='video in allLive'>
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
          <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                {{ Locale.get('NewsLetter')}}
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
       </div>
     </div>
      <div id="landpage">
          <form class="media-content" @submit.prevent='introSave($event)'v-if="welcome">
            <div class="title">
              <button class="button is-success">{{ Locale.get('save') }}</button>
              <label class="label">Arabic</label>
              <p class="control">
                <span class="select is-medium">
                  <select v-model="welcome.fonts['main_arabic']">
                    <option value="">Default</option>
                    <option v-for='font in fonts'
                            :style="{ fontFamily: `'${font.id}'` }"
                            :value='font.id'>
                      {{ font.name }}
                    </option>
                  </select>
                </span>
              </p>
              <label class="label">English</label>
              <p class="control">
                <span class="select is-medium">
                  <select v-model="welcome.fonts['main_english']">
                    <option value="">Default</option>
                    <option v-for='font in fonts'
                            :style="{ fontFamily: `'${font.id}'` }"
                            :value='font.id'>
                      {{ font.name }}
                    </option>
                  </select>
                </span>
              </p>
            </div>

              <div class="columns">
              <div class="column">
                <img src="/imgs/welcome1.png" class="image">
              </div>
              <div class="column">
            <label class="label">{{ Locale.get('title_arabic')}}</label>
            <p class="control">
              <input class="input" type="text" name="title_arabic"
                     :value='welcome.title_arabic'
                     v-on:contextmenu.prevent="changeFont($event , 'title_arabic')"
                     :style="{ fontFamily: loadFont('title_arabic') }">
            </p>
            <label class="label">{{ Locale.get('title_english')}}</label>
            <p class="control">
              <input class="input" type="text" name="title_english"
              v-on:contextmenu.prevent="changeFont($event , 'title_english')"
              :value='welcome.title_english'

              :style="{ fontFamily: loadFont('title_english') }">
            </p>
            <hr>
            <label class="label">{{ Locale.get('subtitle_arabic')}}</label>
            <p class="control">
              <textarea class="textarea" name="subtitle_arabic"
              :style="{ fontFamily: loadFont('subtitle_arabic') }"
              v-on:contextmenu.prevent="changeFont($event , 'subtitle_arabic')"
              >{{ welcome.subtitle_arabic}}</textarea>
            </p>
            <label class="label">{{ Locale.get('subtitle_english')}}</label>
            <p class="control">
              <textarea class="textarea" name="subtitle_english"
              :style="{ fontFamily: loadFont('subtitle_english') }"
              v-on:contextmenu.prevent="changeFont($event , 'subtitle_english')"
              >{{ welcome.subtitle_english}}</textarea>
            </p>
        </div>
        </div>
    </form>

        <hr>
        <form @submit.prevent='introSave($event)' class="media-content" v-if='welcome'>
          <span class="title"> <button class="button is-success">{{ Locale.get('save')}}</button></span>
          <div class="columns">
            <div class="column">
              <img src="/imgs/welcome3.png" class="image">
            </div>
            <div class="column" >
              <label class="label">{{ Locale.get('about_arabic')}}</label>
              <p class="control">
                <textarea class="textarea" name="about_arabic"
                :style="{ fontFamily: loadFont('about_arabic') }"
                v-on:contextmenu.prevent="changeFont($event , 'about_arabic')"
                 >{{ welcome.about_arabic}}</textarea>
              </p>
              <label class="label">{{ Locale.get('about_english')}}</label>
              <p class="control">
                <textarea class="textarea" name="about_english"
                :style="{ fontFamily: loadFont('about_english') }"
                v-on:contextmenu.prevent="changeFont($event , 'about_english')"
                >{{ welcome.about_english}}</textarea>
              </p>
            </div>
          </div>
          <hr>
          <div class="columns">
            <div class="column">
              <img src="/imgs/welcome2.png" class="image">
            </div>
            <div class="column" >
              <label class="label">{{ Locale.get('email')}}</label>
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
      </div>
      <div id="settings">
        <div class="box" v-if='welcome'>
        <article class="media">
          <div class="media-content">
            <figure class="image ">
              <img :src="'/imgs/'+welcome.logo" alt="Image" id="logo">
            </figure>
              <div class="is-file ">
                <input type="file" name="logo" @change='updateLogo($event)'>
                  <a class="button ">
                    <span>{{ Locale.get('update')}} </span>
                  </a>
              </div>
          </div>
        </article>
      </div>
<hr>

       <div class="columns">
         <div class="column is-11">
           <strong>Fonts</strong>
         </div>
         <div class="column">
           <div class="is-file ">
             <input type="file" name="font" @change='uploadFont($event)'>
               <a class="button ">
                 <span>{{ Locale.get('update')}} </span>
               </a>
           </div>
         </div>
       </div>
       <div class="columns" v-for='font in fonts'>
         <div class="column" :style="{ fontFamily: `'${font.id}'` }">
           <h3 >{{ font.name }}</h3>
         </div>
       </div>
      </div>
    </div>
  </div>

  <fontmenue :settings='fontMenueSettings' :fonts='fonts' @update='updateFont'></fontmenue>


  <div class="modal" id="newLive">
  <div class="modal-background"></div>
  <div class="modal-content">
    <form @submit.prevent='addLive($event)' v-if='live'>
      <div class="box">
        <article class="media">
          <div class="media-content">
            <div class="content ">
              <h1 class="title is-dark">{{ Locale.get('new_course_list')}}</h1>
              <p class="control">
                <input class="input is-expanded" type="text" name="title" :placeholder="Locale.get('title')">
              </p>
              <label class="label">Points</label>
              <p class="control">
                <input class="input" type="number" name="points" value="10">
              </p>
              <label class="label">Playlist</label>
              <p class="control">
                <span class="select">
                   <select name="playlist_id">
                     <option :value="live.live_id.playlist_id">Live</option>
                     <option v-for='playlist in live.playlists' :value="playlist.playlist_id">{{ playlist.title }}</option>
                   </select>
                </span>
              </p>
              <label class="label">Teacher</label>
              <p class="control">
                <span class="select">
                   <select name="teacher">
                     <option v-for='teacher in live.teachers' :value="teacher.id">{{ teacher.username }}</option>
                   </select>
                </span>
              </p>
              <p class="control">
                <textarea class="textarea" placeholder="Discription" :placeholder="Locale.get('discription')"></textarea>
              </p>
              <p class="control">
                <button class="button is-success" type="submit">
                  {{ Locale.get('add')}}
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
export default{

props : ['data' , 'tdir' , 'data2'],

 data(){
   return {
      usersChart : null,
      revenueChart : null,
      subscribers : null,
      live : null,
      welcome : null,
      fonts:null,
      Locale :window.Locale,
      fontMenueSettings : {
        top : 20,
        left : 20,
        show : false,
        el : ""
      }
   }
 },
 computed: {

   mylive(){
     return this.live.videos.filter(vGroup => {
               return vGroup.filter(v => {
                 return v.created_by = this.live.user_id;
               });
     });
   },
   allLive(){
     return Chunk.flat(this.live.videos);
   }
 },
  methods :{

    updateFont(f){
      this.welcome.fonts[this.fontMenueSettings.el] = f;
    },
    changeFont(e , el){
      let o = $(e.target).offset();
      this.fontMenueSettings.top = o.top;
      this.fontMenueSettings.left = o.left;
      this.fontMenueSettings.show = true;
      this.fontMenueSettings.el = el;
    },
    loadFont(key){
      let font = this.welcome.fonts[key];

      return `'${font}'`;
    },
    addLive(e){
      let data = new FormData($(e.target)[0]);

      Progressbar.self($(e.target).find('button'));

       this.$http.post( '/admin/courses/live/create', data).then(res => {

         location.reload();

       } ,res => {
         Progressbar.end($(e.target).find('button'));

         Validator.errors(res.body);
     });
    },
    updateLogo(e){

     let data = new FormData();

      data.append('logo' , $(e.target)[0].files[0]);

      Progressbar.self($(e.target).siblings()[0]);
      this.$http.post('/admin/logo', data).then(res => {

        $('#logo , .main-logo').attr('src' ,`/imgs/${res.body}`);
        Progressbar.end($(e.target).siblings()[0]);

      } ,res => {
        Progressbar.end($(e.target).siblings()[0]);

        Validator.errors(res.body);
    });

  },
    uploadFont(e){

     let data = new FormData();

      data.append('font' , $(e.target)[0].files[0]);

      Progressbar.self($(e.target).siblings()[0]);
      this.$http.post('/admin/font/upload', data).then(res => {

        Progressbar.end($(e.target).siblings()[0]);

        let font = res.body;


        $('head').append(`
          <style>
            @font-face {
              font-family: "${font.id}";
              src: url("/fonts/${font.src}");
            }
          </style>
          `);

          this.fonts.push(font);

      } ,res => {
        Progressbar.end($(e.target).siblings()[0]);

        Validator.errors(res.body);
    });

  },
    introSave(e){
     let data = new FormData($(e.target)[0]);

     data.append('fonts' , JSON.stringify(this.welcome.fonts));

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
            showInLegend: false,
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
              text: this.Locale.get('users_year_overview')
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
              text: this.Locale.get('revenue_year_overview')
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
              showInLegend: false,
              data : Object.keys(this.revenueChart).map(d => { return this.revenueChart[d]; })
            }
          ]
      });
    },
    LoadData(){

      let modules = ['usersChart' ,'revenueChart', 'subscribers' , 'live'];

      modules.forEach(module => {
        this.$http.post(`admin/${module}`).then(res => {

            if(module == 'live'){
              let temp = res.body;
              temp.videos = Chunk.cast(temp.videos);
              this[module] = temp;
            }else{
              this[module] = res.body;
            }

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
              Modal.activate();
              break;

          }
        });
      });
    }
  },

  mounted(){
    this.welcome = JSON.parse(this.data);
    this.fonts = JSON.parse(this.data2);

    this.LoadData();
    $(window).on('resize' , () => {
      this.usersChartGraph();
      this.revenueChartGraph()
    });

    $(() => {
      $(document).click(() => {
        this.fontMenueSettings.show = false;
      });
    });
  }
}
</script>

<style>
#usersChart,
#revenueChart {
  width: 100%;
	height: 400px;
}
.subscribers,.live_panel{
  position: relative;
  height: 235px;
}
</style>
