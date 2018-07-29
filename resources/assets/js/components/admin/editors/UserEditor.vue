<template>
    <md-card>
        <md-card-header v-if="user && authUser && user.id === authUser.id">
            <admin-header :buttons="buttons"
                          :title="$t('labels.user_profile')"
                          :loading="loading"
                          @onSave="onSubmit"
                          @onEdit="isEditing = true"
                          @onCancel="isEditing = false"/>
        </md-card-header>

        <md-card-content v-if="user">
            <validation-errors/>

            <user-form v-if="isEditing"
                       ref="form"
                       v-model="form"
                       :hide-role="true"
                       :hide-password="true"
                       :data="user"/>

            <user-info v-else :data="user"/>
        </md-card-content>

    </md-card>

</template>
<script>
import Http from '../../../objects/Http';
import AdminHeader from '../../admin/headers/AdminHeader';
import UserInfo from '../../../components/info/UserInfo';
import UserForm from '../../../components/forms/UserForm';
import {mapGetters} from 'vuex';

export default {
    components: {AdminHeader, UserInfo, UserForm},

    props: ['userId'],

    data() {
        return {
            url: `users/${this.userId}`,
            form: {},
            loading: false,
            isEditing: false,
            user: null,
        }
    },

    computed: {
        buttons() {
            return this.isEditing ?
                ['save', 'cancel'] :
                ['edit']
        },

        ...mapGetters(['authUser'])
    },

    created() {
        this.getUser();
    },

    methods: {
        getUser() {
            this.loading = true;
            Http.get(this.url, {
                params: {with: 'role'}
            })
                .then(({data}) => {
                    this.user = data.data;
                    this.loading = false;
                });
        },

        onSubmit() {
            this.$refs['form'].validate(valid => {
                if (! valid) return;

                this.update(this.form);
            })
        },

        update(attributes) {
            this.loading = true;
            Http.put(this.url, attributes)
                .then(this.onSuccess)
                .catch(this.onError)
        },

        // destroy() {
        //     this.confirmDelete(null, () => {
        //         this.loading = true;
        //         Http.delete(this.url)
        //             .then(this.onSuccessDestroy)
        //             .catch(this.onError);
        //     });
        // },

        onSuccessDestroy() {
            setTimeout(() => this.$router.push({name: 'home'}), 500);
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