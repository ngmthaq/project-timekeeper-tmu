import Vue from "vue";
import VueRouter from "vue-router";
import VueMeta from "vue-meta";
import Login from "../pages/Login.vue";
import DayOffManage from "../pages/DayOffManage.vue";
import Timekeeper from "../pages/Timekeeper.vue";
import DayOff from "../pages/DayOff.vue";
import { $t } from "../helpers";

Vue.use(VueRouter);
Vue.use(VueMeta);

const routes = [
    {
        path: "/",
        name: "Login",
        component: Login,
        meta: { title: "common.title.login" },
    },
    {
        path: "/manage/day/off",
        name: "DayOff",
        component: DayOffManage,
        meta: { title: "Quản lý nghỉ phép" },
    },
    {
        path: "/timekeeper",
        name: "Timekeeper",
        component: Timekeeper,
        meta: { title: "Chấm công" },
    },
    {
        path: "/day/off",
        name: "DayOff",
        component: DayOff,
        meta: { title: "Xin nghỉ phép" },
    },
];

const router = new VueRouter({
    mode: "history",
    routes,
});

router.afterEach((to, from) => {
    Vue.nextTick(() => {
        if (to.meta.title) {
            document.title = $t(to.meta.title) + process.env.MIX_TITLE_TEMPLATE;
        }
    });
});

export default router;
