import Vue from "vue";
import Vuex from "vuex";
import locale from "./modules/locale";
import auth from "./modules/auth";
import dayoff from "./modules/dayoff";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        locale,
        auth,
        dayoff,
    },
});
