<template>
    <md-card class="md-layout-item md-size-50 md-small-size-100 mx-auto mt-5">
        <md-card-header>
            <div class="md-title" v-text="$t('labels.register')"/>
        </md-card-header>

        <md-card-content>
            <div class="animated fadeIn animation-d-2">

                <validation-errors/>

                <register-form ref="form" v-model="form"/>

                <div class="mx-auto">
                    <md-button :disabled="loading"
                               :title="$t('labels.register')"
                               class="md-primary"
                               @click="submit"
                               v-text="$t('labels.register')"/>
                </div>

            </div>
        </md-card-content>
    </md-card>
</template>

<script>
import RegisterForm from '../../components/forms/RegisterForm.vue'
import Http from "../../objects/Http";
import ValidationErrors from '../../components/shared/ValidationErrors';

export default {
    components: {RegisterForm, ValidationErrors},

    data() {
        return {
            form: {},
            loading: false,
        }
    },

    methods: {
        submit() {
            this.$refs['form'].validate((invalid) => {
                if (invalid) return;

                this.loading = true;

                Http.post('register', this.form)
                    .then(this.onSuccess)
                    .catch(() => this.loading = false);
            })
        },

        onSuccess() {

            Http.post('login', this.form)
                .then(({data}) => {
                    this.$store.dispatch('saveToken', {
                        token: data.data.token,
                    });

                    this.$store.dispatch('fetchUser')
                        .then(() => {
                            this.$router.push({name: 'home'});
                            this.loading = false;
                        });
                }).catch(() => this.loading = false);
        }
    }
}
</script>
