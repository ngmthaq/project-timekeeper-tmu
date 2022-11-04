import DefaultApi from "./default";

export default class AuthAPi extends DefaultApi {
    onRequestSuccess(config) {
        console.log(config);
        return config;
    }
}
