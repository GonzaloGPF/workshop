<template>
    <div class="container">
        <div class="jumbotron mt-3">
            <h1 class="display-4" v-text="appName"/>
            <p class="lead" v-text="appDescription"/>
            <div class="p-3">
                Hello World!
            </div>
        </div>
    </div>
</template>

<script>
import config from '../config';

export default {
    data() {
        return {
            appName: config.getAppName(),
            appDescription: config.getAppDescription()
        }
    }
}
</script>
