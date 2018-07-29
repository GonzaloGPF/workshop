<template>
    <md-menu md-align-trigger md-size="auto">

        <md-button :title="$t('labels.administration')" md-menu-trigger class="md-icon-button">
            <v-icon icon="cog"/>
        </md-button>

        <md-menu-content>
            <md-menu-item>
                <md-button @click="$router.push({name: 'admin.users.index'})" v-text="$t('labels.users')"/>
            </md-menu-item>
        </md-menu-content>
    </md-menu>
</template>
<script>
export default {
    data(){
        return {

        }
    }
}
</script>