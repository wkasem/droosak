
import Vue from 'vue';
import vueResource from 'vue-resource';
import VueTimeago from 'vue-timeago';
import Echo from "laravel-echo";

require('./helpers/Modal');
require('./helpers/progressbar');
require('./helpers/chunk');
require('./helpers/Document');
require('./helpers/validator');
require('./helpers/badge');
require('./helpers/locale');
require('./helpers/wickedpicker');

Vue.use(vueResource);

window.Ps   = require('perfect-scrollbar');
window.uuid = require('uuid/v1');

Vue.use(VueTimeago, {
  name: 'timeago',
  locale: `${window.appLocal}-US`,
  locales: {
    'en-US': require('json-loader!vue-timeago/locales/en-US.json'),
    'ar-US': require('json-loader!./locales/timeago.json')
  }
})

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    namespace: 'droosak.Events'
});


Vue.http.interceptors.push((request, next) => {

  // modify headers
  request.headers.set('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
  request.headers.set('X-Socket-ID', window.Echo.socketId());

  next();
});

Vue.component('exam', require('./components/Exam.vue'));
Vue.component('examtake', require('./components/ExamTake.vue'));
Vue.component('messages', require('./components/Messages.vue'));
Vue.component('voicenote', require('./components/VoiceNote.vue'));
Vue.component('player', require('./components/Player.vue'));
Vue.component('playlists', require('./components/Playlists.vue'));
Vue.component('students', require('./components/Students.vue'));
Vue.component('teachers', require('./components/Teachers.vue'));
Vue.component('teacherhome', require('./components/TeacherHome.vue'));
Vue.component('videos', require('./components/Videos.vue'));
Vue.component('voicenote', require('./components/VoiceNote.vue'));
Vue.component('voicemessage', require('./components/VoiceMessage.vue'));
Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('schedule', require('./components/Schedule.vue'));
Vue.component('profile', require('./components/Profile.vue'));

const app = new Vue({
    el: '#app',

    data(){
      return {
        Locale : window.Locale
      }
    }
});

$(function(){

  $('.is-file .button').click(function(){
    $(this).parent().find('input').click();
  });
});
