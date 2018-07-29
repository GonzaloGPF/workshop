<template>
    <div v-if="errorsObj && Object.keys(errorsObj).length > 0" class="alert alert-danger" role="alert">
        <h4 class="alert-heading" v-text="$t('validation.error_message')"/>

        <ul class="m-0">
            <li v-for="(error, index) in errorsObj"
                :key="index">

                <span v-for="(msg, i) in error" :key="i"
                      class="d-block"
                      v-text="msg"/>
            </li>
        </ul>
    </div>
</template>
<script>
import EventBus from "../../objects/EventBus";

export default {
    props: ['errors'],

    data() {
        return {
            errorsObj: this.errors
        }
    },

    created() {
        EventBus.on('validation-errors', errors => this.errorsObj = errors);
    }
}
</script>