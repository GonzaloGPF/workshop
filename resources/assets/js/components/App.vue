<style lang="scss" scoped>
    .md-app {
        min-height: 600px;
    }

    // Demo purposes only
    .md-drawer {
        width: 230px;
        max-width: calc(100vw - 125px);
    }

    .md-title {
        cursor: pointer;
    }
</style>
<template>
    <md-app>
        <md-app-toolbar class="md-primary">
            <md-button class="md-icon-button" @click="showNavigation = true">
                <v-icon icon="bars"/>
            </md-button>

            <span class="md-title"
                  @click="$router.push({name: 'home'})"
                  v-text="appName"/>

            <top-menu class="md-toolbar-section-end mr-3"/>

        </md-app-toolbar>

        <md-app-drawer :md-active.sync="showNavigation">

            <side-menu @onItemClick="showNavigation = false"/>

        </md-app-drawer>

        <md-app-content>

            <transition name="fade" mode="out-in">
                <router-view/>
            </transition>

        </md-app-content>
    </md-app>
</template>
<script>
import TopMenu from './menu/TopMenu';
import SideMenu from './menu/SideMenu';
import config from "../config";

export default {
    components: {TopMenu, SideMenu},

    data() {
        return {
            showNavigation: false,
            appName: config.getAppName()
        }
    },


}
</script>

