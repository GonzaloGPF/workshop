import store from "../store/store";

export default async (to, from, next) => {
    if (!store.getters['isLoggedIn'] && store.getters['token']) {
        try {
            await store.dispatch('fetchUser');
        } catch (e) {
            console.error(e);
        }
    }
    next();
}