<template>
  <v-select taggable v-model="selected" label="title" :options="options" :create-option="formula => ({ title: formula, price: 0 })" push-tags
    placeholder="Formule" class="border-none" @focusout="$emit('savingFormula', selected)">
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
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const emit = defineEmits(["savingFormula"]);
const currentMovingJob = usePage().props.movingJob;
const selected = ref(currentMovingJob.formula);
const options = [
  {
    title: "Standard",
    price: 0
  },
  {
    title: "Silver",
    price: 0
  },
  {
    title: "Gold",
    price: 0
  },
  {
    title: "Platine",
    price: 0
  }
];
</script>