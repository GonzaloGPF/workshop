<template>
    <form novalidate>

        <div class="md-layout md-gutter">

            <div class="md-layout-item">
                <i-text v-model="form.name"
                        :value="form.name"
                        :validator="$v"
                        name="name"/>
            </div>

            <div class="md-layout-item">
                <i-text v-model="form.email"
                        :value="form.email"
                        :validator="$v"
                        name="email"/>
            </div>

        </div>

        <div class="md-layout md-gutter">

            <div v-if="! hideRole" class="md-layout-item">
                <i-select v-model="form.role_id"
                          :selected="form.role ? form.role.id : null"
                          :validator="$v"
                          name="role_id"
                          url="roles"/>
            </div>

            <div class="md-layout-item">
                <i-text v-if="! hidePassword"
                        v-model="form.password"
                        :value="form.password"
                        :validator="$v"
                        name="password"
                        type="password"/>
            </div>

            <div class="md-layout-item">
                <i-text v-if="! hidePassword"
                        v-model="form.password_confirmation"
                        :value="form.password_confirmation"
                        :validator="$v"
                        name="password_confirmation"
                        type="password"/>
            </div>
        </div>

    </form>
</template>
<script>
import iSelect from './inputs/iSelect'
import iText from './inputs/iText';
import FormMixin from '../../mixins/FormMixin';
import validations from './validations/userValidations';

export default {
    components: {iSelect, iText },

    mixins: [FormMixin],

    props: ['data', 'hide-role', 'hide-password', 'admin'],

    data() {
        return {
            form: Object.assign({}, this.data),
        }
    },

    validations(){
        return {
            form: this.admin ? validations.admin : validations.default
        }
    },

    methods: {
        validate(callback){
            this.$v.$touch();

            callback(this.$v.$invalid);
        },
    }
}
</script>