<template>
    <md-switch v-model="val"
               :name="name"
               :value="val"
               :disabled="disabled"
               @change="onInput">
        {{ label }}
    </md-switch>
</template>
<script>
export default {
    props: ['name', 'value', 'disabled'],

    data(){
        return {
            val: this.value || false,
            label: this.$t('validation.attributes.' + this.name)
        }
    },

    methods: {
        reset() {
            this.val = false;
        },

        onInput() {
            console.log('wtf');
            this.$emit('input', this.val);
        }
    }
}
</script>