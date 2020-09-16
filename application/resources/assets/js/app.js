
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueMaterial from 'vue-material'

window.Vue = require('vue');

Vue.use(VueMaterial);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component(
    'my-components',
    require('./components/my-component/my-component.vue')
);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

 Vue.component(
     'passport-authorized-clients',
     require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

/*
const app = new Vue({
    el: '#app'
});*/

const AppProps = Vue.extend({
  props: {
    AppPropVersion: String
  }
});
  // Register for components

class App extends AppProps {

    constructor() {
      super()
      console.log("test App.")
    }

     mounted () {
      console.log("test App.")
    }

}


var app = new Vue({
  // store,
  render: h => h(App, {
    props: {
      AppPropVersion: '0.1.2'
    }
  }),
}).$mount('#app')
