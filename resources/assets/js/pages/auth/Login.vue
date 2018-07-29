<template>
    <md-card class="md-layout-item md-size-50 md-small-size-100 mx-auto mt-5">
        <md-card-header>
            <div class="md-title" v-text="$t('labels.login')"/>
        </md-card-header>

        <md-card-content>
            <v-loader :loading="loading"/>

            <div class="animated fadeIn animation-d-2">

                <validation-errors/>

                <login-form ref="form" v-model="form"/>

                <div class="mx-auto">
                    <md-button :disabled="loading"
                               :title="$t('labels.login')"
                               class="md-primary"
                               @click="submit"
                               v-text="$t('labels.login')"/>
                </div>

            </div>
        </md-card-content>
    </md-card>
</template>

<script>
import LoginForm from '../../components/forms/LoginForm.vue'
import Http from "../../objects/Http";
import ValidationErrors from '../../components/shared/ValidationErrors';

export default {
    components: {LoginForm, ValidationErrors},

    data() {
        return {
            form: {},
            loading: false,
        }
    },

    created() {
        document.addEventListener('keydown', ({keyCode}) => keyCode === 13? this.submit() : null)
    },

    methods: {
        submit() {
            this.$refs['form'].validate((invalid) => {
                if (invalid) return;

                this.loading = true;

                Http.post('login', this.form)
                    .then(this.onSuccess)
                    .catch(() =>this.loading = false);
            });
        },

        onSuccess({data}) {

            this.$store.dispatch('saveToken', {
                token: data.data.token,
                remember: this.form['remember']
            });

            this.$store.dispatch('fetchUser')
                .then(() => {
                    this.$router.push({name: 'home'});
                    this.loading = false;
                });
        }
    }
}
</script>
