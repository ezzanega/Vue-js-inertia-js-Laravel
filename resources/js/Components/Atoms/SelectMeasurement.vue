<template>
    <v-select class="style-chooser border-none" v-model="measurement" :reduce="option => option.id" taggable label="label" :options="options" :create-option="measurement => (measurement)"
        push-tags @focusout="$emit('savingMeasurement', measurement)" >
        <template v-slot:no-options="{ search, searching }">
            <template v-if="searching">
                Aucun résultat trouvé pour <em>{{ search }}.</em>.
            </template>
            <em v-else style="opacity: 0.5">Saisissez pour chercher/créer une formule.</em>
        </template>
    </v-select>
</template>

<script setup>
import vSelect from 'vue-select';
import { ref } from 'vue';

const emit = defineEmits(["measurement", "savingMeasurement"]);
const props = defineProps({
    selected: Number
});

const measurement = ref(props.selected);

const options = [
    { label: 'Unité', id: 0 },
    { label: 'Forfaitaire', id: 1 },
    { label: 'm³', id: 2 },
    { label: 'tonne', id: 3 },
    { label: 'kg', id: 4 },
    { label: 'g', id: 5 },
    { label: 'm', id: 6 },
    { label: 'jour(s)', id: 7 },
    { label: 'heure(s)', id: 8 },
    { label: 'bonhomme(s)', id: 9 },
];

</script>

<style scoped>
.style-chooser {
    background: transparent; 
    border-radius: 0.3rem
}
</style>