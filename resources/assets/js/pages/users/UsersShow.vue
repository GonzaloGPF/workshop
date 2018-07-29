<template>
    <div class="container">
        <user-editor :user-id="id" class="m-3"/>
    </div>
</template>
<script>
import UserEditor from '../../components/admin/editors/UserEditor';

export default {
    components: {UserEditor},

    data(){
        return {
            id: this.$route.params.id,
        }
    },
}
</script>