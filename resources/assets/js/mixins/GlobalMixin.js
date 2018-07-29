import Vue from 'vue';

Vue.mixin({

    methods: {
        /**
         * It generates a FormData object from a given object. Useful when sending files in a form.
         * the extra param is an object with extra values that want to be added to the final FormData.
         * Extra values will be filtered; no nulls, empty or false values will be added.
         *
         * @param {*} object
         * @param {*} extra
         * @returns {FormData}
         */
        toFormData(object, extra) {
            let formData = new FormData();

            // Get all keys
            Object.keys(object)
            // Appends each key of given object
                .forEach((key) => {
                    // if its an array, iterate over each element to append them one by one
                    if (Array.isArray(object[key])) {
                        object[key].forEach(value => formData.append(key + '[]', value));
                    } else {
                        formData.append(key, object[key])
                    }
                });

            // Extra params
            if (extra) {
                // get all keys of 'extra' object
                Object.keys(extra)
                // clean up nulls
                    .filter(key => extra[key])
                    // appends all values
                    .forEach((key) => formData.append(key, extra[key]));
            }

            return formData;
        },

        /**
         * It transforms an object in a query string
         * All null values found in given object will be removed
         *
         * @param obj
         * @returns {string}
         */
        objToQuery(obj) {
            // first, get all keys of the given object
            return Object.keys(obj)
                // clean up null values
                .filter(val => obj[val])
                // create key=values
                .map(key => `${key}=${encodeURIComponent(obj[key])}`)
                // Join all key=values with a '&'
                .join('&');
        },

        /**
         * Instantiates a Moment object with a given date string.
         *
         * @param {string} dateString
         * @returns {*}
         */
        toMoment(dateString) {
            return this.$moment(dateString);
        },

        /**
         * It removes recursively all attributes that are '' , null or undefined from a given object.
         *
         * @param {*} obj
         * @returns {*}
         */
        removeEmpty(obj) {
            Object.keys(obj).forEach(k =>
                (obj[k] && typeof obj[k] === 'object') && this.removeEmpty(obj[k])
                || this.isEmpty(obj[k]) && delete obj[k]
            );
            return obj;
        },

        /**
         * Checks if a given value is empty
         *
         * @param value
         * @returns {boolean}
         */
        isEmpty(value) {
            return value === '' || value === null || value === undefined;
        },

        /**
         * Clones an array
         *
         * @param {array} array
         * @returns {*}
         */
        clone(array) {
            return array.slice(0);
        },

        /**
         * Shows a Notification
         * Existing types [warning | success | info | error]
         *
         * @param {string} title
         * @param {string} text
         * @param {string} type
         */
        showNotification(title, text, type = 'success') {
            this.$notify({title, text, type});
        },

        /**
         * Translation for a creation
         *
         * @param {string} model
         * @returns {string}
         */
        creatingText(model) {
            return this.$t('verbs.creating', {
                model: this.$t(`models.${model}.${model}`)
            })
        },

        /**
         * Translation for a edition
         *
         * @param {string} model
         * @returns {string}
         */
        editingText(model) {
            return this.$t('verbs.editing', {
                model: this.$t(`models.${model}.${model}`)
            })
        }
    }
});