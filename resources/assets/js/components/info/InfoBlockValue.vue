<template>
    <div>
        <v-check v-if="isBoolean"
                 :value="value"
                 class="ml-3"/>

        <v-date v-if="isDate"
                :value="value"/>

        <v-currency v-if="isCurrency"
                    :value="value"/>

        <v-percent v-if="isPercent"
                   :value="value"/>

        <span v-if="isText" v-text="value"/>
    </div>
</template>
<script>

export default {

    props: ['value', 'isBoolean', 'isDate', 'isCurrency', 'isPercent'],

    computed: {
        isText() {
            return !(this.isBoolean || this.isDate || this.isCurrency || this.isPercent);
        }
    }
}
</script>