<style scoped>
    .arrow {
        display: inline-block;
        padding-top: 2px;
        margin-left: 5px;
    }

    .ascending-icon {
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 5px solid black;
    }

    .descending-icon {
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid black;
    }
    .data-table-action {
        background: transparent;
        border: none;
    }
</style>
<template>
    <div>
        <v-loader :loading="loading"/>

        <vue-table ref="vuetable"
                   :api-url="'/api/' + url"
                   :http-options="httpOptions"
                   :fields="dataField"
                   :css="css"
                   :append-params="params"
                   :per-page="15"
                   :no-data-template="$t('labels.no_data')"
                   :detail-row-component="detailRow"
                   pagination-path="meta"
                   @vuetable:cell-clicked="onCellClicked"
                   @vuetable:pagination-data="onPaginationData"
                   @vuetable:loading="onLoading"
                   @vuetable:loaded="onLoaded"
                   @vuetable:load-error="handleLoadError">

            <template v-if="buttons && buttons.length > 0" slot="actions" slot-scope="props">
                <v-admin-buttons :buttons="buttons"
                                 type="text"
                                 @onView="$emit('onView', props.rowData)"
                                 @onCreate="$emit('onCreate', props.rowData)"
                                 @onEdit="$emit('onEdit', props.rowData)"
                                 @onDelete="$emit('onDelete', props.rowData)"
                                 @onSave="$emit('onSave', props.rowData)"
                                 @onCancel="$emit('onCancel', props.rowData)"
                                 @onDownload="$emit('onDownload', props.rowData)"/>
            </template>
        </vue-table>

        <div class="d-flex justify-content-between">
            <vue-table-pagination-info ref="paginationInfo"
                                       :info-template="$t('labels.pagination-info')"
                                       :no-data-template="$t('labels.pagination-no-data')"/>
            <vue-table-pagination ref="pagination"
                                  :css="paginationCss"
                                  @vuetable-pagination:change-page="onChangePage"/>
        </div>

        <md-dialog-confirm
            :md-active.sync="showDeleteDialog"
            :md-title="$t('controls.confirm')"
            :md-content="$t('controls.confirm_content')"
            :md-confirm-text="$t('controls.ok')"
            :md-cancel-text="$t('controls.cancel')"
            @md-confirm="onConfirm" />
    </div>
</template>
<script>
import VueTable from 'vuetable-2/src/components/Vuetable.vue';
import DataTablePagination from './DataTablePagination';
import VueTablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
import VueTablePagination from 'vuetable-2/src/components/VuetablePagination';
import DataTableMixin from '../../mixins/DataTableMixin';
import vAdminButtons from '../shared/vAdminButtons';
import './details/details';

export default {
    components: {VueTable, DataTablePagination, VueTablePaginationInfo, VueTablePagination, vAdminButtons},

    mixins: [DataTableMixin],

    props: ['url', 'dataField', 'title', 'params', 'buttons', 'detailRow'],

    data() {
        return {
            httpOptions: {
                headers: {
                    Authorization: 'Bearer ' + this.token
                }
            },
            filters: {},
            fields: [],
            loading: false,
            css: {
                tableClass: 'table table-bordered table-striped table-hover',
                ascendingIcon: 'arrow ascending-icon',
                descendingIcon: 'arrow descending-icon',
                handleIcon: 'fas fa-bars',
                renderIcon: function (classes) {
                    return `<span class="${classes.join(' ')}"></span>`
                }
            },
            paginationCss: {
                wrapperClass: "pagination pull-right",
                activeClass: "btn-primary",
                disabledClass: "disabled",
                pageClass: "btn btn-border",
                linkClass: "btn btn-border",
                icons: {
                    first: "",
                    prev: "",
                    next: "",
                    last: ""
                }
            },
            translated: false,
            showDeleteDialog: false,
            deleteItem: {},
            token: null
        }
    },

    watch: {
        params() {
            this.$nextTick(() => this.refresh());
        }
    },

    beforeCreate() {
        this.token = this.$store.getters['token'];
    },

    methods: {
        onPaginationData(paginationData) {
            this.$refs['pagination'].setPaginationData(paginationData);
            this.$refs['paginationInfo'].setPaginationData(paginationData);
        },

        onChangePage(page) {
            this.$refs['vuetable'].changePage(page);
        },

        onCellClicked(data) {
            this.$refs['vuetable'].toggleDetailRow(data.id);
        },

        refresh() {
            this.$refs['vuetable'].refresh();
        },

        onDelete(row) {
            this.showDeleteDialog = true;
            this.deleteItem = row;
        },

        onConfirm() {
            this.$emit('onDelete', this.deleteItem)  ;
        },

        onLoading() {
            this.loading = true;
            this.$emit('onLoading');
        },

        onLoaded(){
            this.loading = false;
            this.$emit('onLoaded');
        },

        handleLoadError(response){
            if(response.data.code === 401) {
                this.$store.dispatch('tokenExpired');
            }
        }

        // onFilterSet(filters) {
        //     this.filters = filters;
        //     this.$nextTick(() => this.$refs['vuetable'].refresh());
        // },
        //
        // onFilterReset(filters) {
        //     this.filters = filters;
        //     this.$nextTick(() => this.$refs['vuetable'].refresh());
        // },
    }
}
</script>