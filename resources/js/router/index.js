import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMeta from 'vue-meta';
import Login from '../pages/Login.vue';
import { $t } from '../helpers';

Vue.use(VueRouter);
Vue.use(VueMeta);

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
    meta: { title: 'common.title.login' }
  },
]

const router = new VueRouter({
  mode: 'history',
  routes
})

router.afterEach((to, from) => {
  Vue.nextTick(() => {
    if (to.meta.title) {
      document.title = ($t(to.meta.title) + process.env.MIX_TITLE_TEMPLATE);
    }
  });
});

export default router;
