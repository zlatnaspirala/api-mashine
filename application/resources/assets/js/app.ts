
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";

require('./bootstrap');

// var Vue = require('vue');
// (window as any).Vue = Vue
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 import myComponent from "./components/my-component/my-component.vue"

 Vue.component(
    'my-component',
     myComponent
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

const app = new Vue({
    el: '#app'
});
