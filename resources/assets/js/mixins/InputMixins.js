export default {
    methods: {
        hasErrors() {
            let form = this.getValidatorForm();

            return form
                && Object.keys(form).length > 0
                && form.$dirty
                && form.$invalid;
        },

        updateValidator() {
            let form = this.getValidatorForm();

            if (form) form.$touch();
        },

        getValidatorForm() {
            if(this.validator && this.validator.form) {
                return this.validator.form[this.name]
            }
        }
    }
}