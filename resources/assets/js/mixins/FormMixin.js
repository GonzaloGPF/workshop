/**
 * FormMixin
 */
export default {

    watch: {
        form: {
            handler(value){
                this.$emit('input', value)
            },
            deep: true
        }
    },

    methods: {

        /**
         * Emits form value to its parent
         *
         * @param value
         * @param field
         */
        onInput(value = null, field = null) {
            if(value != null && field) this.form[field] = value;

            // if (this.$v && this.$v.form[field]) {
            //     this.$v.form[field].$touch();
            // }

            this.$emit('input', this.form);
        },

        /**
         * Get's the form component
         *
         * @returns {*|Vue|Element|Vue[]|Element[]}
         */
        getForm() {
            return this.$refs['form'];
        },

        /**
         * Takes defined rules for async-validator and adds a 'message' attribute.
         * This 'message' attribute is a string that will be translated using $t(string, params)
         *
         * @param rules
         * @returns {*}
         */
        buildRules(rules) {
            Object.keys(rules).forEach(attribute => {
                rules[attribute].forEach(validation => {
                    let translationData = this.getTranslationData(validation, attribute);

                    validation.message = this.$t(translationData.key, translationData.params);
                })
            });
            return rules;
        },

        /**
         * Helper private function for translating messages. It will use Laravel's translation approach.
         * All translated messages will be inside 'validation.attributes'.
         * It will return an object with the necessary information for $t() function
         *
         * @param validation
         * @param attribute
         * @returns {{key: string, params: {attribute: *}}}
         */
        getTranslationData(validation, attribute) {
            let key = '';
            let params = {'attribute': this.$t('validation.attributes.' + attribute)};

            if(validation.required) {
                key = 'validation.required';
            }

            if(validation.type === 'url') {
                key = 'validation.url'
            }

            if(validation.type === 'email') {
                key = 'validation.email';
            }

            if(validation.type === 'integer') {
                key = 'validation.integer';
            }

            if(validation.type === 'number') {
                key = 'validation.numeric';
            }

            if(validation.type === 'float') {
                key = 'validation.numeric';
            }

            if(validation.type === 'date') {
                key = 'validation.date';
            }

            if(validation.type === 'after') {
                key = 'validation.after';
                params.date = this.$t('labels.dates.today');
            }

            if(validation.type === 'iban') {
                key = 'validation.iban';
            }

            if(validation.min) {
                params.min = validation.min;
                if(validation.type === 'string') {
                    key = 'validation.min.string';
                }
                if(validation.type === 'numeric') {
                    key = 'validation.min.numeric';
                }
            }

            return {
                key: key,
                params: params
            }
        },
    }
};