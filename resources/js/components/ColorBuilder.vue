<template>
    <div>
        <recursive-select
            :options="selections"
            v-model="selectedColor"
        ></recursive-select>
        <input type="hidden" v-for="item of selectedColor" :name="`${name}[]`" :value="item">
    </div>
</template>

<script>
import RecursiveSelect from "./RecursiveSelect.vue";

export default {
    components: {RecursiveSelect},
    props: {
        name: String,
        shadedLabel: String,
        fullColorLabel: String,
        mostUsedLabel: String,
        othersLabel: String,
        fullColorLabels: Object,
        shadedColorLabels: Object,
        minkColorLabels: Array,
        siameseHimalayanColorLabels: Object,
        value: {
            type: Array,
            value: () => [],
        }
    },
    data() {
        return {
            selectedColor: this.value,
            selections: [
                {
                    label: this.shadedLabel,
                    value: 'shaded',
                    values: Object.entries(this.shadedColorLabels)
                        .filter(([k]) => Number.isInteger(+k))
                        .map(([i, e]) => ({
                            label: e,
                            value: i,
                            values: Object.entries(this.fullColorLabels)
                                .filter(([k]) => Number.isInteger(+k))
                                .map(([i, e]) => ({
                                    label: e,
                                    value: i,
                                }))
                    })),
                },
                {
                    label: this.fullColorLabel,
                    value: 'full',
                    values: Object.entries(this.fullColorLabels)
                        .filter(([k]) => Number.isInteger(+k))
                        .map(([i, e]) => ({
                            label: e,
                            value: i,
                        }))
                }
            ]
        }
    },
}
</script>
