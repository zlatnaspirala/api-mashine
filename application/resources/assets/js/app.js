
require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue';
import passportClients from './components/passport/Clients.vue'
import passportAuthorizedClients from './components/passport/AuthorizedClients.vue'
import passportPersonalAccessTokens from './components/passport/PersonalAccessTokens.vue'

Vue.component(
    'passport-clients',
    passportClients
);

 Vue.component(
     'passport-authorized-clients',
     passportAuthorizedClients
);

Vue.component(
    'passport-personal-access-tokens',
    passportPersonalAccessTokens
);

const app = new Vue({
    el: '#app'
});
