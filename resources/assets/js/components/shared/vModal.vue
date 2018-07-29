<template>
    <md-dialog :md-active="show"
               width="90%"
               top="3em"
               @close="close">

        <md-dialog-title v-text="title"/>

        <div class="pl-5 pr-5 pb-5">

            <v-loader :loading="loading"/>

            <div v-if="show"><!-- v-if will force refreshing slot's view -->
                <slot/>
            </div>

            <md-dialog-actions>

                <md-button :title="$t('controls.cancel')"
                           @click="close"
                           v-text="$t('controls.cancel')"/>

                <md-button :title="$t('controls.ok')"
                           :disabled="loading"
                           class="md-primary"
                           @click="submit"
                           v-text="$t('controls.ok')"/>
            </md-dialog-actions>
        </div>

    </md-dialog>
</template>
<script>
export default {
    props: ['title', 'show', 'loading'],

    created() {
        document.addEventListener('keydown', ({keyCode}) => {
            if (keyCode === 27) this.close();
            // if (keyCode === 13 && this.show) this.submit();
        })
    },

    methods: {
        close() {
            this.$emit('close');
        },

        submit() {
            this.$emit('submit');
        }
    }
}
</script>