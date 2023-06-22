<template>
    <v-select taggable label="Unité" :options="options"
        :create-option="measurement => (measurement)"
        push-tags placeholder="Unité" class="border-none">
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
const options = [
  "Forfaitaire",
  "m²",
  "m³",
  "tonne",
  "kg",
  "g",
  "m",
  "jours",
  "heures"
];
</script>