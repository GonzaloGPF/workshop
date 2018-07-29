<template>
    <div :class="classObj" class="admin-buttons mr-3">
        <md-button v-for="button in buttons"
                   :key="buttonsData[button].event"
                   :title="buttonsData[button].title"
                   :disabled="disabled"
                   :class="buttonsData[button].class"
                   @click="$emit(buttonsData[button].event)">
            <v-icon :icon="buttonsData[button].icon"/>
        </md-button>
    </div>
</template>
<script>
import vIcon from './vIcon';

export default {
    components: {vIcon},

    props: ['buttons', 'disabled', 'type', 'classObj'],

    data() {
        return {
            buttonsData: {
                view: {
                    type: 'default',
                    title: this.$t('labels.view'),
                    event: 'onView',
                    icon: 'eye',
                    class: 'md-icon-button md-dense'
                },
                create: {
                    type: 'primary',
                    title: this.$t('labels.create'),
                    event: 'onCreate',
                    icon: 'plus',
                    class: 'md-icon-button md-dense md-raised md-primary'
                },
                edit: {
                    type: 'primary',
                    title: this.$t('labels.edit'),
                    event: 'onEdit',
                    icon: 'edit',
                    class: 'md-icon-button md-dense md-primary'
                },
                delete: {
                    type: 'danger',
                    title: this.$t('labels.delete'),
                    event: 'onDelete',
                    icon: 'trash',
                    class: 'md-icon-button md-dense md-accent'
                },
                save: {
                    type: 'primary',
                    title: this.$t('labels.save'),
                    event: 'onSave',
                    icon: 'save',
                    class: 'md-icon-button md-dense md-primary'
                },
                cancel: {
                    type: 'default',
                    title: this.$t('labels.cancel'),
                    event: 'onCancel',
                    icon: 'times',
                    class: 'md-icon-button md-dense'
                },
                download: {
                    type: 'default',
                    title: this.$t('labels.download'),
                    event: 'onDownload',
                    icon: 'download',
                    class: 'md-icon-button md-dense'
                }
            }
        }
    }
}
</script>