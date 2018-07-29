import Cookies from "js-cookie";
import Http from "../../objects/Http";

import * as types from '../mutation-types';
import EventBus from "../../objects/EventBus";
import i18n from "../../i18n";
import router from "../../router";
import config from "../../config";

export const TOKEN_NAME = config.tokenName;

/*
|--------------------------------------------------------------------------
| State
|--------------------------------------------------------------------------
*/
const state = {
    user: null,
    token: Cookies.get(TOKEN_NAME)
};

/*
|--------------------------------------------------------------------------
| Getters
|--------------------------------------------------------------------------
*/
const getters = {
    isLoggedIn: (state) =>  !! state.user,
    authUser: (state) => state.user,
    token: (state) => state.token,
};

/*
|--------------------------------------------------------------------------
| Mutations
|--------------------------------------------------------------------------
*/
const mutations = {
    [types.SAVE_USER](state, user) {
        state.user = user;
    },

    [types.REMOVE_USER](state) {
        state.user = null;
    },

    [types.LOGOUT_USER] (state) {
        state.user = null;
        state.token = null;

        Cookies.remove(TOKEN_NAME);
    },

    [types.SAVE_TOKEN] (state, {token, remember}) {
        state.token = token;
        Cookies.set(TOKEN_NAME, token, { expires: remember ? 365 : null });
    },

    [types.TOKEN_EXPIRED] (state) {
        EventBus.emit('notify', {
            title: i18n.t('labels.error'),
            text: i18n.t('auth.token_expired'),
            type: 'error'
        });

        state.user = null;
        state.token = null;

        Cookies.remove(TOKEN_NAME);

        router.push({name: 'login'});
    }
};

/*
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
*/
const actions = {
    saveToken ({ commit }, payload) {
        commit(types.SAVE_TOKEN, payload)
    },

    tokenExpired({ commit }) {
        commit(types.TOKEN_EXPIRED);
    },

    async fetchUser ({ commit }) {
        try {
            const { data } = await Http.get('user');
            commit(types.SAVE_USER, data.data );
        } catch (e) {
            commit(types.REMOVE_USER);
        }
    },

    async logoutUser ({ commit }) {
        try {
            await Http.post('logout')
        } catch (e) {
            console.error(e);
        }

        commit(types.LOGOUT_USER)
    },
};

/*
|--------------------------------------------------------------------------
| Export the module
|--------------------------------------------------------------------------
*/
export default {
    state,
    mutations,
    actions,
    getters
}