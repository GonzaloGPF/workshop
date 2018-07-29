<template>
    <div/>
    <!--
    <el-pagination :current-page.sync="currentPage"
                   :page-count="totalPage"
                   :page-size="1"
                   :total="totalPage"
                   layout="prev, pager, next"
                   @current-change="onPageChange"/>
   -->
</template>

<script>
import VueTablePaginationMixin from 'vuetable-2/src/components/VuetablePaginationMixin'
export default {
    mixins: [VueTablePaginationMixin],

    data() {
        return {
            currentPage: 0,
            tablePagination: {}
        }
    },

    watch: {
        tablePagination(value) {
            this.currentPage = value.current_page
        }
    },

    methods: {
        onPageChange(page) {
            this.loadPage(page);
        }
    }
}
</script>