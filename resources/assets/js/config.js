/*eslint no-undef: "error"*/
/*eslint-env node*/
export default {
    /**
     * Name used to save the JWT as a Cookie in the user's browser
     */
    tokenName: 'snack_jwt',

    /**
     * Locales map from 'locale' in config/app.php to i18n locales
     */
    locales: {
        'es': 'es-ES',
        'en': 'en-EN',
        'us': 'en-US'
    },

    /**
     * All currency data by i18n locale
     */
    numberFormats: {
        'en-EN': {
            currency: {
                style: 'currency', currency: 'GBP', symbol: '£'
            }
        },
        'en-US': {
            currency: {
                style: 'currency', currency: 'USD', symbol: '$'
            }
        },
        'es-ES': {
            currency: {
                style: 'currency', currency: 'EUR', symbol: '€'
            }
        }
    },

    /**
     * The app locale is given by Laravel (it's placed in config/app.php as 'locale')
     *
     * @returns {string}
     */
    getLocale() {
        return document.documentElement.lang.substr(0, 2)
    },

    /**
     * The app url is given by Laravel in app.blade.php file
     *
     * @returns string
     */
    getAppURL() {
        return document.head.querySelector('meta[name="app_url"]').content;
    },

    /**
     * The app name located at master page app.blade.php
     *
     * @returns {string}
     */
    getAppName() {
        return document.querySelector('#app_name').innerHTML;
    },

    /**
     *
     * @returns {VueI18n.TranslateResult}
     */
    getAppDescription() {
        return document.querySelector('meta[name="description"]').content;
    }
}