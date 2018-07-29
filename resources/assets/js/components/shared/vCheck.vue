<template>
    <div>
        <div v-if="value">
            <v-icon icon="check"/>
        </div>
        <div v-else>
            No
        </div>
    </div>
</template>
<script>
export default {
    props: ['value'],
}
</script>