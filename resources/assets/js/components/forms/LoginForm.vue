<template>
    <form novalidate class="md-layout">

        <i-text v-model="form.email"
                :value="form.email"
                :validator="$v"
                name="email"/>

        <i-text v-model="form.password"
                :value="form.password"
                :validator="$v"
                type="password"
                name="password"/>
    </form>
</template>
<script>
import iText from '../forms/inputs/iText';
import FormMixin from '../../mixins/FormMixin';
import validations from './validations/loginValidations';

export default {
    components: {iText},

    mixins: [FormMixin],

    props: ['data'],

    data() {
        return {
            form: Object.assign({}, this.data),
        }
    },

    validations: { form: validations },

    methods: {
        validate(callback){
            this.$v.$touch();

            callback(this.$v.$invalid);
        },
    }
}
</script>