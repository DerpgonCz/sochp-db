<template>
    <div class="row">
        <div class="col">
            <div class="row mb-2">
                <div class="col">
                    <table class="table table-bordered">
                        <tbody>
                        <tr v-for="(animal, index) in allAnimals" :key="index">
                            <td>
                                <input type="hidden" v-if="animal.id" :name="`animals[${index}][id]`"
                                       :value="animal.id">
                                <Modal
                                    :show="openRows[index]"
                                    @save="() => { saveRow(index) }"
                                    @close="(isValid) => { closeAndRevertChangesRow(index, isValid) }"
                                    :size="'xl'"
                                    :validated="true"
                                >
                                    <template v-slot:header>
                                        <slot name="modal-header"></slot>
                                    </template>
                                    <template v-slot:body>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <label class="form-group">
                                                            <slot name="animal-name-header"></slot>
                                                            *
                                                            <input type="text" class="form-control"
                                                                   :name="`animals[${index}][name]`" required
                                                                   v-model="animal.name">
                                                        </label>
                                                        <label class="form-group">
                                                            <slot name="animal-gender-header"></slot>
                                                            *
                                                            <select :name="`animals[${index}][gender]`"
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
                                                            <slot name="animal-breeding-type-header"></slot>
                                                            <select :name="`animals[${index}][breeding_type]`"
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
                                                            <slot name="animal-eyes-header"></slot>
                                                            *
                                                            <select :name="`animals[${index}][eyes]`"
                                                                    class="custom-select" required
                                                                    v-model="animal.eyes">
                                                                <option :value="null" disabled>--</option>
                                                                <option v-for="(eyesName, eyesValue) in animalEyes"
                                                                        :value="eyesValue">{{ eyesName }}
                                                                </option>
                                                            </select>
                                                        </label>
                                                        <label class="form-group">
                                                            <slot name="animal-mark-primary-header"></slot>
                                                            <select :name="`animals[${index}][mark_primary]`"
                                                                    class="custom-select" v-model="animal.mark_primary">
                                                                <option :value="null">--</option>
                                                                <option
                                                                    v-for="(primaryMarkName, primaryMarkValue) in animalPrimaryMarks"
                                                                    :value="primaryMarkValue">{{ primaryMarkName }}
                                                                </option>
                                                            </select>
                                                        </label>
                                                        <label class="form-group">
                                                            <slot name="animal-mark-secondary-header"></slot>
                                                            <select :name="`animals[${index}][mark_secondary]`"
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
                                                            <slot name="animal-note-header"></slot>
                                                            <textarea class="form-control"
                                                                      :name="`animals[${index}][note]`" cols="30"
                                                                      rows="10" v-model="animal.note"></textarea>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <slot name="animal-build-header"></slot>
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
                                                        <input type="hidden" :name="`animals[${index}][build]`"
                                                               v-model="animal.build">
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <slot name="animal-fur-header"></slot>
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
                                                        <input type="hidden" :name="`animals[${index}][fur]`"
                                                               v-model="animal.fur">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <slot name="animal-color-header"></slot>
                                                        *
                                                    </div>
                                                    <div class="card-body">
                                                        <color-builder
                                                            :name="`animals[${index}][color]`"
                                                            :shaded-label="colorBuilderShadedLabel"
                                                            :full-color-label="colorBuilderFullColorLabel"
                                                            :most-used-label="colorBuilderMostUsedLabel"
                                                            :others-label="colorBuilderOthersLabel"
                                                            :full-color-labels="fullColorLabels"
                                                            :shaded-color-labels="shadedColorLabels"
                                                            :mink-color-labels="minkColorLabels"
                                                            :siamese-himalayan-color-labels="siameseHimalayanColorLabels"
                                                            :value="animal.color"
                                                        ></color-builder>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <slot name="animal-effect-header"></slot>
                                                    </div>
                                                    <div class="card-body">
                                                        <flag-checkboxes
                                                            :flags-with-titles="animalEffects"
                                                            :required="false"
                                                            v-model="animal.effect"
                                                        >
                                                        </flag-checkboxes>
                                                        <input type="hidden" :name="`animals[${index}][effect]`"
                                                               v-model="animal.effect">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-slot:footer-close-text>
                                        <slot name="modal-footer-close-text"></slot>
                                    </template>
                                    <template v-slot:footer-save-text>
                                        <slot name="modal-footer-save-text"></slot>
                                    </template>
                                </Modal>
                                {{ animal.name }}
                            </td>
                            <td v-if="showRegistrationNo">
                                <slot name="animal-registration-no-header"></slot>
                                *
                                <input type="text" class="form-control"
                                       :name="`animals[${index}][registration_no]`" required
                                       v-model="animal.registration_no">
                            </td>
                            <td class="text-right">
                                <button type="button" class="btn btn-sm btn-info" @click="openRow(index)">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning" @click="duplicateRow(index)">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" @click="deleteRow(index)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-success" @click.prevent="addEmptyAnimal">
                        <slot name="button-add-label"></slot>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FlagCheckboxes from './FlagCheckboxes';
