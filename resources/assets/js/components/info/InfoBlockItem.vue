<style>
    .InfoBlock__Item {

    }

    .InfoBlock__Label {
        font-weight: 600;
    }

    .InfoBlock__Value {
        display: inline-block;
    }
</style>
<template>
    <div :class="classObj" class="InfoBlock__Item">
        <v-icon v-if="icon" :icon="icon" class="mr-2"/>

        <div v-if="label" class="InfoBlock__Label">
            <span v-text="label"/>

            <div v-if="tooltip">
                <v-icon icon="info-circle"/>
                <md-tooltip md-direction="top"
                            class="ml-1"
                            v-text="tooltip"/>
            </div>
        </div>

        <!-- If a value is passed, it will print it -->
        <div v-if="value != null" class="InfoBlock__Value">

            <info-block-value :value="value"
                              :is-boolean="isBoolean"
                              :is-date="isDate"
                              :is-currency="isCurrency"
                              :is-percent="isPercent"/>
        </div>

        <!-- If no value is given, an external template can be injected here -->
        <span v-else>
            <slot/>
        </span>
    </div>
</template>
<script>
import InfoBlockValue from './InfoBlockValue';

export default {
    components: {InfoBlockValue},

    props: ['label', 'value', 'icon', 'tooltip', 'isBoolean', 'isDate', 'isCurrency', 'isPercent', 'classObj'],
}
</script>