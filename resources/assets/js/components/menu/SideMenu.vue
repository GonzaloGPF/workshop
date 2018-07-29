<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="1">
            <md-avatar>
                <img :src="logo"
                     :alt="appName"
                     :title="appName">
            </md-avatar>
            <!--<span v-text="$t('labels.menu')"/>-->
        </md-toolbar>

        <md-list>

            <md-list-item>
                <v-icon icon="user"/>
                <router-link to="/users"
                             class="md-list-item-text ml-3"
                             @click.native="onItemClick"
                             v-text="$t('labels.users')"/>
            </md-list-item>

        </md-list>
    </div>
</template>
<script>

import config from "../../config";

export default {
    data(){
        return {
            appName: config.getAppName(),
            logo: 'logo.svg'
        }
    },

    methods: {
        onItemClick() {
            this.$emit('onItemClick');
        }
    }
}
</script>