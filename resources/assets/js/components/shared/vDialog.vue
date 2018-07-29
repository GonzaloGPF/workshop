<template>
    <md-dialog-confirm
        :md-active="active"
        :md-title="dialogTitle"
        :md-content="dialogContent"
        :md-confirm-text="$t('labels.ok')"
        :md-cancel-text="$t('labels.cancel')"
        @md-cancel="$emit('onCancel')"
        @md-confirm="onConfirm"/>
</template>
<script>
export default {
    props: ['title', 'content', 'active', 'disabled'],

    data(){
        return {
            dialogTitle: this.title || this.$t('labels.dialog_confirmation_title'),
            dialogContent: this.content || this.$t('labels.dialog_confirmation_content'),
        }
    },

    methods: {
        onConfirm() {
            if (! this.disabled) {
                this.$emit('onConfirm');
            }
        }
    }
}
</script>