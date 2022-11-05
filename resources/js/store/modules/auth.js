import localStorageData from "../../configs/localStorage";
import DefaultApi from "../../api/default";
import apiConst from "../../configs/api";
import AuthApi from "../../api/auth";

const api = new DefaultApi();
const authApi = new AuthApi();
const authKey = localStorageData.key.auth;
const accessToken = localStorage.getItem(authKey) ?? "";

export default {
    namespaced: true,

    state: () => ({
        accessToken: accessToken,
        user: null,
    }),

    mutations: {
        SET_ACCESS_TOKEN(state, payload) {
            state.accessToken = payload.accessToken;
            localStorage.setItem(authKey, payload.accessToken);
        },

        SET_USER(state, payload) {
          state.user = payload.user;
        }
    },

    actions: {
        async login(context, payload) {
            let res = await api.post(apiConst.login, payload);

            if (res && res.status === 200) {
                context.commit("SET_ACCESS_TOKEN", {
                    accessToken: res.data.access_token,
                });

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

        async logout(context) {
            await authApi.post(apiConst.logout);
            context.commit("SET_ACCESS_TOKEN", {
                accessToken: "",
            });
        },

        async user(context) {
          let res = await authApi.get(apiConst.user);

          if (res && res.status === 200) {
            context.commit("SET_USER", {
                user: res.data,
            });

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
