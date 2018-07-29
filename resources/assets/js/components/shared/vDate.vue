<template>
    <span>{{ value | moment("YYYY-MM-DD") }}</span>
</template>
<script>
export default {
    props: ['value'],

    data(){
        return {

        }
    }
}
</script>