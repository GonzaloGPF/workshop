import Vue from 'vue'
import vAdminButtons from './vAdminButtons'
import ValidationErrors from './ValidationErrors'
import ValidationMessages from './ValidationMessages'
import vCheck from './vCheck'
import vEmpty from './vEmpty'
import vIcon from './vIcon'
import vDate from './vDate'
import vPercent from './vPercent'
import vModal from './vModal'
import vNotification from './vNotification'
import vCurrency from './vCurrency'
import vDialog from './vDialog'
import vLoader from './vLoader'

// Components that are registered globally.
Vue.component('v-admin-buttons', vAdminButtons);
Vue.component('validation-errors', ValidationErrors);
Vue.component('validation-messages', ValidationMessages);
Vue.component('v-check', vCheck);
Vue.component('v-date', vDate);
Vue.component('v-percent', vPercent);
Vue.component('v-empty', vEmpty);
Vue.component('v-icon', vIcon);
Vue.component('v-modal', vModal);
Vue.component('v-notification', vNotification);
Vue.component('v-currency', vCurrency);
Vue.component('v-dialog', vDialog);
Vue.component('v-loader', vLoader);
