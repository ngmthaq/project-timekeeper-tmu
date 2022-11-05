import apiConst from "../../configs/api";
import AuthApi from "../../api/auth";

const authApi = new AuthApi();

export default {
    namespaced: true,

    state: () => ({

    }),

    mutations: {

    },

    actions: {
       async createDayOff(context, payload) {
           let res = await authApi.post(apiConst.dayoff, payload);

           if (res && res.status === 200) {
               // location.reload();
           } else {
               return {
                   status: res.response.status,
                   data: res.response.data,
               };
           }
       },
       async getDayOff(context, payload) {
           let res = await authApi.get(apiConst.dayoffget, payload);

           if (res && res.status === 200) {
               return {
                   status: res.status,
                   data: res.data,
               };
           } else {
               return {
                   status: res.response.status,
                   data: res.response.data,
               };
           }
       }

    },
};
