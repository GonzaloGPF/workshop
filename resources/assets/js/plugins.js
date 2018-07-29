import Vue from 'vue';
import VueMaterial from 'vue-material';
import Notifications from 'vue-notification';
import VueMoment from 'vue-moment';
import Vuelidate from 'vuelidate';
import {sync} from 'vuex-router-sync';
import router from "./router";
import store from "./store/store";

sync(store, router);

Vue.use(VueMaterial);

Vue.use(Vuelidate);

Vue.use(VueMoment);

Vue.use(Notifications);