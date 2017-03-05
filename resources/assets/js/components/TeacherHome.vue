<template>
<div>

  <div class="box">
  <article class="media">
    <div class="media-content">
      <div class="content" id="viewsChart" > </div>
      <div class="content is-loading-div" v-if='!Object.keys(this.views).length'> </div>
    </div>
  </article>
</div>
  <div class="box commentBox" style="position:relative;height:300px;">
   <table class="table">
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
     <tr v-for='noti in notis'>
       <td>
         {{ noti.data.username}}
         {{ Locale.get('commented')}}
         <a :href="'/video/' + noti.data.video_id" target="_blank">{{ noti.data.video_title }}</a>
       </td>
     </tr>
   </table>
  </div>

</div>
</template>

<script>
export default{

  props : ['data'],

  data(){
    return {
      views : [],
      notis : [],
      Locale : window.Locale
    }
  },

  methods:{

    viewsGraph(){
      Highcharts.chart('viewsChart', {
          chart: {
              type: 'line'
          },
          title: {
              text: (new Date()).getFullYear()
          },
          subtitle: {
              text: 'Views'
          },
          xAxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          yAxis: [{
            tickInterval: 1,
            minRange: 1,
            allowDecimals: false,
            startOnTick: true,
          }],
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
              name : "Views",
              data : Object.keys(this.views).map(d => { return this.views[d]; })
            }
          ]
      });
    },
    LoadData(){

      let modules = ['views' , 'notis'];

      modules.forEach(module => {
        this.$http.post(`teacher/${module}`).then(res => {
          this[module] = res.body;
          switch (module) {
            case 'views':
              this.viewsGraph()
              break;
            case 'notis':
              Ps.initialize($('.commentBox')[0]);
              break;
          }
        });
      });
    }

  },
  mounted(){

    this.LoadData();
    $(window).on('resize' , () => {
      this.viewsGraph();
    });
  }

}
</script>
