import apiConst from "../../configs/api";
import AuthApi from "../../api/auth";

const authApi = new AuthApi();

export default {
    namespaced: true,

    state: () => ({}),

    mutations: {},

    actions: {
        async getManagerDayOff(context, payload) {
            let res = await authApi.get(apiConst.dayoffManager, payload);

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
        },

        async updateManagerDayOff(context, payload) {
            let res = await authApi.post(apiConst.updateStatusDayOff, payload);

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
        },
    },
};
