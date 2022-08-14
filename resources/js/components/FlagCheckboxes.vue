<template>
    <div>
        <div v-for="(title, flag) in flagsWithTitles">
            <label>
                <input type="checkbox" v-model:value="selection[flag].selected" :disabled="selection[flag].disabled" @change="ensureGroups(selection, groups)" :required="isInputRequired">
                <span>{{ title }}</span>
            </label>
        </div>
        <input type="hidden" :name="inputName" :value="finalValue">
    </div>
</template>

<script>
export default {
    props: {
        flagsWithTitles: Object,
        selected: {
            type: Number,
            default: 0,
        },
        groups: {
            type: Array,
            default: () => [],
        },
        inputName: String,
        required: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        const selection = {};
        for (const flag of Object.keys(this.flagsWithTitles)) {
            selection[flag] = {
                selected: (this.selected & parseInt(flag)) !== 0,
                disabled: false,
            };
        }
        this.ensureGroups(selection, this.groups);

        return {
            selection,
        }
    },
    methods: {
        ensureGroups(currentSelected, groups) {
            for (const [key, {selected}] of Object.entries(currentSelected)) {
                if (selected === false)
                    continue;

                for (const group of groups) {
                    if (!group.includes(parseInt(key)))
                        continue;

                    this.disableAllNotInGroup(currentSelected, group);
                    return;
                }
            }

            this.enableAll(currentSelected);
        },
        disableAllNotInGroup(currentSelected, group) {
            for (const key of Object.keys(currentSelected)) {
                const shouldDisable = !group.includes(parseInt(key));
                currentSelected[key].disabled = shouldDisable;
                if (shouldDisable) {
                    currentSelected[key].selected = false;
                }

            }
        },
        enableAll(currentSelected) {
            for (const key of Object.keys(currentSelected)) {
                currentSelected[key].disabled = false;
            }
        },
    },
    computed: {
        finalValue() {
            let out = 0;
            for(const [key, {selected}] of Object.entries(this.selection)) {
                out |= selected ? parseInt(key) : 0;
            }

            return out || null;
        },
        isInputRequired() {
            console.log(this.required, this.finalValue);
            return this.required && this.finalValue === null;
        }
    }
}
</script>
