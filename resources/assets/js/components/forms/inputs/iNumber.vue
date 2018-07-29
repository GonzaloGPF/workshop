<template>
    <md-field :class="{'md-invalid': hasErrors()}">
        <label v-text="label"/>
        <md-input v-model="number"
                  :name="name"
                  :disabled="disabled"
                  :placeholder="label"
                  :min="min"
                  :max="max"
                  :step="step"
                  type="number"
                  @input="onInput"/>

        <validation-messages v-if="validator && validator.form"
                             :input-data="validator.form[name]"
                             :label="label"/>
    </md-field>
</template>
<script>
export default {
    props: ['name', 'value', 'min', 'max', 'step', 'disabled', 'validator'],

    data(){
        return {
            number: this.value || 0
        }
    },

    watch: {
        value(value) {
            this.number = value;
            this.onInput();
        }
    },

    methods: {
        reset() {
            this.number = 0;
        },

        onInput() {
            this.$emit('input', this.number);
        }
    }
}
</script>