
/**
 * @description Main frontend instance file.
 */
import Vue from "vue";
require('./bootstrap');
window.Vue = require('vue');
import postsComponent from "./components/api-v1/posts.vue";

Vue.component(
  'posts-component',
  postsComponent
);

Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);

export default class App extends Vue {

}

const app = new Vue({
    el: '#app',
});
