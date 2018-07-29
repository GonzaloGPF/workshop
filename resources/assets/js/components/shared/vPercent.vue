<template>
    <div>
        <span v-text="percent"/>
    </div>
</template>
<script>
export default {
    props: ['value'],
    data(){
        return {
            percent: (this.value * 100).toFixed(2) + '%'
        }
    }
}
</script>