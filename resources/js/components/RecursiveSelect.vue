<template>
    <div>
        <label>
            <!-- Only values -->
            <select
                :name="name"
                class="custom-select" v-if="typeof options === 'object' && Array.isArray(options)"
                v-model="selectedValue"
            >
                <!-- Default value -->
                <option :value="null">--</option>

                <!-- Actual values -->
                <option
                    v-for="[key, row] of Object.entries(options)"
                    v-if="row !== null && (typeof row === 'object' && !Array.isArray(row))"
                    :value="('value' in row) ? row.value : key"
                    v-model="selectedValue"
                >
                    {{ row.label }}
                </option>
                <option
                    v-else
                    :value="row"
                >
                    {{ row }}
                </option>
            </select>

            <!-- Option groups -->
            <select
                :name="name"
                class="custom-select" v-if="typeof options === 'object' && !Array.isArray(options)"
                v-model="selectedValue"
            >
                <!-- Default value -->
                <option :value="null">--</option>

                <!-- Actual values -->
                <optgroup
                    v-for="[optGroupLabel, optGroupOptions] of Object.entries(options)"
                    :label="optGroupLabel"
                >
                    <option
                        v-for="row of optGroupOptions"
                        v-if="row !== null && (typeof row === 'object' && !Array.isArray(row))"
                        :value="'value' in row ? row.value : null"
                    >
                        {{ row.label }}
                    </option>
                    <option
                        v-else
                        :value="row"
                    >
                        {{ row }}
                    </option>
                </optgroup>
            </select>
        </label>

        <label
            v-for="[key, row] of Object.entries(options)"
            v-if="typeof row === 'object' && !Array.isArray(row) && 'values' in row"
        >
            <recursive-select
                v-if="selectedValue === (typeof row === 'object' && !Array.isArray(row) && 'value' in row ? row.value : key)"
                :name="name"
                :options="row.values"
                :value="value.slice(1) || []"
                v-model="subSelectedValues"
            ></recursive-select>
        </label>
    </div>
</template>

<script>
export default {
    name: 'RecursiveSelect',
    model: {
        prop: 'value',
        event: 'input',
    },
    props: {
        name: {
            type: String,
            default: null,
        },
        options: {},
        value: {},
    },
    data() {
        return {
            selectedValue: (this.value || [])[0] ?? null,
            subSelectedValues: (this.value || []).slice(1) ?? [],
        };
    },
    watch: {
        subSelectedValues() {
            this.handleInput(this.selectedValue);
        },
        selectedValue() {
            this.subSelectedValues = [];
            this.handleInput(this.selectedValue);
        }
    },
    methods: {
        handleInput(value) {
            this.$emit('input', [value, ...this.subSelectedValues]);
        }
    }
}
</script>
