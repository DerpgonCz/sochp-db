<template>
    <form class="form-inline my-2 my-lg-0">
        <div class="dropdown"
             @focusout="closeDropdown"
        >
            <!-- TODO: Translation -->
            <!-- TODO: URL -->
            <input
                class="form-control mr-sm-2" type="search" placeholder="Vyhledávání" aria-label="Vyhledávání"
                @focus="focused = true"
                @input="onSearchChange">
            <div :class="{'dropdown-menu py-0': true, 'show': focused && results }" v-if="results">
                <span class="dropdown-item font-weight-bold pl-2" v-if="results.animals && results.animals.length">Animals</span>
                <a v-for="animal in results.animals.slice(0, 5)" class="dropdown-item" :href="`/animals/${animal.id}`">
                    {{ animal.name }} ({{ animal.litter.station.name }}, {{ animal.color }})
                </a>
                <span class="dropdown-item" v-if="results.animals && results.animals.length > 5">+ {{ results.animals.length - 5}}</span>

                <span class="dropdown-item font-weight-bold pl-2" v-if="results.stations && results.stations.length">ChS</span>
                <a v-for="station in results.stations.slice(0, 5)" class="dropdown-item" :href="`/stations/${station.id}`">
                    {{ station.name }}
                </a>

                <span class="dropdown-item font-weight-bold pl-2" v-if="results.litters && results.litters.length">Vrhy</span>
                <a v-for="litter in results.litters.slice(0, 5)" class="dropdown-item" :href="`/litters/${litter.id}`">
                    {{ litter.id }}
                </a>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                focused: false,
                results: null,
            };
        },
        methods: {
            onSearchChange(e) {
                // TODO: Debounce
                this.search(e.target.value);
            },
            closeDropdown() {
                setTimeout(() => this.focused = false, 200)
            },
            search(term) {
                axios
                    .get('/search',{ params: {q: term} })
                    .then(({ data }) => this.results = data ? data.results : null);
            }
        }
    }
</script>
