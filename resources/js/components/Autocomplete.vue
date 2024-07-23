<template>
    <select :name="name" ref="select" class="custom-select">
        <option v-if="defaultValue !== null" :value="defaultValue" selected>{{ defaultLabel }}</option>
    </select>
</template>

<script>
    export default {
        props: {
            name: String,
            type: String,
            gender: String,
            defaultValue: {
                type: String,
                default: null,
            },
            defaultLabel: {
                type: String,
                default: '',
            },
            placeholder: {
                type: String,
                default: '',
            }
        },
        data() {
            return {
                focused: false,
                results: null,
            };
        },
        mounted() {
            $(this.$refs.select).select2({
                minimumInputLength: 1,
                width: 'resolve',
                theme: 'bootstrap',
                placeholder: this.placeholder,
                language: document.documentElement.lang,
                ajax: {
                    url: '/autocomplete',
                    dataType: 'json',
                    data: params => ({
                        q: params.term,
                        type: this.type,
                        gender: this.gender
                    }),
                },
            });
        },
    }
</script>
