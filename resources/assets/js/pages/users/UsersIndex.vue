<template>
    <div class="container">
        <div class="md-layout md-alignment-center-space-around">
            <md-card v-for="user in users"
                     :key="user.id"
                     class="md-layout-item md-size-30 mb-3">
                <md-card-header>
                    <span v-text="user.name"/>
                </md-card-header>
                <md-card-content>
                    <span v-text="user.email"/>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>
<script>
import Http from "../../objects/Http";

export default {

    props: [''],

    data(){
        return {
            loading: false,
            users: []
        }
    },

    created(){
        this.getUsers();
    },

    methods: {
        getUsers() {
            this.loading = true;

            Http.get('users')
                .then(({data}) => {
                    this.loading = false;
                    this.users = data.data;
                })
        }
    }
}
</script>