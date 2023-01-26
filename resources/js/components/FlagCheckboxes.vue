<template>
    <div>
        <div v-for="(title, flag) in flagsWithTitles">
            <label>
                <input type="checkbox" v-model:value="selection[flag].selected" :disabled="selection[flag].disabled" @change="handleInputChange()" :required="isInputRequired">
                <span>{{ title }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        flagsWithTitles: Object,
        groups: {
            type: Array,
            default: () => [],
        },
        required: {
            type: Boolean,
            default: false,
        },
        value: Number,
    },
    data() {
        return {
            selection: this.getRecalculatedSelectionNData(),
        }
    },
    methods: {
        handleInputChange() {
            this.ensureGroupsAreLocked();
            console.log(this.finalValue);
            this.$emit('input', this.finalValue);
        },
        ensureGroupsAreLocked(currentSelection = this.selection) {
            for (const [flag, {selected}] of Object.entries(currentSelection)) {
                if (selected === false)
                    continue;

                for (const group of this.groups) {
                    if (!group.includes(parseInt(flag)))
                        continue;

                    this.disableAllNotInGroup(group, currentSelection);
                    return;
                }
            }

            this.enableAll(currentSelection);
        },
        disableAllNotInGroup(group, currentSelection = this.selection) {
            for (const key of Object.keys(currentSelection)) {
                const shouldDisable = !group.includes(parseInt(key));
                currentSelection[key].disabled = shouldDisable;
                if (shouldDisable) {
                    currentSelection[key].selected = false;
                }
            }
        },
        enableAll(currentSelected) {
            for (const key of Object.keys(currentSelected)) {
                currentSelected[key].disabled = false;
            }
        },

        getRecalculatedSelectionNData() {
            const currentSelection = {};
            for (const flag of Object.keys(this.flagsWithTitles)) {
                currentSelection[flag] = {
                    selected: (this.value & parseInt(flag)) !== 0,
                    disabled: false,
                };
            }

            this.ensureGroupsAreLocked(currentSelection);

            return currentSelection;
        },
        recalculateSelectionData() {
            this.selection = this.getRecalculatedSelectionNData();

            return this.selection;
        },
    },
    watch: {
        value() {
            this.recalculateSelectionData();
        }
    },
    computed: {
        isInputRequired() {
            return this.required && this.finalValue === null;
        },
        finalValue() {
            let out = 0;
            for(const [key, {selected}] of Object.entries(this.selection)) {
                out |= selected ? parseInt(key) : 0;
            }

            return out || null;
        }
    }
}
</script>
