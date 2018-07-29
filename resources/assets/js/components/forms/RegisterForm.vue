<template>
    <form novalidate class="md-layout">

        <i-text v-model="form.email"
                :value="form.email"
                :validator="$v"
                name="email"/>

        <i-text v-model="form.name"
                :value="form.name"
                :validator="$v"
                name="name"/>

        <i-text v-model="form.password"
                :value="form.password"
                :validator="$v"
                type="password"
                name="password"/>

        <i-text v-model="form.password_confirmation"
                :value="form.password_confirmation"
                :validator="$v"
                type="password"
                name="password_confirmation"/>
    </form>
</template>
<script>
import iText from '../forms/inputs/iText';
import FormMixin from '../../mixins/FormMixin';
import validations from './validations/registerValidations';

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