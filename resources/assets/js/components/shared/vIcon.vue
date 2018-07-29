<template>
    <font-awesome-icon :icon="icon"
                       :spin="spin"
                       :pulse="pulse"
                       :fixed-width="fixedWidth"
                       :border="border"
                       :list-item="listItem"
                       :flip="flip"
                       :size="size"
                       :rotate="rotate"
                       :transform="transform"
                       :mask="mask"
                       :symbol="symbol"/>
</template>
<script>
import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
// the library
import FontAwesome from '@fortawesome/fontawesome'
// add more icon categories as you want them, even works with pro packs
import solids from '@fortawesome/fontawesome-free-solid'

export default {
    components: {
        FontAwesomeIcon
    },

    props: ['icon', 'spin', 'pulse', 'fixedWidth', 'border', 'listItem', 'flip', 'size', 'rotate', 'transform', 'mask', 'symbol'],

    created() {
        // associate it to the library, if you need to add more you can separate them by a comma
        FontAwesome.library.add(solids);
    }
}
</script>