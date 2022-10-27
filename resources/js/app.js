require('./bootstrap');

import Vue from 'vue'
import router from './router';
import store from './store';
import trans from './mixins/trans';
import App from './App.vue';
import AuthLayout from './layouts/AuthLayout.vue';
import GuestLayout from './layouts/GuestLayout.vue';
import EventBus from './bus';
import vuetify from './plugins/vuetify';

Vue.component('auth-layout', AuthLayout);
Vue.component('guest-layout', GuestLayout);

Vue.config.productionTip = false;

Vue.prototype.$bus = EventBus;

Vue.mixin(trans);

new Vue({
    router,
    store,
    vuetify,
    render: h => h(App)
}).$mount('#app');
