<template>
    <md-field>
        <label :for="name" v-text="label"/>

        <md-progress-spinner v-if="loading"
                             :md-diameter="30"
                             :md-stroke="3"
                             md-mode="indeterminate"/>

        <md-select v-else
                   :id="name"
                   :name="name"
                   :value="value"
                   :multiple="multiple"
                   :placeholder="label"
                   :disabled="disabled"
                   :title="label"
                   v-model="value"
                   md-dense
                   value-key="id"
                   class="w-100"
                   @input="onInput">
            <md-option v-for="item in options"
                       :key="name +'_'+ item.id"
                       :label="item.label || item.name"
                       :value="item.id">
                {{ item.label || item.name }}
            </md-option>
        </md-select>

        <!--<validation-messages :errors="errors" :label="label"/>-->
    </md-field>
</template>
<script>
import Http from "../../../objects/Http";
import InputMixin from '../../../mixins/InputMixins';

export default {
    mixins: [InputMixin],

    props: ['name', 'url', 'errors', 'selected', 'multiple', 'disabled'],

    data() {
        return {
            path: this.url,
            value: this.selected || (this.multiple ? [] : 0),
            label: this.$t('validation.attributes.' + this.name),
            options: [],
            loading: false,
        }
    },

    created() {
        this.initOptions();

        if (this.path) {
            this.fetchData(this.path)
                .then(this.setSelectedValue);
        } else if (this.selected) {
            this.onInput();
        }
    },

    methods: {
        getOptions() {
            return this.options.slice(1);
        },

        setValue(value) {
            this.value = value;
            this.onInput();
        },

        initOptions() {
            this.options = [];
            this.options.push({
                id: 0,
                name: `--${this.label}--`,
                label: `--${this.label}--`,
            })
        },

        fetchData(url) {
            this.path = url;
            this.initOptions();
            return this.apiCall(url)
        },

        apiCall(url) {
            this.loading = true;
            return Http.get(url)
                .then(this.onSuccess)
                .catch(this.onError);
        },

        onSuccess({data}) {
            this.loading = false;
            data.data.forEach((item) => this.options.push(item));
        },

        onError() {
            this.loading = false;
        },

        setSelectedValue() {
            this.value = this.selected || (this.multiple ? [] : 0);

            if (this.value) this.onInput();
        },

        reset() {
            this.value = this.multiple ? [] : 0;
        },

        onInput() {
            this.$emit('input', this.value);
        },

        refresh() {
            if (this.value && !this.multiple) this.onInput();
        }
    },
}
</script>