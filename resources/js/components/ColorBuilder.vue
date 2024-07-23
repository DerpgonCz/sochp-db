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
        minkColorLabel: String,
        mostUsedLabel: String,
        othersLabel: String,
        fullColors: Array,
        fullColorMinks: Array,
        fullColorLabels: Object,
        shadedColors: Array,
        shadedColorLabels: Object,
        minkColors: Array,
        minkColorLabels: Object,

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
                    values: this.shadedColors
                        .map(shadedColorValue => ({
                            label: this.shadedColorLabels[shadedColorValue],
                            value: shadedColorValue,
                            defaultValueLabel: `-- ${this.fullColorLabel.toLocaleLowerCase()} --`,
                            values: this.fullColors
                                .map(fullColorValue => ({
                                    label: this.fullColorLabels[fullColorValue],
                                    value: fullColorValue,
                                    defaultValueLabel: `-- ${this.minkColorLabel.toLocaleLowerCase()} --`,
                                    values: this.fullColorMinks.includes(fullColorValue)
                                        ? this.minkColors
                                            .map(minkColorValue => ({
                                                label: this.minkColorLabels[minkColorValue],
                                                value: minkColorValue,
                                            }))
                                        : [],
                                }))
                    })),
                },
                {
                    label: this.fullColorLabel,
                    value: 'full',
                    values: this.fullColors
                        .map(fullColorValue => ({
                            label: this.fullColorLabels[fullColorValue],
                            value: fullColorValue,
                            defaultValueLabel: `-- ${this.minkColorLabel.toLocaleLowerCase()} --`,
                            values: this.fullColorMinks.includes(fullColorValue)
                                ? this.minkColors
                                    .map(minkColorValue => ({
                                        label: this.minkColorLabels[minkColorValue],
                                        value: minkColorValue,
                                    }))
                                : [],
                        }))
                }
            ]
        }
    },
}
</script>
