import config from '../config';

let translatedDataFields = {};
let translatedFilterFields = {};

export default {
    methods: {
        /**
         * Builds up the complete data field needed by vue-table-2.
         * It translate titles if necessary and adds common fields
         *
         * @param {string} name
         * @param {array} dataField
         * @param {boolean} withoutActions
         * @returns {*}
         */
        buildDataField(name, dataField, withoutActions = false) {
            if(! translatedDataFields[name]) {
                dataField = this.translateTitles(dataField);
                translatedDataFields[name] = true;
            }

            return this.addCommonFields(dataField, withoutActions);
        },

        /**
         * Get filters translating its 'title' attributes
         *
         * @param name
         * @param filterFields
         * @returns {*}
         */
        getFilterFields(name, filterFields){
            if(! translatedFilterFields[name]) {
                this.translateTitles(filterFields);
                translatedFilterFields[name] = true;
            }

            return filterFields;
        },

        /**
         * It translates all 'title' attributes of the give array, excepting '#' values.
         *
         * @param {array} array
         * @returns {*}
         */
        translateTitles(array) {
            return array.map((item) => {
                if (item.title !== '#') item.title = this.$t(`validation.attributes.${item.title}`);
                return item;
            });
        },

        /**
         * Adds __sequence and _slot:actions field to given data field.
         *
         * @param {array} dataField
         * @param withoutActions
         * @returns {array}
         */
        addCommonFields(dataField, withoutActions = false) {
            let tableFields = [{
                name: '__sequence',
                title: '#',
                titleClass: 'text-center',
                dataClass: 'text-center'
            }];

            tableFields = tableFields.concat(dataField);

            if(! withoutActions) {
                tableFields.push({
                    name: '__slot:actions',
                    title: this.$t('validation.attributes.actions'),
                    titleClass: 'text-center',
                    dataClass: 'text-center'
                });
            }

            return tableFields;
        },

        boolean(value){
            let result = value ? '&#10003;' : this.$t('controls.no');
            return `<span class="ml-3">${result}</span>`;
        },

        isCurrency(value) {
            let currency = config.locales[this.$i18n.locale];
            return this.$n(value, 'currency', currency)
        }
    }
}

