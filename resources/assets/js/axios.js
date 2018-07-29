import axios from 'axios';
import store from './store/store';
import i18n from './i18n';
import EventBus from "./objects/EventBus";
import Cookies from "js-cookie";
import config from "./config";

let axiosInstance = axios.create({
    baseURL: config.getAppURL() + '/api',
});

// Request interceptor
axiosInstance.interceptors.request.use(request => {
    const token = Cookies.get(config.tokenName);
    if (token) {
        request.headers.common['Authorization'] = `Bearer ${token}`;
    }

    // const locale = store.getters['lang/locale'];
    // if (locale) {
    //     request.headers.common['Accept-Language'] = locale;
    // }

    // request.headers['X-Socket-Id'] = Echo.socketId()

    return request
});

// Response interceptor
axiosInstance.interceptors.response.use(response => {
    const {code, message} = response.data;

    if (code === 201 || code === 202) {
        EventBus.emit('notify', {
            title: i18n.t('labels.success'),
            text: message
        });
    }

    return response;
}, error => {
    const {status, data} = error.response;

    if (status >= 500) {
        EventBus.emit('notify', {
            title: i18n.t('labels.error'),
            text: data.message,
            type: 'error'
        });
    }

    if (status === 401 && store.getters['isLoggedIn']) {
        store.dispatch('tokenExpired');
    }

    if (status === 422) {
        EventBus.emit('validation-errors', data.data);
        EventBus.emit('notify', {
            title: i18n.t('labels.error'),
            text: data.message,
            type: 'error'
        });
    }

    if (status === 400) {
        EventBus.emit('notify', {
            title: i18n.t('labels.error'),
            text: data.message
        });
    }

    return Promise.reject(error);
});

export default axiosInstance;