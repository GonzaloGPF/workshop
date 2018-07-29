<style>
.filter-controls {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.table-filter .el-form-item--small {
    margin-bottom: 0;
}

.filter-form > .el-card__body {
    padding: 0.5em;
}
</style>
<template>
    <form :inline="true" :model="form" class="filter-form">

        <div class="md-layout md-gutter">
            <div class="md-layout-item md-size-20">
                <div class="filter-controls">
                    <div class="mb-1">
                        <md-button :title="$t('controls.filter')" class="md-dense md-primary" @click="doFilter">
                            <v-icon icon="search"/>
                        </md-button>
                        <md-button :title="$t('controls.reset_filter')" class="md-dense" @click="resetFilter">
                            <v-icon icon="times"/>
                        </md-button>
                    </div>

                    <!--
                    <transition name="el-zoom-in-center" mode="out-in" style="height: 116px;">
                        <md-button v-if="advanced"
                                   key="1"
                                   size="small"
                                   @click="toggleAdvancedFilter"
                                   v-text="$t('labels.basic-filter')"/>
                        <md-button v-else
                                   key="2"
                                   size="small"
                                   @click="toggleAdvancedFilter"
                                   v-text="$t('labels.advanced-filter')"/>
                    </transition>
                    -->
                </div>
            </div>

            <div class="md-layout-item md-size-80">
                <div class="md-layout md-gutter">
                    <div v-for="filter in filters"
                         :key="filter.title"
                         class="md-layout-item">

                        <i-text v-if="filter.type === 'text'"
                                :ref="filter.name"
                                :name="filter.name"
                                v-model="form[filter.name]"/>

                        <i-select v-if="filter.type === 'select'"
                                  :ref="filter.name"
                                  :name="filter.name"
                                  :url="filter.dataUrl"
                                  v-model="form[filter.name]"
                                  :multiple="filter.multiple"/>

                        <i-date v-if="filter.type === 'date'"
                                :ref="filter.name"
                                v-model="form[filter.name]"
                                :name="filter.name"/>
                    </div>
                </div>
            </div>

        </div>
    </form>
</template>
<script>
import iSelect from '../forms/inputs/iSelect';
import iText from '../forms/inputs/iText';
import iDate from '../forms/inputs/iDate';
import DataTableMixin from '../../mixins/DataTableMixin';

export default {
    components: {iSelect, iText, iDate},

    mixins: [DataTableMixin],

    props: ['filterFields'],

    data() {
        return {
            show: false,
            form: {},
            filters: [],
            normalFilters: [],
            advancedFilters: [],
            selectData: [],
            advanced: false
        }
    },

    created() {
        let filters = this.getFilters();

        this.normalFilters = filters.normal;
        this.advancedFilters = filters.advanced;
        this.filters = this.normalFilters;
    },

    mounted() {
        document.addEventListener('keydown', ({keyCode}) => {
            if(keyCode === 13) this.doFilter();
            if(keyCode === 27) this.resetFilter();
        });
    },

    methods: {
        getFilters() {
            return {
                normal: this.filterFields.filter(filter => !filter.advanced),
                advanced: this.filterFields
            };
        },

        doFilter() {
            this.$emit('filter-set', this.form);
        },

        resetFilter() {
            this.filters.map((filter) => this.$refs[filter.name][0].reset());

            this.$emit('filter-reset');
        },

        toggleAdvancedFilter() {
            this.advanced = !this.advanced;

            this.filters = this.advanced
                ? this.advancedFilters
                : this.normalFilters
        },

        download() {
            window.open(`/export/${this.dataField}?` + this.objToQuery(this.form), '_blank');
        }
    }
}
</script>