import AnimalService from '../services/AnimalService';
import ColorBuilder from "./ColorBuilder.vue";

export default {
    components: {
        ColorBuilder,
        FlagCheckboxes,
    },
    props: {
        animals: Array,
        animalBuilds: Object,
        animalBuildGroups: Array,
        animalFurs: Object,
        animalFurGroups: Array,
        animalGenders: Object,
        animalEyes: Object,
        animalPrimaryMarks: Object,
        animalSecondaryMarks: Object,
        animalEffects: Object,
        animalBreedingTypes: Object,
        canManage: Boolean,
        deleteExistingAnimalMessage: String,
        deleteNewAnimalMessage: String,
        colorBuilderMostUsedLabel: String,
        colorBuilderOthersLabel: String,
        colorBuilderShadedLabel: String,
        colorBuilderFullColorLabel: String,
        fullColorLabels: Object,
        shadedColorLabels: Object,
        minkColorLabels: Array,
        siameseHimalayanColorLabels: Array,
        showRegistrationNo: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {
            existingAnimals: this.animals,
            newAnimals: [],
            openRows: Array(this.animals.length).fill(false),
            _editCache: null,
            justCreatedAnimal: false,
        }
    },
    methods: {
        addEmptyAnimal() {
            this.newAnimals.push({
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
            });
            this.openRows.push(false);
            this.justCreatedAnimal = true;
            this.openRow(this.allAnimals.length - 1);
        },
        openRow(index) {
            // Save current object to edit cache
            this._editCache = JSON.parse(JSON.stringify(this.allAnimals[index]));

            // Close all opened
            this.openRows.fill(false);

            // Open the intended row
            this.openRows.splice(index, 1, true);
        },
        closeAndRevertChangesRow(index, isValid) {
            if (!isValid && this.justCreatedAnimal) {
                this.deleteRow(index, true);
                this.justCreatedAnimal = false;
                return;
            }

            this.justCreatedAnimal = false;

            // Load cached edit data
            Object.assign(this.allAnimals[index], this._editCache);

            // Close the intended row
            this.closeRow(index);
        },
        closeRow(index) {
            // Close the intended row
            this.openRows.splice(index, 1, false);

            // Reset edit cache
            this._editCache = null;
        },
        saveRow(index) {
            this.closeRow(index);
        },
        duplicateRow(index) {
            const newAnimal = {
                ...this.allAnimals[index]
            };
            newAnimal.id = null;
            this.newAnimals.push(newAnimal);
        },
        deleteRow(index, force = false) {
            if (index < this.animals.length) {
                if (!force && !confirm(this.deleteExistingAnimalMessage))
                    return false;

                AnimalService.deleteAnimal(this.existingAnimals[index].id)
                    .catch(e => alert(e.message))
                    .then(() => this.existingAnimals.splice(index, 1))
            } else {
                if (!force && !confirm(this.deleteNewAnimalMessage))
                    return false;

                this.newAnimals.splice(index - this.animals.length - 1, 1);
            }

            this.openRows.splice(index, 1);

            return true;
        },
        isIndexNewAnimal(index) {
            return index >= this.existingAnimals.length;
        }
    },
    computed: {
        allAnimals() {
            return [
                ...this.existingAnimals,
                ...this.newAnimals,
            ];
        }
    }
}
</script>

