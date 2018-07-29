<template>
    <transition name="fade" mode="out-in">
        <div v-if="loading" class="spinner-container">
            <md-progress-spinner md-mode="indeterminate"/>
        </div>
    </transition>
</template>
<script>
export default {
    props: ['loading'],
}
</script>