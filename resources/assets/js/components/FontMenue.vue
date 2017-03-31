<template>
  <div class="font-menue menu box" :style="[{top: settings.top + 'px' , left: settings.left  + 'px' }]" v-show='settings.show'>
  <ul class="menu-list">
    <li v-for='font in fonts'>
      <a :style="{ fontFamily: `'${font.id}'` }"
         v-html='font.name'
         @click="$emit('update' , font.id)"></a>
    </li>
  </ul>
  </div>
</template>

<script>

export default {

  props : ['settings' , 'fonts'],

}

</script>

<style>
.font-menue{
  position: absolute;
}
</style>
