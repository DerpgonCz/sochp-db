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
                                        <animal-editor
                                            :input-prefix="`animals[${index}]`"
                                            :animal="animal"
                                            :animal-builds="animalBuilds"
                                            :animal-build-groups="animalBuildGroups"
                                            :animal-furs="animalFurs"
                                            :animal-fur-groups="animalFurGroups"
                                            :animal-eyes="animalEyes"
                                            :animal-primary-marks="animalPrimaryMarks"
                                            :animal-secondary-marks="animalSecondaryMarks"
                                            :animal-effects="animalEffects"
                                            :animal-breeding-types="animalBreedingTypes"
                                            :animal-genders="animalGenders"
                                            :delete-existing-animal-message="deleteExistingAnimalMessage"
                                            :delete-new-animal-message="deleteNewAnimalMessage"
                                            :color-builder-most-used-label="colorBuilderMostUsedLabel"
                                            :color-builder-others-label="colorBuilderOthersLabel"
                                            :color-builder-shaded-label="colorBuilderShadedLabel"
                                            :color-builder-full-color-label="colorBuilderFullColorLabel"
                                            :full-color-labels="fullColorLabels"
                                            :shaded-color-labels="shadedColorLabels"
                                            :mink-color-labels="minkColorLabels"
                                            :siamese-himalayan-color-labels="siameseHimalayanColorLabels"
                                        >
                                            <template v-slot:modal-header>
                                                <slot name="modal-header"></slot>
                                            </template>
                                            <template v-slot:animal-name-header>
                                                <slot name="animal-name-header"></slot>
                                            </template>
                                            <template v-slot:animal-build-header>
                                                <slot name="animal-build-header"></slot>
                                            </template>
                                            <template v-slot:animal-fur-header>
                                                <slot name="animal-fur-header"></slot>
                                            </template>
                                            <template v-slot:animal-gender-header>
                                                <slot name="animal-gender-header"></slot>
                                            </template>
                                            <template v-slot:animal-eyes-header>
                                                <slot name="animal-eyes-header"></slot>
                                            </template>
                                            <template v-slot:animal-mark-primary-header>
                                                <slot name="animal-mark-primary-header"></slot>
                                            </template>
                                            <template v-slot:animal-mark-secondary-header>
                                                <slot name="animal-mark-secondary-header"></slot>
                                            </template>
                                            <template v-slot:animal-color-header>
                                                <slot name="animal-color-header"></slot>
                                            </template>
                                            <template v-slot:animal-effect-header>
                                                <slot name="animal-effect-header"></slot>
                                            </template>
                                            <template v-slot:animal-breeding-type-header>
                                                <slot name="animal-breeding-type-header"></slot>
                                            </template>
                                            <template v-slot:animal-note-header>
                                                <slot name="animal-note-header"></slot>
                                            </template>
                                            <template v-slot:animal-registration-no-header>
                                                <slot name="animal-registration-no-header"></slot>
                                            </template>
                                            <template v-slot:animal-title-header>
                                                <slot name="animal-title-header"></slot>
                                            </template>
                                            <template v-slot:modal-footer-close-text>
                                                <slot name="modal-footer-close-text"></slot>
                                            </template>
                                            <template v-slot:modal-footer-save-text>
                                                <slot name="modal-footer-save-text"></slot>
                                            </template>
                                            <template v-slot:button-add-label>
                                                <slot name="button-add-label"></slot>
                                            </template>
                                        </animal-editor>
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
import AnimalEditor from "./AnimalEditor.vue";

export default {
    components: {
        AnimalEditor,
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
        siameseHimalayanColorLabels: Object,
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

