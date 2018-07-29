<template>
    <div>
        <div class="mt-3">
            <data-table-filter :filter-fields="filters"
                               @filter-set="onFilterSet"
                               @filter-reset="onFilterReset"/>
        </div>

        <md-card class="mt-3">
            <md-card-header>
                <admin-header :title="$t('models.user.users')"
                              :loading="loading"
                              :buttons="['create']"
                              @onCreate="onCreate"/>
            </md-card-header>

            <md-card-content>
                <data-table ref="table"
                            :params="params"
                            :buttons="['view', 'edit', 'delete']"
                            :data-field="dataField"
                            url="users"
                            @onView="onView"
                            @onEdit="onEdit"
                            @onDelete="onDelete"/>
            </md-card-content>

        </md-card>

        <v-modal :show="showModal"
                 :title="modalTitle"
                 :loading="loading"
                 @close="showModal = false"
                 @submit="onSubmit">
            <validation-errors/>

            <user-form ref="form"
                       v-model="form"
                       :admin="true"
                       :hide-password="true"
                       :data="user"/>
        </v-modal>

        <v-dialog :active="showDialog"
                  :disabled="loading"
                  @onConfirm="this.delete"
                  @onCancel="showDialog = false"/>
    </div>
</template>
<script>
import DataTable from '../../components/tables/DataTable';
import DataTableFilter from '../../components/tables/DataTableFilter';
import AdminHeader from '../../components/admin/headers/AdminHeader';
import UserForm from '../../components/forms/UserForm';
import Http from "../../objects/Http";
import DataTableMixin from '../../mixins/DataTableMixin';
import userFields from '../../components/tables/dataFields/userFields';
import validations from '../../components/forms/validations/userValidations';
import userFilters from '../../components/tables/dataFilters/userFilters';

export default {
    components: { AdminHeader, DataTable, DataTableFilter, UserForm },

    mixins: [DataTableMixin],

    data(){
        return {
            showModal: false,
            modalTitle: '',
            form: {},
            user: {},
            errors: {},
            params: {},
            with: ['role'],
            dataField: [],
            loading: false,
            isCreating: false,
            isEditing: false,
            showDialog: false,
            validations: validations.admin,
            filters: userFilters
        }
    },

    created() {
        this.params = { with: this.with };
        this.dataField = this.buildDataField('userFields', userFields);
    },

    methods: {
        onFilterSet(filters) {
            this.params = Object.assign({ with: this.with }, filters);
        },

        onFilterReset() {
            this.params = {with: this.with}
        },

        onView(user) {
            this.$router.push({
                name: 'users.show',
                params: {id: user.id}
            });
        },

        onCreate() {
            this.modalTitle = this.creatingText('user');
            this.user = {};
            this.form = {};
            this.isCreating = true;
            this.isEditing = false;
            this.showModal = true;
        },

        onEdit(user) {
            this.modalTitle = this.editingText('user');
            this.form = {};
            this.user = user;
            this.isCreating = false;
            this.isEditing = true;
            this.showModal = true;
        },

        onDelete(user) {
            this.user = user;
            this.showDialog = true;
        },

        onSubmit() {
            if(this.isCreating) this.create();
            if(this.isEditing) this.update();
        },

        create() {
            this.$refs['form'].validate(invalid => {
                if (invalid) return;

                this.loading = true;
                Http.post(`users`, this.form)
                    .then(this.onSuccess)
                    .catch(this.onError)
            });
        },

        update() {
            this.$refs['form'].validate(invalid => {
                if (invalid) return;

                this.loading = true;
                Http.put(`users/${this.user.id}`, this.form)
                    .then(this.onSuccess)
                    .catch(this.onError)
            });
        },

        delete() {
            this.loading = true;
            this.showDialog = false;

            Http.delete(`users/${this.user.id}`)
                .then(this.onSuccess)
                .catch(this.onError)
        },

        onSuccess() {
            this.loading = false;
            this.showModal = false;
            this.$refs['table'].refresh();
        },

        onError() {
            this.loading = false;
        }
    }
}
</script>