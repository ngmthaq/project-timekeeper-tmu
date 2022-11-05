import Vue from "vue";
import Vuex from "vuex";
import locale from "./modules/locale";
import auth from "./modules/auth";
import timekeeper from "./modules/timekeeper";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        locale,
        auth,
        timekeeper,
    },
});
