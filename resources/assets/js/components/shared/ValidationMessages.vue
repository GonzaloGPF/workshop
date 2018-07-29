<template>
    <div class="validation-messages-container">
        <span v-for="(errorKey, index) in getErrorKeys()" :key="index">
            <span v-if="inputData[errorKey] === false"
                  class="md-error"
                  v-text="getTranslation(errorKey)"/>
        </span>
    </div>
</template>
<script>
export default {
    props: ['inputData', 'label'],

    methods: {

        getErrorKeys() {
            return this.inputData && this.inputData.$anyError
                ? Object.keys(this.inputData).filter((key) => !key.startsWith("$"))
                : []
        },

        getTranslation(key) {
            if (key === 'required' || key === 'email') {
                return this.$t('validation.' + key, {attribute: this.label});
            }

            if (key === 'minLength') {
                let size = this.inputData.$params.minLength.min;
                return this.$t('validation.' + key, {attribute: this.label, size: size})
            }

            if (key === 'sameAs') {
                return this.$t('validation.sameAs');
            }
        }
    }
}
</script>