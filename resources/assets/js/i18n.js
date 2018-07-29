import Vue from 'vue';
import VueInternationalization from 'vue-i18n';
import messages from './vendor/messages.js';
import config from './config';

Vue.use(VueInternationalization);

const i18n = new VueInternationalization({
    numberFormats: config.numberFormats,
    locale: config.getLocale(),
    messages: messages
});

export default i18n;