<template>
    <div class="row">
        <div class="col">
            <div class="row mb-2">
                <div class="col">
                    <table class="table table-bordered">
                        <tbody>
                            <tr v-for="(animal, index) in allAnimals" :key="index">
                                <td>
                                    <input type="hidden" v-if="animal.id" :name="`animals[${index}][id]`" :value="animal.id">
                                    <Modal
                                        :show="openRows[index]"
                                        @save="() => { closeRow(index) }"
                                        :size="'xl'"
                                        :validated="true"
                                    >
                                        <template v-slot:header>Edit an animal</template>
                                        <template v-slot:body>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <label class="form-group">
                                                                <slot name="animal-name-header"></slot> *
                                                                <input type="text" class="form-control" :name="`animals[${index}][name]`" required v-model="animal.name">
                                                            </label>
                                                            <label class="form-group">
                                                                <slot name="animal-gender-header"></slot> *
                                                                <select :name="`animals[${index}][gender]`" class="custom-select" required v-model="animal.gender">
                                                                    <option :value="null">--</option>
                                                                    <option v-for="(genderName, genderValue) in animalGenders" :value="genderValue">{{ genderName }}</option>
                                                                </select>
                                                            </label>
                                                            <label class="form-group">
                                                                <slot name="animal-breeding-type-header"></slot>
                                                                <select :name="`animals[${index}][breeding_type]`" class="custom-select" v-model="animal.breeding_type" :disabled="!canManage">
                                                                    <option :value="null">--</option>
                                                                    <option v-for="(breedingTypeName, breedingTypeValue) in animalBreedingTypes" :value="breedingTypeValue">{{ breedingTypeName }}</option>
                                                                </select>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <label class="form-group">
                                                                <slot name="animal-eyes-header"></slot> *
                                                                <select :name="`animals[${index}][eyes]`" class="custom-select" required v-model="animal.eyes">
                                                                    <option :value="null" disabled>--</option>
                                                                    <option v-for="(eyesName, eyesValue) in animalEyes" :value="eyesValue">{{ eyesName }}</option>
                                                                </select>
                                                            </label>
                                                            <label class="form-group">
                                                                <slot name="animal-mark-primary-header"></slot>
                                                                <select :name="`animals[${index}][mark_primary]`" class="custom-select" v-model="animal.mark_primary">
                                                                    <option :value="null">--</option>
                                                                    <option v-for="(primaryMarkName, primaryMarkValue) in animalPrimaryMarks" :value="primaryMarkValue">{{ primaryMarkName }}</option>
                                                                </select>
                                                            </label>
                                                            <label class="form-group">
                                                                <slot name="animal-mark-secondary-header"></slot>
                                                                <select :name="`animals[${index}][mark_secondary]`" class="custom-select" v-model="animal.mark_secondary">
                                                                    <option :value="null">--</option>
                                                                    <option v-for="(secondaryMarkName, secondaryMarkValue) in animalSecondaryMarks" :value="secondaryMarkValue">{{ secondaryMarkName }}</option>
                                                                </select>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="form-group">
                                                                <slot name="animal-note-header"></slot>
                                                                <textarea class="form-control" :name="`animals[${index}][note]`" cols="30" rows="10" v-model="animal.note"></textarea>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <slot name="animal-build-header"></slot>*
                                                        </div>
                                                        <div class="card-body">
                                                            <flag-checkboxes
                                                                :selected="animal.build"
                                                                :flags-with-titles="animalBuilds"
                                                                :groups="animalBuildGroups"
                                                                :input-name="`animals[${index}][build]`"
                                                                :required="true">
                                                            </flag-checkboxes>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <slot name="animal-fur-header"></slot>*
                                                        </div>
                                                        <div class="card-body">
                                                            <flag-checkboxes
                                                                :selected="animal.fur"
                                                                :flags-with-titles="animalFurs"
                                                                :groups="animalFurGroups"
                                                                :input-name="`animals[${index}][fur]`"
                                                                :required="true">
                                                            </flag-checkboxes>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <slot name="animal-color-header"></slot>*
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
                                                                :selected="animal.effect"
                                                                :flags-with-titles="animalEffects"
                                                                :groups="animalFurGroups"
                                                                :input-name="`animals[${index}][effect]`"
                                                                :required="false">
                                                            </flag-checkboxes>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <template v-slot:footer-save-text>
                                            <slot name="modal-footer-save-text"></slot>
                                        </template>
                                        <template v-slot:footer-left>&nbsp;</template>
                                    </Modal>
                                    {{ animal.name }}
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
        fullColorLabels: Array,
        shadedColorLabels: Array,
        minkColorLabels: Array,
    },
    data() {
        return {
            existingAnimals: this.animals,
            newAnimals: [],
            openRows: Array(this.animals.length).fill(false),
        }
    },
    methods: {
        addEmptyAnimal() {
            this.newAnimals.push({
                mark_primary: null,
                mark_secondary: null,
                effect: null,
                build: null,
                fur: null,
                eyes: null,
                gender: null,
                breeding_type: null,
                note: null,
            });
            this.openRows.push(true);
        },
        openRow(index) {
            this.openRows.splice(index, 1, true);
        },
        closeRow(index) {
            this.openRows.splice(index, 1, false);
        },
        duplicateRow(index) {
            const newAnimal = {
                ...this.allAnimals[index]
            };
            delete newAnimal.id;
            this.newAnimals.push(newAnimal);
        },
        deleteRow(index) {
            if (index < this.animals.length) {
                if (!confirm(this.deleteExistingAnimalMessage))
                    return;

                AnimalService.deleteAnimal(this.existingAnimals[index].id)
                    .catch(e => alert(e.message))
                    .then(() => this.existingAnimals.splice(index, 1))
            } else {
                if(!confirm(this.deleteNewAnimalMessage))
                    return;

                this.newAnimals.splice(index - this.animals.length - 1, 1);
            }
            this.openRows.splice(index, 1);
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

