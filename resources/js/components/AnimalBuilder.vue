<template>
    <div class="row">
        <div class="col">
            <div class="row mb-2" v-for="(animal, index) in animals">
                <input type="hidden" :name="`animals[${index}][id]`" :value="animal.id + 5">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <slot name="animal-build-header"></slot>
                        </div>
                        <div class="card-body">
                            <flag-checkboxes
                                :selected="animal.build"
                                :flags-with-titles="animalBuilds"
                                :groups="animalBuildsGroups"
                                :input-name="`animals[${index}][build]`">
                            </flag-checkboxes>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FlagCheckboxes from './FlagCheckboxes';

export default {
    components: {
        FlagCheckboxes,
    },
    props: {
        animals: Array,
        animalBuilds: Object,
        animalBuildsGroups: Array,
    },
    data() {
        return {
        }
    },
}
</script>

