<template>
    <div :class="{'md-invalid': hasErrors()}">
        <label v-text="label"/>

        <md-datepicker v-model="date"
                       :name="name"
                       :placeholder="label"
                       :disabled="disabled"
                       @input="onInput"/>

        <validation-messages v-if="validator && validator.form"
                             :input-data="validator.form[name]"
                             :label="label"/>
    </div>
</template>
<script>
import InputMixin from '../../../mixins/InputMixins';

export default {
    mixins: [InputMixin],

    props: ['name', 'value', 'validator', 'disabled'],

    data(){
        return {
            label: this.$t('validation.attributes.' + this.name),
            date: this.value,
            pickerOptions: {}
        }
    },

    methods: {
        setValue(value) {
            this.date = value;
            this.onInput();
        },

        onInput(value) {
            this.updateValidator();
            this.date = this.$moment(value).format('YYYY-MM-DD HH:mm:ss');
            this.$emit('input', this.date)
        },
    }
}
</script>