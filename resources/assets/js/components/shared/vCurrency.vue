<template>
    <div>
        <span v-if="currency" v-text="$n(displayValue, 'currency', currency)"/>
    </div>
</template>
<script>
import config from '../../config';

export default {
    props: ['value'],

    data(){
        return {
            currency: this.getCurrency()
        }
    },

    computed: {
        displayValue() {
            if (isNaN(this.value) || this.isEmpty(this.value)) return 0;

            return this.value;
        },
    },

    methods: {

        /**
         * Find a currency by the current locale of i18n plugin
         *
         * @returns {string}
         */
        getCurrency() {
            return config.locales[this.$i18n.locale];
        },

        /**
         *
         * @returns {string}
         */
        getCurrencySymbol() {
            let currencyData = config.numberFormats[this.getCurrency()];
            return currencyData['currency']['symbol'];
        },
    }
}
</script>