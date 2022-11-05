import DefaultApi from "./default";
import store from "../store";

export default class AuthApi extends DefaultApi {
    onRequestSuccess(config) {
        config.headers.Authorization = "Bearer " + store.state.auth.accessToken;

        return config;
    }
}
