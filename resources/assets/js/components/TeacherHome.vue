<template>
<div>

  <div class="box commentBox" style="position:relative;height:300px;">
   <table class="table">
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


    LoadData(){

      let modules = ['notis'];

      modules.forEach(module => {
        this.$http.post(`teacher/${module}`).then(res => {
          this[module] = res.body;
          switch (module) {
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
  }

}
</script>
