<template>
    <div>
        <multiselect
            :class="{ 'is-danger': hasError }"
            v-model="value"
            :value="value"
            tag-placeholder="Add this as new tag"
            placeholder="Search or add a tag"
            :options="options"
            :multiple="true"
            :taggable="true"
            @tag="addTag"
            @search-change="getTags"
            :loading="isLoading"
            :hide-selected="true"
        >
        </multiselect>

        <div v-for="(item, index) in value" :key="index" class="hidden">
            <input type="hidden" name="tags[]" :value="item">
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import axios from 'axios'

    export default {
        components: {
            Multiselect
        },

        data() {
            return {
                isLoading: false,
                value: [],
                options: [],
            }
        },

        props: [
            'oldValue',
            'hasTags',
            'hasError',
        ],

        created: function () {
            if (!!this.oldValue) {
                this.oldValue.forEach(element => {
                    if (!this.value.includes(element)) {
                        this.value.push(element)
                    }
                })
            } else if (!!this.hasTags) {
                this.hasTags.forEach(element => {
                    if (!this.value.includes(element.name)) {
                        this.value.push(element.name)
                    }
                })
            }
        },
        
        methods: {
            addTag(newTag) {
                this.options.push(newTag)
                this.value.push(newTag)
            },

            getTags (query) {
                this.isLoading = true
                axios.get(process.env.MIX_APP_API_URL + `tags?filter[name]=${query}`)
                    .then((response) => {
                        this.isLoading = false
                        response.data.data.forEach((tag) => {
                            if (!this.options.includes(tag.name)) {
                                this.options.push(tag.name)
                            }
                        })
                    })
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.is-danger .multiselect__tags {
    --tw-border-opacity: 1;
    border-color: rgb(239 68 68 / var(--tw-border-opacity));
}
</style>
