<template>
    <div>
        <admin-menu v-if="isLoggedIn && authUser.isAdmin"/>

        <md-menu v-if="isLoggedIn" md-align-trigger md-size="auto">
            <md-button md-menu-trigger v-text="authUser.name"/>

            <md-menu-content>
                <md-menu-item>
                    <md-button @click="goTo({name: 'users.show', params: { id: authUser.id }})"
                               v-text="$t('labels.profile')"/>
                </md-menu-item>

                <md-menu-item>
                    <md-button @click="onLogout" v-text="$t('labels.logout')"/>
                </md-menu-item>
            </md-menu-content>
        </md-menu>

        <md-menu v-else md-align-trigger md-size="auto">
            <md-button md-menu-trigger v-text="$t('labels.enter')"/>

            <md-menu-content>
                <md-menu-item>
                    <md-button @click="goTo({name: 'login'})" v-text="$t('labels.login')"/>
                </md-menu-item>
                <md-menu-item>
                    <md-button @click="goTo({name: 'register'})" v-text="$t('labels.register')"/>
                </md-menu-item>
            </md-menu-content>
        </md-menu>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
import AdminMenu from './AdminMenu';

export default {
    components: { AdminMenu },

    props: ['loggedUser'],

    computed: mapGetters([
        'isLoggedIn',
        'authUser'
    ]),

    methods: {
        goTo(routerObject) {
            this.$router.push(routerObject);
        },

        onLogout() {
            this.$store.dispatch('logoutUser')
                .then(() => {
                    this.showNotification(this.$t('labels.success'), this.$t('auth.success_logout'));
                    this.$router.push({name: 'login'});
                });
        },
    }
}
</script>