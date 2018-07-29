<template>
    <div class="md-card">
        <admin-header :loading="loading"
                      :title="$t('models.user.users')"
                      :buttons="['create']"
                      class="md-card-header"
                      @onCreate="onCreate"/>

        <div v-if="user" class="md-card-content mt-3">
            <validation-errors/>

            <user-form v-if="isEditing"
                       ref="form"
                       v-model="form"
                       :data="user"/>

            <user-info v-else :data="user"/>
        </div>

    </div>

</template>
<script>
import Http from '../../objects/Http';
import AdminHeader from './headers/AdminHeader';
import UserInfo from '../../components/info/UserInfo';
import UserForm from '../../components/forms/UserForm';

export default {
    components: {AdminHeader, UserInfo, UserForm},

    props: ['userId'],

    data() {
        return {
            form: {},
            user: null,
            loading: false,
            isEditing: false,
        }
    },

    computed: {
        buttons() {
            return this.isEditing ?
                ['save', 'cancel'] :
                ['edit', 'delete']
        }
    },

    methods: {
        getUser() {
            this.loading = true;
            Http.get(`users/${this.userId}`)
                .then(({data}) => {
                    this.user = data.data;
                    this.loading = false;
                });
        },

        onSubmit() {
            // this.$refs['form'].validate(valid => {
            //     if (! valid) return;

            this.update(this.form);
            // })
        },

        update(attributes) {
            this.loading = true;
            Http.put(`users/${this.user.id}`, attributes)
                .then(this.onSuccess)
                .catch(this.onError)
        },

        onSuccess() {
            this.loading = false;
            this.isEditing = false;
            this.getUser();
        },

        onError() {
            this.loading = false;
        },
    }
}
</script>