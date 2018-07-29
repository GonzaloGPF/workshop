<style>
    .admin-header-title {
        font-size: 1.5rem;
        font-weight: 100;
        margin: 0;
    }
</style>
<template>
    <div class="md-layout md-alignment-center-space-between">
        <div>
            <slot>
                <h3 class="md-title admin-header-title" v-text="title"/>
            </slot>
        </div>
        <v-admin-buttons v-if="! loading"
                         :buttons="buttons"
                         :disabled="disabled"
                         :type="type"
                         @onView="$emit('onView')"
                         @onCreate="$emit('onCreate')"
                         @onEdit="$emit('onEdit')"
                         @onDelete="$emit('onDelete')"
                         @onSave="$emit('onSave')"
                         @onCancel="$emit('onCancel')"/>
    </div>
</template>
<script>
import vIcon from '../../shared/vIcon';
import vAdminButtons from '../../shared/vAdminButtons';

export default {
    components: {vAdminButtons, vIcon},

    props: ['title', 'buttons', 'disabled', 'loading', 'type'],

    computed: {
        span() {
            return this.buttons ? this.buttons.length * 2 + 2: 0;
        }
    }
}
</script>