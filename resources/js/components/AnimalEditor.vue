<template>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="row">
                <div class="col-sm">
                    <label class="form-group">
                        <strong><slot name="animal-name-header"></slot></strong>
                        *
                        <input type="text"
                               class="form-control"
                               :name="`${inputPrefix}[name]`"
                               required
                               maxlength="255"
                               v-model="animal.name">
                    </label>
                    <label class="form-group">
                        <strong><slot name="animal-gender-header"></slot></strong>
                        *
                        <select :name="`${inputPrefix}[gender]`"
                                class="custom-select" required
                                v-model="animal.gender">
                            <option :value="null">--</option>
                            <option
                                v-for="(genderName, genderValue) in animalGenders"
                                :value="genderValue">{{ genderName }}
                            </option>
                        </select>
                    </label>
                    <label class="form-group">
                        <strong><slot name="animal-breeding-type-header"></slot></strong>
                        <select :name="`${inputPrefix}[breeding_type]`"
                                class="custom-select" v-model="animal.breeding_type"
                                :disabled="!canManage">
                            <option :value="null">--</option>
                            <option
                                v-for="(breedingTypeName, breedingTypeValue) in animalBreedingTypes"
                                :value="breedingTypeValue">{{ breedingTypeName }}
                            </option>
                        </select>
                    </label>
                </div>
                <div class="col-sm">
                    <label class="form-group">
                        <strong><slot name="animal-eyes-header"></slot></strong>
                        *
                        <select :name="`${inputPrefix}[eyes]`"
                                class="custom-select" required
                                v-model="animal.eyes">
                            <option :value="null" disabled>--</option>
                            <option v-for="(eyesName, eyesValue) in animalEyes"
                                    :value="eyesValue">{{ eyesName }}
                            </option>
                        </select>
                    </label>
                    <label class="form-group">
                        <strong><slot name="animal-mark-primary-header"></slot></strong>
                        *
                        <select :name="`${inputPrefix}[mark_primary]`"
                                class="custom-select" required
                                v-model="animal.mark_primary">
                            <option :value="null">---</option>
                            <option
                                v-for="(primaryMarkName, primaryMarkValue) in animalPrimaryMarks"
                                :value="primaryMarkValue">{{ primaryMarkName }}
                            </option>
                        </select>
                    </label>
                    <label class="form-group">
                        <strong><slot name="animal-mark-secondary-header"></slot></strong>
                        <select :name="`${inputPrefix}[mark_secondary]`"
                                class="custom-select"
                                v-model="animal.mark_secondary">
                            <option :value="null">--</option>
                            <option
                                v-for="(secondaryMarkName, secondaryMarkValue) in animalSecondaryMarks"
                                :value="secondaryMarkValue">{{ secondaryMarkName }}
                            </option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-group">
                        <strong><slot name="animal-note-header"></slot></strong>
                        <textarea class="form-control"
                                  :name="`${inputPrefix}[note]`" cols="30"
                                  rows="10" v-model="animal.note"></textarea>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <strong><slot name="animal-build-header"></slot></strong>
                    *
                </div>
                <div class="card-body">
                    <flag-checkboxes
                        :flags-with-titles="animalBuilds"
                        :groups="animalBuildGroups"
                        :required="true"
                        v-model="animal.build"
                    >
                    </flag-checkboxes>
                    <input type="hidden" :name="`${inputPrefix}[build]`"
                           v-model="animal.build">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong><slot name="animal-fur-header"></slot></strong>
                    *
                </div>
                <div class="card-body">
                    <flag-checkboxes
                        :flags-with-titles="animalFurs"
                        :groups="animalFurGroups"
                        :required="true"
                        v-model="animal.fur"
                    >
                    </flag-checkboxes>
                    <input type="hidden" :name="`${inputPrefix}[fur]`"
                           v-model="animal.fur">
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <strong><slot name="animal-color-header"></slot></strong>
                    *
                </div>
                <div class="card-body">
                    <color-builder
                        :name="`${inputPrefix}[color]`"
                        :shaded-label="colorBuilderShadedLabel"
                        :full-color-label="colorBuilderFullColorLabel"
                        :mink-color-label="colorBuilderMinkColorLabel"
                        :most-used-label="colorBuilderMostUsedLabel"
                        :others-label="colorBuilderOthersLabel"
                        :full-colors="fullColors"
                        :full-color-minks="fullColorMinks"
                        :full-color-labels="fullColorLabels"
                        :shaded-colors="shadedColors"
                        :shaded-color-labels="shadedColorLabels"
                        :mink-colors="minkColors"
                        :mink-color-labels="minkColorLabels"
                        :value="animal.color"
                    ></color-builder>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <strong><slot name="animal-effect-header"></slot></strong>
                </div>
                <div class="card-body">
                    <flag-checkboxes
                        :flags-with-titles="animalEffects"
                        :required="false"
                        v-model="animal.effect"
                    >
                    </flag-checkboxes>
                    <input type="hidden" :name="`${inputPrefix}[effect]`"
                           v-model="animal.effect">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong><slot name="animal-title-header"></slot></strong>
                </div>
                <div class="card-body">
                    <flag-checkboxes
                        :flags-with-titles="animalTitles"
                        :required="false"
                        :default="0"
                        v-model="animal.title"
                    >
                    </flag-checkboxes>
                    <input type="hidden" :name="`${inputPrefix}[title]`"
                           v-model="animal.title">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FlagCheckboxes from "./FlagCheckboxes.vue";
    import ColorBuilder from "./ColorBuilder.vue";

    export default {
        components: {
            FlagCheckboxes,
            ColorBuilder,
        },
        props: {
            animal: {
                type: Object,
                default() {
                    return {
                        id: null,
                        mark_primary: null,
                        mark_secondary: null,
                        color_full: null,
                        color_shaded: null,
                        color_mink: null,
                        effect: null,
                        build: null,
                        fur: null,
                        eyes: null,
                        gender: null,
                        breeding_type: null,
                        note: null,
                        registration_no: null,
                        title: 0,
                    };
                },
            },
            inputPrefix: {
                type: String,
                default: '',
            },
            animalBuilds: Object,
            animalBuildGroups: Array,
            animalFurs: Object,
            animalFurGroups: Array,
            animalGenders: Object,
            animalEyes: Object,
            animalPrimaryMarks: Object,
            animalSecondaryMarks: Object,
            animalEffects: Object,
            animalTitles: Object,
            animalBreedingTypes: Object,
            canManage: Boolean,
            deleteExistingAnimalMessage: String,
            deleteNewAnimalMessage: String,
            colorBuilderMostUsedLabel: String,
            colorBuilderOthersLabel: String,
            colorBuilderShadedLabel: String,
            colorBuilderFullColorLabel: String,
            colorBuilderMinkColorLabel: String,
            fullColors: Array,
            fullColorMinks: Array,
            fullColorLabels: Object,
            shadedColors: Array,
            shadedColorLabels: Object,
            minkColors: Array,
            minkColorLabels: Object,
            showRegistrationNo: {
                type: Boolean,
                default: false,
            }
        },
    }
</script>
