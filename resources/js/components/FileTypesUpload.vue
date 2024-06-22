<template>
    <div class="row">
        <div class="col">
            <div v-for="file in files" class="row">
                <select :value="file.type">
                    <option :value="null">--</option>
                    <option v-for="(fileTypeValue, fileType) in fileTypes" :value="fileTypeValue">{{ fileTypeTitle(fileType) }}</option>
                </select>
                <input v-if="file.type !== null" type="file" :accept="fileTypeAccept(fileTypes[file.type])" />
            </div>
            <div class="row" v-if="files.length < Object.keys(fileTypes)">
                <button type="button" class="btn btn-success" @click="addFile">+</button>
            </div>
        </div>
    </div>
</template>

<script>
// TODO: Finish this component, currently not used
export default {
    props: {
        fileTypes: Object,
        default: () => {},
    },
    data() {
        return {
            files: []
        }
    },
    methods: {
        addFile() {
            this.files.push({type: null})
        },
        // Accessors
        fileTypeTitle(fileType) {
            return fileType[0];
        },
        fileTypeAccept(fileType) {
            return fileType[1];
        },
    }
}
</script>
