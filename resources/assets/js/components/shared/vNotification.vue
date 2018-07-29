<template>
    <div>
        <notifications :position="defaultPosition" classes="vue-notification mt-2 animated fadeInDown"/>
    </div>
</template>
<script>
import EventBus from "../../objects/EventBus";

export default {
    props: ['position'],

    data(){
        return {
            defaultPosition: this.position || 'top center'
        }
    },

    created() {
        EventBus.on('notify', (data) => {
            let {title, text, type = 'success'} = data;

            this.$notify({title, text, type})
        });
    }
}
</script>