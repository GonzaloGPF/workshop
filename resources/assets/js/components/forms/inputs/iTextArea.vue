<template>
    <md-field :class="{'md-invalid': hasErrors()}">
        <label v-text="label"/>
        <md-textarea :name="name"
                     :type="type"
                     :disabled="disabled"
                     :placeholder="label"
                     v-model="text"
                     @input="onInput"/>

        <validation-messages v-if="validator && validator.form"
                             :input-data="validator.form[name]"
                             :label="label"/>
    </md-field>
</template>
<script>
import InputMixin from '../../../mixins/InputMixins';

export default {
    mixins: [InputMixin],

    props: ['name', 'value', 'type', 'disabled', 'validator'],

    data() {
        return {
            text: this.value || null,
            label: this.$t('validation.attributes.' + this.name)
        }
    },

    methods: {
        setValue(value) {
            this.text = value;
            this.onInput();
        },

        reset() {
            this.text = '';
        },

        onInput() {
            this.updateValidator();
            this.$emit('input', this.text);
        }
    }
}
</script>