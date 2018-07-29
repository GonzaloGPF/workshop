<template>
    <info-block :title="$t('labels.general_data')">
        <info-block-item :label="$t('validation.attributes.name')"
                         :value="data.name"/>
        <info-block-item :label="$t('validation.attributes.email')"
                         :value="data.email"/>
        <info-block-item :label="$t('validation.attributes.created_at')"
                         :is-date="true"
                         :value="data.created_at"/>
    </info-block>
</template>
<script>
import InfoBlock from '../info/InfoBlock';
import InfoBlockItem from '../info/InfoBlockItem';

export default {
    components: {InfoBlock, InfoBlockItem},

    props: ['data']
}

</script>