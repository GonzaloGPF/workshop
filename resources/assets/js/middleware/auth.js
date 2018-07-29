import store from "../store/store";

export default (to, from, next) => {
    if (store.getters.isLoggedIn) {
        return next();
    } else {
        return next({name: 'login'});
    }
}
