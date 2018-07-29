import store from "../store/store";

export default (to, from, next) => {
    if (store.getters['isLoggedIn']) {
        return next({name: 'home'});
    } else {
        return next();
    }
}