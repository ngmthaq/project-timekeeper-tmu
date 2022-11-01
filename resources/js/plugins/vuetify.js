import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import '@mdi/font/css/materialdesignicons.css'
import vi from "vuetify/lib/locale/vi";

Vue.use(Vuetify);

const opts = {
    icons: {
        iconfont: "mdiSvg", // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
    },
    lang: {
        locales: { vi },
        current: "vi",
    },
};

export default new Vuetify(opts);
